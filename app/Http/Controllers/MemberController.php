<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function index(){
        $members = User::with('Profile');
        return view('admin.alumni.index',compact('members'));
    }



}
