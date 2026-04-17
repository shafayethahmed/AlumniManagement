<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PendingMember;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class PendingMemberController extends Controller
{
    public function index(){
        //Return the all pending member: 
         $pendingMembers = PendingMember::all();
         return view('admin.pending.index',compact('pendingMembers'));
    }


    public function show(PendingMember $member){
       return view('admin.pending.show',compact('member'));
    }

        public function store(Request $request)
        {
        try{    
            //Validation the Important variable: 
            $validated = $request->validate([
                'academic_id' => 'required|string|unique:pendingmember,academic_id',
                'email' => 'required|email|unique:pendingmember,email',
                'mobile' => 'required|unique:pendingmember,mobile',
            ]);
                PendingMember::create([
                        'academic_id' => $validated['academic_id'],
                        'name'            => $request->name,
                        'email'           => $validated['email'],
                        'mobile'          => $validated['mobile'],
                        'admission_year'  => $request->admission_year,
                        'graduation_year' => $request->graduation_year,
                        'department'      => $request->department,
                        'final_result'    => $request->final_result,
                        'status'          =>$request->status,
                        'company'         => $request->company,
                        'job'             => $request->job,
                        'password'        => Hash::make($request->password),
                    ]);   
            } catch(\Exception $e){
                return redirect()->back()->with('error','Something Wrong!');
        }
            
        return redirect()->back()->with('success','Alumni Registration successfully done please check after 2 hour.');

        }

     public function confirm(PendingMember $member)
        {
            DB::transaction(function () use ($member) {

                $user = User::create([
                    'name' => $member->name,
                    'email' => $member->email,
                    'password' => $member->password,
                ]);

                Profile::create([
                    'user_id' => $user->id,
                    'academic_id' => $member->academic_id,
                    'mobile' => $member->mobile,
                    'admission_year' => $member->admission_year,
                    'graduation_year' => $member->graduation_year,
                    'department' => $member->department,
                    'cgpa' => $member->final_result,
                    'status' => $member->status,
                ]);
                //Delete the Pending Member-id:
                     $member->delete();
            });
                return redirect()->back()->with('success', 'Member Confirmed Successfully');
        }

        public function reject(PendingMember $member){
           $member->delete();
           return redirect()->back()->with('error','Member Request Rejected.');
        }
}
