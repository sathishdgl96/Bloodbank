<?php

namespace App\Http\Controllers;

use App\Models\medicalprofile;
use App\Models\userprofile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class medical_profile extends Controller
{
    public function store()
    {
        session_start();
        $email=session("email");
        $user=new medicalprofile();
        if(medicalprofile::where("email",$email)->first())
        {
            $data=request()->validate([
                'healthcheck'=>'required',
                'haemoglobin'=>'required | numeric |min:10|max:20',
                'bmi'=>'required | numeric |min:18',
                'Isalcohol'=>'required|regex:[0]',
                'lastdonated'=>'required',
                'interval'=>'required'

            ],
            [
                'Isalcohol.regex'=>"Alcoholic person is not allowed"
           ]
        );
            $healthcheck=request("healthcheck");
            if($healthcheck!='good')
            {
                DB::table('auth_users')
                    ->where('email', $email)->update(['isActive'=>9]);

            }
            $haemoglobin=request("haemoglobin");
            $bmi=request("bmi");
            $Isalcohol=request("Isalcohol");
            $lastdonated=request("lastdonated");
            $interval=request("interval");
            DB::table('medicalprofiles')
                ->where('email', $email)->update(['email'=>$email,'haemoglobin'=>$haemoglobin,'bmi'=>$bmi,'healthcheck'=>$healthcheck,'Isalcohol'=>$Isalcohol,'lastdonated'=>$lastdonated,'interval'=>$interval]);
            return redirect()->route('donar-dashboard')->with('message','Your Medical Profile is Successfully updated');
        }
        else
        {
            $data=request()->validate([
                'healthcheck'=>'required',
                'haemoglobin'=>'required | numeric |min:10|max:20',
                'bmi'=>'required | numeric |min:18',
                'Isalcohol'=>'required|regex:[0]',
                'lastdonated'=>'required',
                'interval'=>'required'

            ],
                [
                    'Isalcohol.regex'=>"Alcoholic person is not allowed"
                ]
            );
            $user->email=$email;
            $user->healthcheck=request("healthcheck");
            if(request('healthcheck')!='good')
            {
                DB::table('auth_users')
                    ->where('email', $email)->update(['isActive'=>9]);
            }
            $user->haemoglobin=request("haemoglobin");
            $user->bmi=request("bmi");
            $user->Isalcohol=request("Isalcohol");
            $user->lastdonated=request("lastdonated");
            $user->interval=request("interval");
            $user->save();
            return redirect()->route('donar-dashboard')->with('message','Progress: 100% : You can now access donate now and reports section');
        }

    }
    public function view()
    {
        session_start();
        $email=session("email");
        if(medicalprofile::where("email",$email)->first())
        {
            $user=medicalprofile::where("email",$email)->first();
            $healthcheck=$user->healthcheck;
            $haemoglobin=$user->haemoglobin;
            $bmi=$user->bmi;
            $isalcohol= $user->Isalcohol;
            $lastdonated=$user->lastdonated;
            $interval=$user->interval;

            return view("donar_medical_profile",['healthcheck'=>$healthcheck,'haemoglobin'=>$haemoglobin,'bmi'=>$bmi,'isalcohol'=>$isalcohol,'lastdonated'=>$lastdonated,'interval'=>$interval]);
        }
        else
        {
            return view("donar_medical_profile")->with('message','It seems like you are new, Kindly fill profile to view dashboard');
        }
    }
}
