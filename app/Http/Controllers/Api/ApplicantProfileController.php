<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ApplicantProfile;
use Illuminate\Http\Request;

class ApplicantProfileController extends Controller
{
    public function store(Request $request) {
        // Prevent duplicate profile
        // check if profile exist
        if ($request->user()->applicantProfile) {
            return response()->json([
                'message' => 'Applicant profile already exists'
            ], 400);
        }

        // Validate request
        $validated = $request->validate([
            'phone' => 'nullable|string|max:20',
            'bio' => 'nullable|string',
            'skills' => 'nullable|string',
            'experience' => 'nullable|string'
        ]);

        // Create profile
        $profile = ApplicantProfile::create([
            'user_id' => $request->user()->id,
            ...$validated
        ]);
        //response
        return response()->json([
            'message' => 'Applicant profile created successfully',
            'profile' => $profile
        ], 201);
    }


        //upload resume
    public function uploadResume(Request $request) {
        // Validate file
        $request->validate([
            'resume' => 'required|mimes:pdf,doc,docx|max:2048'
        ]);

        $profile = $request->user()->applicantProfile;

        // Store file
        $path = $request->file('resume')->store('resumes', 'public');

        // Save path in database
        $profile->update([
            'resume_path' => $path
        ]);

        return response()->json([
            'message' => 'Resume uploaded successfully',
            'resume_path' => $path
        ]);
    }
}