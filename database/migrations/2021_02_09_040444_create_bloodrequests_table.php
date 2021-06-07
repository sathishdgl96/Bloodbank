<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBloodrequestsTable extends Migration
{

    public function up()
    {
        Schema::create('bloodrequests', function (Blueprint $table) {
            $table->id();
            $table->string("name",20);
            $table->string("email",100);
            $table->string("hospitalname",100);
            $table->string("city",50);
            $table->string("state",100);
            $table->string("country",50)->default("india");
            $table->string("pincode",7);
            $table->string("phone",14);
            $table->string("bloodgroup",3);
            $table->integer("units");
            $table->date("date");
            $table->string("notes",255);
            $table->integer("status")->default(1)->comment("1=> requested,2=>viewed by bloodbank,3=>approved,4=>donarassigned,5=>completed,0=>cancelled");
            $table->string("donaremail",100)->default(NULL)->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bloodrequests');
    }
}
