<?php

namespace App\Http\Controllers;
use App\Models\userprofile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use function mysql_xdevapi\getSession;

class donarprofile extends Controller
{
    public function view()
    {
        session_start();
        $email=session("email");
        if(userprofile::where("email",$email)->first())
        {
           $user=userprofile::where("email",$email)->first();
           $name=$user->name;
            $dob=$user->dob;
            $pincode=$user->pincode;
            $city=$user->city;
            $country=$user->country;
            $phone=$user->phone;
            $blood=$user->blood;
            $address=$user->address;
            $gender=$user->gender;
            $state=$user->state;

           return view("donar_profile",['name'=>$name,'dob'=>$dob,'gender'=>$gender,'state'=>$state,'address'=>$address,'phone'=>$phone,'pincode'=>$pincode,'city'=>$city,'country'=>$country,'blood'=>$blood]);
        }
        else
        {
            return view("donar_profile")->with('message','It seems like you are new, Kindly fill profile to view dashboard');
        }
    }
    public function store()
    {
        session_start();
        $email=session("email");
        $user=new userprofile();
        if(userprofile::where("email",$email)->first())
        {
            $name=request("name");
            $pincode=request("pincode");
            $email=$email;
            $gender=request("gender");
            $blood=request("blood");
            $phone=request("phone");
            $address=request("address");
            $city=request("city");
            $state=request("state");
            $country=request("country");
            $dob=request("dob");
            DB::table('userprofiles')
                ->where('email', $email)->update(['name'=>$name,'dob'=>$dob,'gender'=>$gender,'state'=>$state,'address'=>$address,'phone'=>$phone,'pincode'=>$pincode,'city'=>$city,'country'=>$country,'blood'=>$blood]);
            return redirect()->route('medical_profile')->with('message','Your Basic Profile is Successfully updated');
        }
        else
        {
            $user->name=request("name");
            $user->pincode=request("pincode");
            $user->email=$email;
            $user->blood=request("blood");
            $user->gender=request("gender");
            $user->phone=request("phone");
            $user->address=request("address");
            $user->city=request("city");
            $user->state=request("state");
            $user->country=request("country");
            $user->dob=request("dob");
            $user->save();
            return redirect()->route('medical_profile')->with('message','Thanks for filling out your basic profile');
        }

    }
}
