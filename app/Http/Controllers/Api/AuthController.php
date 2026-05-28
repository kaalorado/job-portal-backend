<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
class AuthController extends Controller
{
    public function register(Request $request)
    {
        // 1. Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:employer,applicant'
        ]);

        // 2. Create user (password automatically hashed because of my model)
        $user = User::create($validated);

        // 3. Create Sanctum token
        $token = $user->createToken('auth_token')->plainTextToken;

        // 4. Return response
        return response()->json([
            'message' => 'User registered successfully',
            'token' => $token,
            'user' => $user
        ], 201);
    }



    public function login(Request $request) {
        // 1. Validate input
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
       ]);

        // 2. Find user
        $user = User::where('email', $validated['email'])->first();

        // 3. Check user exists + password
        if (!$user || !Hash::check($validated['password'], $user->password)) {
            return response()->json([
            'message' => 'Invalid credentials'
             ],  401);
        }

        // 4. Create token
        $token = $user->createToken('auth_token')->plainTextToken;

        // 5. Return response
        return response()->json([
            'message' => 'Login successful',
            'token' => $token,
            'user' => $user
        ]);
    }




    public function logout(Request $request) {
        $request->user()->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logged out successfully'
        ]);
    }
}