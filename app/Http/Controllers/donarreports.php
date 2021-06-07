<?php

namespace App\Http\Controllers;

use App\Models\medicalprofile;
use App\Models\userprofile;
use Carbon\Carbon;
use Illuminate\Http\Request;

class donarreports extends Controller
{
    public function inprogress()
    {
        $donaremail = session("email");
        if (userprofile::where("email", $donaremail)->first()) {
            $inprogress = \App\Models\bloodrequest::where('donaremail', $donaremail)->where('status', 4)->get();
            $completed = \App\Models\bloodrequest::where('donaremail', $donaremail)->where('status', 5)->get();
            $lastdonated = Carbon::parse(medicalprofile::where("email", $donaremail)->first()->lastdonated);
            $datetime1 = new \DateTime($lastdonated);
            $datetime2 = new \DateTime(Carbon::now());
            $interval = $datetime1->diff($datetime2);
            $days = $interval->format('%a');
            $nextdonation = Carbon::now()->addDays(90 - $days)->format('d-m-y');
            if ($days < 90) {
                $nextdonation = 'You cant donate now, as minimum interval between two donations is 90 days. Next eligible donation: ' . $nextdonation;
            } else {
                $nextdonation = 'you are eligible for next donation';
            }
            return view('donar-reports', ['inprogress' => $inprogress, 'email' => $donaremail, 'completed' => $completed, 'nextdonation' => $nextdonation]);
        }
        else
        {
            return view("donar_profile")->with('message','It seems like you are new, Kindly fill profile to view reports');
        }
    }
}
