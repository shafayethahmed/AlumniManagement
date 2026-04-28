<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MemberAlumniController extends Controller
{
   public function index(){
   //  $TotalAlumniMembers = User::where('role', '!=', 'admin')->count();
    $alumniMembers =User::with(['profile'])->where('role', '!=', 'admin') ->get();
    return response()->json([
       'status' => true,
       'data' => [
         'members' => $alumniMembers,
       ]
    ]);
   }
   public function show($id) {
      // dd($id);
       $member = User::with('profile')->findOrFail($id);
       $experiences = User::with('experiences')->find($id);
      return view('user.alumni.show', compact('member','experiences'));
   }
}
