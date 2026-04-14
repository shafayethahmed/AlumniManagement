<?php

use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Debug\VirtualRequestStack;

Route::get('/', function () {
    return view('welcome');
});

// Admin Routes
Route::get('/dashboard',function(){
    return view('admin.dashbord');
})->name('admin.dashboard');

Route::get('/change-password',function(){
 return view('admin.change-password');
})->name('change.password');

// Alumni Member
Route::get('/alumni/members',function(){
    return view('admin.alumni.index');
})->name('alumni.member');
Route::get('/alumni/show-info/',function(){
   return view('admin.alumni.show');
})->name('alumni.show');

// Pending Member Section
Route::get('/alumni/pending-request',function(){
    return view('admin.pending.index');
})->name('alumni.pending');

 Route::get('/alumni/member-review/',function(){
    return view('admin.pending.show');
 })->name('alumni.pending.show');

// Annoucement Section
Route::get('/alumni/announcement',function(){
    return view('admin.announcement.index');
})->name('alumni.announcement');
// Create,edit,show  announcement : 
Route::get('/alumni/announcement/create',function(){
  return view('admin.announcement.create');
})->name('create.announcement');
Route::get('/alumni/anouncement-edit',function(){
  return view('admin.announcement.edit');
})->name('announcement.edit');
Route::get('/alumni/anouncement/show',function(){
    return view('admin.announcement.show');
})->name('announcement.show');
