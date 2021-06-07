<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use MongoDB\Driver\BulkWrite;
use MongoDB\Driver\Manager;
class adminservicearea extends Controller
{
    public function store()
    {
        try {
            $state = request("state");
            $city = request("city");
            $bulk = new BulkWrite();
            $id = rand(1, 10000);
            $document1 = ['_id' => $id, $state => $city];
            $_id1 = $bulk->insert($document1);
            $manager = new Manager('mongodb://localhost:27017');
            $result = $manager->executeBulkWrite('bloodbank.service_area', $bulk);
            return redirect()->route('addservice',['message'=>'success'])->with('message', 'Volia! You are now operating at new area');
        }
        catch (Exception $e)
        {
            return redirect()->route('addservice')->with('message', 'Sorry, something went wrong, please contact software provider');
        }
    }
}
