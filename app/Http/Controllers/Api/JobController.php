<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Job;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function store(Request $request) {

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required',
            'salary' => 'nullable|numeric',
            'location' => 'nullable|string',
            'job_type' => 'required|in:full-time,part-time,remote,contract',
            'deadline' => 'nullable|date'
        ]);

        $employerProfile = $request->user()->employerProfile;

        $job = Job::create([
            'employer_profile_id' => $employerProfile->id,
            ...$validated
        ]);

        return response()->json([
            'message' => 'Job created successfully',
            'job' => $job
        ], 201);
    }

    //employer seeing only his job
    public function myJobs(Request $request) {
        $employerProfile = $request->user()->employerProfile;

        $jobs = $employerProfile->jobs;

        return response()->json([
            'jobs' => $jobs
        ]);
    }

        //UPDATE

    public function update(Request $request, $id) {
        $job = Job::findOrFail($id);

        // Ensure employer owns this job
        if (
            $job->employer_profile_id !==
            $request->user()->employerProfile->id
        ) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $validated = $request->validate([
            'title' => 'sometimes|string|max:255',
            'description' => 'sometimes',
            'salary' => 'nullable|numeric',
            'location' => 'nullable|string',
            'job_type' => 'sometimes|in:full-time,part-time,remote,contract',
            'deadline' => 'nullable|date'
        ]);

        $job->update($validated);

            return response()->json([
                'message' => 'Job updated successfully',
                'job' => $job
        ]);
    }


        //DELETE JOB
    public function destroy(Request $request, $id) {
        $job = Job::findOrFail($id);

        // Ensure employer owns the job
        if (
            $job->employer_profile_id !==
            $request->user()->employerProfile->id
        ) {
        return response()->json([
            'message' => 'Unauthorized'
        ], 403);
        }

        $job->delete();

        return response()->json([
            'message' => 'Job deleted successfully'
        ]);
    }

        // public job listing

   public function index(Request $request)
{
    $query = Job::query();

    // Search by title
    if ($request->search) {
        $query->where('title', 'like', '%' . $request->search . '%'); //Find job titles containing search word
    }

    // Filter by location
    if ($request->location) {
        $query->where('location', $request->location);
    }

    // Filter by job type
    if ($request->job_type) {
        $query->where('job_type', $request->job_type);
    }

    // Latest jobs + pagination
    $jobs = $query->latest()->paginate(10);

    return response()->json($jobs);
}
}