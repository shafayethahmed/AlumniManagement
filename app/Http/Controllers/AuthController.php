<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index(Request $request)
    {
        $credential = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credential)) {

            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            return redirect()->route('user.dashboard');
        }

        return back()->with('error', 'Wrong Email or Password!');
    }

    public function logout(Request $request){
            Auth::logout();
             $request->session()->invalidate(); // session destroy
            $request->session()->regenerateToken(); // new CSRF token
            return redirect()->route('welcome')->with('success', 'Logged out successfully!');
    }
}