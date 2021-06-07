<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class home extends Controller
{
    public function view()
    {
        $donar=\App\Models\AuthUser::where('usertype',0)->count();
        $saved=\App\Models\bloodrequest::where('status',5)->count();
        $request_recv=\App\Models\bloodrequest::all()->count();
        return view("welcome ", ['donar'=>$donar,'saved'=>$saved,'requests'=>$request_recv]);

    }
}
