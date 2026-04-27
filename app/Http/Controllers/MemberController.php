<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(){
         $TotalAlumniMembers = User::where('role', '!=', 'admin')->count();
        $members = $members = User::with('Profile')->where('role', '!=', 'admin') ->get();
        return view('admin.alumni.index',compact('members','TotalAlumniMembers'));
    }
    public function show(User $member){
       return view('admin.alumni.show',compact('member'));
    }
    public function destroy(User $member){
      $member->delete();
      return redirect()->back()->with('success','Member Deleted Successfully');
    }


}
