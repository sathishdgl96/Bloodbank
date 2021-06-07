<?php

namespace App\Http\Controllers;

use App\Models\userprofile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use PHPUnit\Exception;

class bloodrequest extends Controller
{
    public function view()
    {
        if(Session::has('email'))
        {
        $email=session("email");
            if (userprofile::where("email", $email)->first()) {
                $user=userprofile::where("email",$email)->first();
                $name = $user->name;
                $pincode = $user->pincode;
                $blood = $user->blood;
                $phone =$user->phone;
                $address = $user->address;
                $city = $user->city;
                $state = $user->state;
                $country = $user->country;
                return view("bloodrequest",['email'=>$email,'name'=>$name,'pincode'=>$pincode,'blood'=>$blood,'phone'=>$phone,'hospital'=>$address,'city'=>$city,'state'=>$state,'country'=>$country])->with('message',"Prefilled based on your profile, you can change [This will not reflect your profile]");
            }
            else
            {
                return view("bloodrequest");
            }
        }
        else
        {
            return view("bloodrequest");
        }
    }
    public function store()
    {
        $user=new \App\Models\bloodrequest();
        $id=rand(1,100000);
        $user->id=$id;
        $user->email=request("email");
        $user->name = request("name");
        $user->pincode = request("pincode");
       $bloodgroup= $user->bloodgroup = request("bloodgroup");
        $user->phone = request("phone");
        $user->hospitalname = request("hospital");
        $user->city = request("city");
        $user->state = request("state");
        $user->country = request("country");
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
    public function track()
    {
        $id=request("id");
        if (\App\Models\bloodrequest::where("id", $id)->first())
        {
           $user= \App\Models\bloodrequest::where("id", $id)->first();
           $status=$user->status;
           if($status==0)
           {
               return response()->json(['message'=>'Seems suspicious, Cancelled by bloodbank']);
           }
           $date=$user->date;
           $bloodgroup=$user->bloodgroup;
           return response()->json(['status'=>$status,'idnumber'=>$id,'date'=>$date,'bloodgroup'=>$bloodgroup]);
        }
        else
        {
            return response()->json(['message'=>' Search completed, not found']);
        }
    }
    public function viewdonarprofile()
    {
        $id=request("id");
        $donaremail=\App\Models\bloodrequest::where("id",$id)->first()->donaremail;
        $donarcontact=userprofile::where("email",$donaremail)->first();
        $name=$donarcontact->name;
        $phone=$donarcontact->phone;
        $address=$donarcontact->address;
        return response()->json(['id'=>$id,'email'=>$donaremail,'name'=>$name,'phone'=>$phone,'address'=>$address]);
    }
    public function processcompleted()
    {
        $id=request('id');
        try {

            DB::table('bloodrequests')
                ->where('id', $id)->update(['status' => 5]);
            return response()->json(['message'=>'success']);
        }
        catch(\Exception $exception)
        {
            return response()->json(['message'=>'error']);
        }
    }
}
