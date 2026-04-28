<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Experience;
use App\Models\Profile;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;

class MemberDashboardController extends Controller
{
    public function index(){
        //first getting the info about stats:
        $totalAlumni = User::count()-1;
        $totalEmployed = Profile::where('status','Employed')->count();
        $totalUnEmployed = Profile::where('status','Unemployed')->count();
        // $total = Profile::where('created_at', '>=', Carbon::now()->subDays(2));  Last 3 day job Update
        //Announcement Call : 
        $announcements = Announcement::where('is_visible',1)->get();
        $latestHighlights = Experience::where('updated_at', '>=', Carbon::now()->subDays(1))->get();        return response()->json([
            'status'=> true,
             'data' => [
                'stats' => [
                    'totalAlumni' => $totalAlumni,
                    'totalEmployed' => $totalEmployed,
                    'totalUnemployed' => $totalUnEmployed,
                ],
                'announcements' => $announcements,
                'highlights' => $latestHighlights,
             ]
        ]);
    }
}
