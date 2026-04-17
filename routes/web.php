<?php
use App\Http\Controllers\PendingMemberController;
use Faker\Guesser\Name;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpKernel\Debug\VirtualRequestStack;
// For both admin and user.
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
Route::get('/alumni/pending-request',[PendingMemberController::class, 'index'])->name('alumni.pending');
Route::get('/alumni/member-review/{member}',[PendingMemberController::class, 'show'])->name('admin.pending.show');
Route::post('/alumni/pending-member/store',[PendingMemberController::class, 'store'])->name('pedning.alumni.store');
Route::get('/alumni/pending-member/{member}', [PendingMemberController::class, 'confirm'])->name('admin.pending.confirm');
Route::delete('/alumni/pending-member/{member}', [PendingMemberController::class, 'reject'])->name('admin.pending.reject');
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



// User/Alumni user Routes: 
Route::get('/alumni/member/dashboard',function(){
    return view('user.dashboard');
})->name('user.dashboard');
Route::get('/alumni/member/profile',function(){
   return view('user.profile');
})->name('user.profile');
Route::get('/alumni/member/change-password',function(){
   return view('user.change-password');
})->name('user.change.password');
Route::get('/alumni/member/all-member',function(){
    return view('user.alumni.index');
})->name('user.alumni.member');