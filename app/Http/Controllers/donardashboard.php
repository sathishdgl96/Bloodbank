<?php

namespace App\Http\Controllers;

use App\Models\bloodrequest;
use App\Models\medicalprofile;
use App\Models\userprofile;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class donardashboard extends Controller
{
    public function view()
    {
        $email=session("email");
        if(userprofile::where("email",$email)->first())
        {
            $user=userprofile::where("email",$email)->first();
            $blood=$user->blood;
            $requests= bloodrequest::where('status', 3)->where('bloodgroup',$blood)->get();
            $auth=\App\Models\AuthUser::where("email",$email)->first();
            $isActive=$auth->isActive;
            if($isActive==9)
            {
                return redirect()->route('donar-basic-profile')->with('message','your account is under review , please contact admin');
            }
            return view("donar_dashboard",['blood'=>$blood,'requests'=>$requests]);
        }

        else
        {
            return redirect()->route('donar-basic-profile');// asking user to fill profile
        }
    }
    public function donated()
    {
        $id=request('id');
        $donaremail=session("email");
        $lastdonated=Carbon::parse(medicalprofile::where("email",$donaremail)->first()->lastdonated);
        $datetime1 = new \DateTime($lastdonated);
        $datetime2 = new \DateTime(Carbon::now());
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');
        $nextdonation=Carbon::now()->addDays(90-$days)->format('d-m-y');
        if($days<90)
        {
            return redirect()->route('donar-dashboard')->with('errormessage','You cant donate now, as minimum interval between two donations is 90 days. Next eligible donation: '.$nextdonation);
        }
        medicalprofile::where('email', $donaremail)->update(['lastdonated'=>$datetime2]);
        bloodrequest::where('id', $id)->update(['status'=>4,'donaremail'=>$donaremail]);
        return redirect()->route('donar-dashboard')->with('message','You are volunteered to donate,We have shared your contact details with a client');
    }
}
