<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserprofilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('userprofiles', function (Blueprint $table) {
            $table->timestamps();
            $table->string("email",100)->primary();
            $table->string("name",50);
            $table->date("dob");
            $table->string("gender",10);
            $table->string("blood",3);
            $table->string("phone",12);
            $table->string("address",500);
            $table->string("city",20);
            $table->string("state",100);
            $table->string("country",50);
            $table->integer("pincode");
        });
    }

    public function down()
    {
        Schema::dropIfExists('userprofiles');
    }
}
