<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PendingMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PendingMemberController extends Controller
{
    public function index(){
        //Return the all pending member: 
    }

public function store(Request $request)
{
    // $validated = $request->validate([
    //     'name'            => 'required|string|max:255',
    //     'email'           => 'required|email|max:255|unique:pending_members,email', // or `users` table
    //     'mobile'          => [
    //         'required',
    //         'string',
    //         'max:20',
    //         'regex:/^\+?[1-9][0-9 \-\(\)\+]{6,15}$/',
    //     ],
    //     'admissionYear'   => 'required|integer|min:1950|max:2099',
    //     'graduationYear'  => 'required|integer|min:1950|max:2099',
    //     'department'      => 'required|string|max:255',
    //     'finalResult'     => 'nullable|numeric|between:0,4.00',
    //     'status'          => 'required|in:Unemployed,Employed',
    //     'company'         => 'nullable|string|max:255',
    //     'job'             => 'nullable|string|max:255',
    //     'pass'            => 'required|string|min:8',
    // ]);
        
    var_dump($request->all());

     PendingMember::create([
        'name'            => $request->name,
        'email'           => $request->email,
        'mobile'          => $request->mobile,
        'admission_year'  => $request->admission_year,
        'graduation_year' => $request->graduation_year,
        'department'      => $request->department,
        'final_result'    => $request->final_result,
        'status'          => $request->status,
        'company'         => $request->company,
        'job'             => $request->job,
        'password'        => Hash::make($request->password),
    ]);


    // try {
    //     $member = new PendingMember();
    //     $member->name             = $validated['name'];
    //     $member->email            = $validated['email'];
    //     $member->mobile           = $validated['mobile'];
    //     $member->admission_year   = $validated['admission_year'];
    //     $member->graduation_year  = $validated['graduation_year'];
    //     $member->department       = $validated['department'];
    //     $member->final_result     = $validated['final_result'];
    //     $member->status           = $validated['status'];
    //     $member->company          = $validated['company'];
    //     $member->job              = $validated['job'];
    //     $member->password         = Hash::make($validated['password']);
    //     // member_status defaults to 'pending' from DB

    //     $member->save();

    //     return response()->json([
    //         'status'  => 'success',
    //         'message' => 'Alumni registered successfully',
    //     ]);
    // } catch (\Exception $e) {
    //     return response()->json([
    //         'status'  => 'error',
    //         'message' => 'Something went wrong. Please try again.',
    //     ], 500);
    // }
}
}
