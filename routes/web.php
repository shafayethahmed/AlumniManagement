<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\PendingMemberController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ExperienceController;
use App\Http\Controllers\MemberAlumniController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Debug\VirtualRequestStack;
// For both admin and user.
Route::get('/', function () {
    return view('welcome');
})->name('welcome');

// Auth Login Route: 
Route::post('/login',[AuthController::class,'index'])->name('auth.login');

Route::get('/logout',[AuthController::class, 'logout'])->name('auth.logout');



// Admin Routes
Route::middleware('auth')->group(function (){
Route::get('/admin/dashboard',[DashboardController::class, 'index'])->name('admin.dashboard');
Route::post('/admin/change-password', [PasswordController::class, 'updatePassword'])->name('admin.password.update');
Route::get('/admin/change-password',[PasswordController::class,'index'])->name('change.password');
// Alumni Member
Route::get('/alumni/members',[MemberController::class, 'index'])->name('alumni.member');
Route::get('/alumni/member/{member}',[MemberController::class, 'show'])->name('alumni.show');
Route::delete('/alumni/member/{member}',[MemberController::class, 'destroy'])->name('alumni.destroy');

// Pending Member Section
Route::get('/alumni/pending-request',[PendingMemberController::class, 'index'])->name('alumni.pending');
Route::get('/alumni/member-review/{member}',[PendingMemberController::class, 'show'])->name('admin.pending.show');
Route::post('/alumni/pending-member/store',[PendingMemberController::class, 'store'])->name('pedning.alumni.store');
Route::get('/alumni/pending-member/{member}', [PendingMemberController::class, 'confirm'])->name('admin.pending.confirm');
Route::delete('/alumni/pending-member/{member}', [PendingMemberController::class, 'reject'])->name('admin.pending.reject');
// Annoucement Section
Route::get('/alumni/announcement',[AnnouncementController::class, 'index'])->name('alumni.announcement');
// Create,edit,show  announcement : 
Route::get('/alumni/announcement/create',[AnnouncementController::class, 'create'])->name('create.announcement');
Route::post('/alumni/announcement/store',[AnnouncementController::class, 'store'])->name('announcement.store');
Route::get('/alumni/edit/{announcement}',[AnnouncementController::class, 'edit'])->name('announcement.edit');
Route::get('/alumni/show/{announcement}',[AnnouncementController::class, 'show'])->name('announcement.show');
Route::put('/alumni/update/{announcement}',[AnnouncementController::class, 'update'])->name('announcement.update');
});


 
// User/Alumni user Routes: 
Route::middleware('auth')->group(function (){
Route::get('/dashboard',fn() => view('user.dashboard'))->name('user.dashboard');
Route::get('/change-password' , fn() => view('user.change-password'))->name('user.change.password');
Route::get('/profile', fn()=> view('user.profile'))->name('user.profile');
Route::get('/members', fn()=>view('user.alumni.index'))->name('user.alumni.member');
Route::post('/experience/add',[ExperienceController::class, 'store'])->name('experience.store');
Route::put('/experience/{id}', [ExperienceController::class, 'update'])->name('experience.update');
Route::get('/alumni-member',fn()=>view('user.alumni.index'))->name('user.member.alumni');
Route::get('/alumni-member/view/{id}', [MemberAlumniController::class, 'show'])->name('user.alummni.view');
});