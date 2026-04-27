<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MemberAlumniController extends Controller
{
   public function index(){
    $alumniMembers = User::with('Profile')->get();
    
   }
}
