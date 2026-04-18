<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Announcement;
use Psy\Util\Str;

class AnnouncementController extends Controller
{
    public function index(){
        $announcements = Announcement::orderBy('created_at', 'desc')->get();
        return view('admin.announcement.index',compact('announcements'));
    }
    
    public function create(){
        return view('admin.announcement.create');
    }

    public function store(Request $request)
    {
        // Validation
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:general,event,job-opportunity,urgent-notice',
        ]);

        //Create announcement
        Announcement::create([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'is_visible' => $request->is_visible ?? 0,
        ]);

        //  Response
        return redirect()
            ->route('alumni.announcement')
            ->with('success', 'Announcement created successfully!');
    }


    public function edit(Announcement $announcement){
        return view('admin.announcement.edit',compact('announcement'));
    }

    public function show(Announcement $announcement){
       return view('admin.announcement.show',compact('announcement'));
    }

    public function update(Request $request,Announcement $announcement){
                $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'type' => 'required|in:general,event,job-opportunity,urgent-notice',
            ]);
          $announcement->update([
            'title' => $request->title,
            'description' => $request->description,
            'type' => $request->type,
            'is_visible' => $request->is_visible,
        ]);
             return redirect()->route('alumni.announcement')->with('success', 'Announcement updated successfully!');
    }
}
