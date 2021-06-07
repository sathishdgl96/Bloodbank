<?php

namespace App\Http\Controllers;

use App\Models\bloodrequest;
use App\Models\userprofile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class admincontrols extends Controller
{
    public function loginasuser()
    {
        $email=request("email");
        $user = \App\Models\AuthUser::where('email', '=', $email)->firstorfail();
        $usertype=$user::where('email','=',$email)->get('usertype');
        Session::put('email', $email);
        Session::put('UserType',$usertype);
        Session::put('adminlogged','yes');
        return redirect()->route('donar-dashboard');
    }
    public function closesession()
    {
        Session::remove('adminlogged');
        return response()->json(['message'=>'session destroyed']);
    }
    public function restrictuser()
    {
        $email=request("email");
        $action=request("action");
        $user=new \App\Models\AuthUser();
        $user::where('email', $email)->firstorfail();
        $usertype=1;
        $action=1;
        if($action==0) {
            if ($usertype == 2) {
                response()->json(['status' => 'Deleting admin control is restricted']);
            } else {
                DB::table('auth_users')
                    ->where('email', $email)->update(['isactive'=>0]);
                response()->json(['status' => "Your account is disabled successfully, all data will be deleted in 30 days"]);
            }
        }
        elseif($action==1)
        {
            DB::table('auth_users')
                ->where('email', $email)->update(['isactive'=>1]);
            response()->json(['status'=>"Account activated and verified"]);
        }
        elseif ($action==8)
        {
            if ($usertype == 2) {
                response()->json(['status' => 'Deleting admin control is restricted']);
            } else {
                DB::table('auth_users')
                    ->where('email', $email)->update(['isactive'=>8]);
                response()->json(['status' => "Requested Account Deactivated successfully!"]);
            }
        }
        else
        {
            DB::table('auth_users')
                ->where('email', $email)->update(['isactive'=>9]);
            response()->json(['status' => "Requested Account activated successfully!, However user still needs to verify their email"]);
        }
    }
    public function reviewdonar()
    {
        $requests= \App\Models\medicalprofile::where('healthcheck','!=','good')->get();
        return view("donar_review",['requests'=>$requests]);
    }
    public function acceptreview()
    {
        $email=\request('id');
        DB::table('auth_users')
            ->where('email', $email)->update(['isActive'=>1]);
        return redirect()->route("admin-dashboard");
    }
    public function rejectreview()
    {
        $email=\request('id');
        DB::table('auth_users')
            ->where('email', $email)->update(['isActive'=>0]);
        return redirect()->route("admin-dashboard");
    }
}
