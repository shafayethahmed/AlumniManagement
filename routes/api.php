<?php

use Illuminate\Http\Request;
use App\Http\Controllers\MemberAlumniController;
use App\Http\Controllers\MemberDashboardController;
use App\Http\Controllers\MemberPasswordController;
use App\Http\Controllers\MemberProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ExperienceController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

//initially for Normal Testing sacrificing the Sanctum Token.
        Route::get('/dashboard',[MemberDashboardController::class, 'index']);
        Route::get('/profile/{id}', [MemberProfileController::class, 'index']);
        Route::delete('/experience/{id}', [ExperienceController::class, 'destroy']);


