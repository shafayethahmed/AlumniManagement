<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Experience;
use Illuminate\Support\Facades\Auth;
class ExperienceController extends Controller
{
    public function store(Request $request)
{
    //  if (!Auth::check()) {
    //     return response()->json(['message' => 'Unauthorized. Please login.'], 401);
    // }
    $validatedData = $request->validate([
        'user_id'    => 'required|exists:users,id',
        'company'    => 'required|string|max:255',
        'position'   => 'required|string|max:255',
        'started_at' => 'required|date',
        'resign_at'  => 'nullable|date',
    ]);

    Experience::create([
       'user_id' => $validatedData['user_id'],
       'company' => $validatedData['company'],
       'position' => $validatedData['position'],
       'started_at' => $validatedData['started_at'],
       'resign_at' => $validatedData['resign_at'],
    ]);
    return response()->json([
        'status' => 'success',
        'message' => 'Experience saved successfully!',
    ], 201);
}

public function update(Request $request)
{
  
$validatedData = $request->validate([
        'id' => 'required|exists:experiences,id',
        'company'    => 'required|string|max:255',
        'position'   => 'required|string|max:255',
        'started_at' => 'required|date',
        'resign_at'  => 'nullable|date|after_or_equal:started_at',
    ]);
    $experience = Experience::findOrFail($request->id);

    $experience->update($validatedData);

   return redirect()->route('user.profile')->with('success','Updated Experiences Successfully');
}

public function destroy($id)
{
    // Find the record by ID regardless of who owns it
    $experience = Experience::findOrFail($id);
    $experience->delete();

    return response()->json([
        'status' => 'success',
        'message' => 'Deleted successfully'
    ]);
}

}
