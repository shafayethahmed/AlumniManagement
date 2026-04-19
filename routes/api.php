<?php

use Illuminate\Http\Request;
use App\Http\Controllers\MemberAlumniController;
use App\Http\Controllers\MemberDashboardController;
use App\Http\Controllers\MemberPasswordController;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

//initially for Normal Testing sacrificing the Sanctum Token.
Route::get('/dashboard',[MemberDashboardController::class, 'index']);
