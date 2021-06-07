<?php

namespace App\Http\Controllers;

use App\Models\userprofile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class hospital extends Controller
{

    public function view()
    {
        session_start();
        $email=session("email");
        if(userprofile::where("email",$email)->first())
        {
            $user=userprofile::where("email",$email)->first();
            $name=$user->name;
            $pincode=$user->pincode;
            $city=$user->city;
            $country=$user->country;
            $phone=$user->phone;
            $address=$user->address;
            $state=$user->state;
            return view("hospital_profile",['name'=>$name,'state'=>$state,'address'=>$address,'phone'=>$phone,'pincode'=>$pincode,'city'=>$city,'country'=>$country]);
        }
        else
        {
            return view("hospital_profile")->with('message','It seems like you are new, Kindly fill profile to request blood');
        }
    }
  public function dashboard()
  {
      $email=session("email");
      if(userprofile::where("email",$email)->first()) {
          return view('hospital-request-blood');
      }
      else
      {
          return redirect()->route('hospital-profile')->with('message','Fill profile to request blood');
      }
  }
  public function reports()
  {
      $email=session('email');
      $inprogress = \App\Models\bloodrequest::where('email', $email)->get();
      if(userprofile::where("email",$email)->first()) {
          return view('hospital-reports',['inprogress'=>$inprogress]);
      }
      else
      {
          return redirect()->route('hospital-profile')->with('message','Kindly fill profile to view your personalized reports');
      }
  }
  public function updateprofile()
  {
      session_start();
      $email=session("email");
      $user=new userprofile();
      if(userprofile::where("email",$email)->first())
      {
          $name=request("name");
          $pincode=request("pincode");
          $phone=request("phone");
          $address=request("address");
          $city=request("city");
          $state=request("state");
          $country=request("country");
          DB::table('userprofiles')
              ->where('email', $email)->update(['name'=>$name,'state'=>$state,'address'=>$address,'phone'=>$phone,'pincode'=>$pincode,'city'=>$city,'country'=>$country]);
          return redirect()->route('hospital-profile')->with('message','Your Hospital Profile is Successfully updated');
      }
      else
      {
          $user->name=request("name");
          $user->pincode=request("pincode");
          $user->email=$email;
          $user->blood='NA';
          $user->gender='NA';
          $user->phone=request("phone");
          $user->address=request("address");
          $user->city=request("city");
          $user->state=request("state");
          $user->country=request("country");
          $user->dob=date_create("1999-01-01");
          $user->save();
          return redirect()->route('hospital-profile')->with('message','Thanks for filling out your basic profile');
      }

  }
  public function requestblood()
  {
      $email=session('email');
      $id=rand(1,100000);
      $hospital=userprofile::where("email",$email)->first();
      $user=new \App\Models\bloodrequest();
      $user->id=$id;
      $user->email=$email;
      $user->name = request("name");
      $user->pincode =$hospital->pincode;
      $bloodgroup= $user->bloodgroup = request("bloodgroup");
      if(request('phone')!=null) {
          $user->phone = request("phone");
      }
      else
      {
          $user->phone=$hospital->phone;
      }
      $user->hospitalname = $hospital->address;
      $user->city =$hospital->city;
      $user->state =$hospital->state;
      $user->country = $hospital->country;
      $user->date=request("date");
      $user->units=request("units");
      $user->notes=request("note");
      try {
          $user->save();
          return redirect()->route("trackrequest")->with('message','Your request is successfully placed and tracking id is '.$id)->withCookie(cookie('id', $id, 10))->withCookie(cookie('status',1,10))->withCookie(cookie('bloodgroup',$bloodgroup,10));
      }
      catch (Exception $e)
      {
          return back()->with('errormessage',"Internal Error occured, please try after some time");
      }

  }
}
