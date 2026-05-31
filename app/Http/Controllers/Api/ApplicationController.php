<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationController extends Controller
{
    public function apply(Request $request, $jobId)
    {
        $request->validate([
            'cover_letter' => 'nullable|string'
        ]);

        $job = Job::findOrFail($jobId);

        $applicantProfile = $request->user()->applicantProfile;

        // Prevent duplicate applications
        $alreadyApplied = Application::where('job_id', $jobId)
            ->where('applicant_profile_id', $applicantProfile->id)
            ->exists();

        if ($alreadyApplied) {
            return response()->json([
                'message' => 'You have already applied for this job'
            ], 400);
        }
        // create
        $application = Application::create([
            'job_id' => $job->id,
            'applicant_profile_id' => $applicantProfile->id,
            'cover_letter' => $request->cover_letter,
            'status' => 'pending'
        ]);

        return response()->json([
            'message' => 'Application submitted successfully',
            'application' => $application
        ], 201);
    }



    public function jobApplications(Request $request, $jobId) {
        $job = Job::findOrFail($jobId);

        // Ensure employer owns the job
        if (
            $job->employer_profile_id !==
            $request->user()->employerProfile->id
        ) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $applications = Application::where('job_id', $jobId)
            ->with('applicantProfile')
            ->latest()
            ->get();

        return response()->json([
            'applications' => $applications
        ]);
    }


    public function updateStatus(Request $request, $id) {
        $application = Application::findOrFail($id);

        // Ensure employer owns the related job
        if (
            $application->job->employer_profile_id !==
            $request->user()->employerProfile->id
        ) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        // Validate status
        $validated = $request->validate([
            'status' => 'required|in:pending,reviewed,accepted,rejected'
        ]);

        // Update status
        $application->update([
            'status' => $validated['status']
        ]);

        return response()->json([
            'message' => 'Application status updated successfully',
            'application' => $application
        ]);
    }


        //applicant chacking this job application status 
    public function myApplications(Request $request) {
        $applicantProfile = $request->user()->applicantProfile;

        $applications = Application::where(
                'applicant_profile_id',
                $applicantProfile->id
        )
            ->with('job')
            ->latest()
            ->paginate(10);

    return response()->json($applications);
    }

        //download resumee
    public function downloadResume(Request $request, $id) {
        $application = Application::findOrFail($id);

        // Verify employer owns the job
        if (
            $application->job->employer_profile_id !==
            $request->user()->employerProfile->id
        ) {
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }
        //resume path
        $resumePath = $application->applicantProfile->resume_path;

        if (!$resumePath) {
            return response()->json([
                'message' => 'Resume not found'
            ], 404);
        }
        //check if file exist
        if (!Storage::disk('public')->exists($resumePath)) {
            return response()->json([
                'message' => 'File does not exist'
            ], 404);
        }
        //download file
        return response()->download(
            storage_path('app/public/' . $resumePath)
        );
    }
}