<?php

namespace App\Http\Controllers;

use App\Models\bloodrequest;
use App\Models\userprofile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class adminbloodrequests extends Controller
{
    public function view()
    {
       $requests= bloodrequest::where('status', 1 or 2 or 3)->get();
        return view("viewbloodrequests",['requests'=>$requests]);
    }
    public function viewparticular()
    {
        $id=request("id");
        $requests=bloodrequest::where("id",$id)->first();
        $phone=$requests->phone;
        $name=$requests->name;
        $notes=$requests->notes;
        $date=$requests->date;
        $address=$requests->hospitalname;
        DB::table('bloodrequests')
            ->where('id', $id)->update(['status'=>2]);
        return response()->json(['id'=>$id,'phone'=>$phone,'name'=>$name,'date'=>$date,'address'=>$address,'notes'=>$notes]);
    }
    public function approverequest()
{
    $id=request("id");
    DB::table('bloodrequests')
        ->where('id', $id)->update(['status'=>3]);
    return back();
}
}
