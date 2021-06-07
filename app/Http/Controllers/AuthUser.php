<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\Types\Integer;


class authUser extends Controller
{
    public function register()
    {
        $user = new \App\Models\AuthUser();
        if ($user::where('email', '=', request('email'))->exists()) {
            $message = "User already exists";
            return view("login", ['message' => $message]);
        }
        $user->email = request('email');
        $hashed = Hash::make(request('password'));
        $user->password = $hashed;
        $usertype = request('userType');
        $user->usertype = $usertype;
        $user->isActive = 1;
        $user->save();
        Session::put('email', request("email"));
        Session::put('UserType', request("usertype"));
        $message = "Welcome To blood bank, Your registration success, please verify your mail";
        if ($usertype == 0) {
            return view('donar_profile', ['gender' => 'male', 'state' => null, 'country' => 'india', 'city' => null])->with('message', $message);
        }
        elseif ($usertype==1)
        {
            return view('hospital_profile',[] )->with('message', $message);
        }
        else
        {
            return view('welcome')->with('message','something went wrong, contact admin');
        }
    }
    public function login()
    {
        $email = request('email');
        $password = request('password');
        $user = \App\Models\AuthUser::where('email', '=', $email)->first();
        if (Hash::check($password, $user->password))
        {
        $status=$user->isActive;
            if($status==0)
            {
                return redirect()->route('welcome')->with('errormessage', 'Your account is disabled and will be deleted in 30 days, Contact admin');
            }
            if($status==8)
            {
                return redirect()->route('welcome')->with('errormessage', 'Your account is deactivated, Contact admin');
            }
            $usertype=$user->usertype;
            Session::put('email', $email);
            Session::put('usertype',$user->usertype);
            if($usertype==0) {
                return redirect()->route('donar-dashboard');
            }
            elseif ($usertype==1)
            {
                return redirect()->route('hospital-dashboard');
            }
        }
        else
        {
            $message="Invalid Username or passeword";
            return view("login",['message'=>$message]);
        }

    }
    public function requestByGet()
    {
        return view("login");
    }
    public function logout()
    {
        Session::remove('email');
        Session::remove('UserType');
        return redirect()->route('welcome')->with('message','You have been logged out');
    }
}
