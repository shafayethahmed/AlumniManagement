<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PendingMember;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
         //Total alumni member.Pending Request,Employed,Unemployed
         //Highlight
         //Announcement

         $totalUser = User::count();
         $totalPending = PendingMember::count();
         $totalEmployed = Profile::where('status','Employed')->count();
         $totalUnEmployed = Profile::where('status','Unemployed')->count();
         return view('admin.dashbord',compact('totalUser','totalPending','totalEmployed','totalUnEmployed'));
    }
}
