<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberProfileController extends Controller
{
 public function index($id)
{
  $profile = User::with(['profile','experiences'])->find($id);
    if (!$profile) {
        return response()->json([
            'status' => false,
            'message' => 'User not logged in'
        ], 401);
    }
    return response()->json([
        'status' => true,
        'data' => $profile
    ]);
}
}
