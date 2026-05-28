<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\JobController;
use App\Http\Controllers\Api\EmployerProfileController;
use App\Http\Controllers\Api\ApplicantProfileController;
use App\Http\Controllers\Api\ApplicationController;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//public job routes
Route::get('/jobs', [JobController::class, 'index']);


//protected routes 
Route::middleware('auth:sanctum')->group(function () {


    Route::get('/me', function (Request $request) {
        return response()->json([
            'user' => $request->user()
         ]);
     });


    Route::post('/logout', [AuthController::class, 'logout']);


    Route::middleware('employer')->group(function () {

        Route::get('/employer-test', function () {
            return response()->json([
                'message' => 'Welcome Employer'
            ]);
        });
        Route::post('/employer/profile', [EmployerProfileController::class, 'store']);
        Route::post('/jobs', [JobController::class, 'store']);
        Route::get('/my-jobs', [JobController::class, 'myJobs']);
        Route::put('/jobs/{id}', [JobController::class, 'update']);
        Route::delete('/jobs/{id}', [JobController::class, 'destroy']);

        Route::get('/jobs/{id}/applications', [ApplicationController::class, 'jobApplications']);
        Route::patch('/applications/{id}/status', [ApplicationController::class, 'updateStatus']);

    });

   

    Route::middleware('applicant')->group(function () {

        Route::get('/applicant-test', function () {
            return response()->json([
                'message' => 'Welcome Applicant'
            ]);
        });

    });

   Route::post('/applicant/profile', [ApplicantProfileController::class, 'store']);
   Route::post('/jobs/{id}/apply', [ApplicationController::class, 'apply']);
   Route::post('/applicant/upload-resume', [ApplicantProfileController::class, 'uploadResume']);
   Route::get('/my-applications', [ApplicationController::class, 'myApplications']);
});