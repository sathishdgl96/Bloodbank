<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class userfeedback extends Controller
{
    public function addFeedback()
{
    $rating=request('op1');
    $comments=request('comments');
    return view("feeback_result",['experience'=>$rating,'comments'=>$comments]);
}
public function feedbackmsg()
{
    $status=request('status');
    if($status==1)
    {
        $message="Thanks for your valuable feedback, Your feedback will help us to serve you better";
    }
    else{
        $message="something went wrong, please try again ";
    }
    return view('welcome',['message'=>$message]);
}

}
