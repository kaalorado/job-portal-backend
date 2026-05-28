<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmployerProfile;
class EmployerProfileController extends Controller
{
    public function store(Request $request)
    {
        // Check if profile already exists
        if ($request->user()->employerProfile) {
            return response()->json([
                'message' => 'Employer profile already exists'
            ], 400);
        }

        // Validate request
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'company_description' => 'nullable|string',
            'website' => 'nullable|string',
            'location' => 'nullable|string'
        ]);

        // Create profile
        $profile = EmployerProfile::create([
            'user_id' => $request->user()->id,
            ...$validated
        ]);

        return response()->json([
            'message' => 'Employer profile created successfully',
            'profile' => $profile
        ], 201);
    }
}