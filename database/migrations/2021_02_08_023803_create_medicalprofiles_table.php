<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicalprofilesTable extends Migration
{
    public function up()
    {
        Schema::create('medicalprofiles', function (Blueprint $table) {
            $table->timestamps();
            $table->string("email",50)->primary();
            $table->string("healthcheck",100);
            $table->string("haemoglobin",100);
            $table->integer("bmi");
            $table->integer("Isalcohol");
            $table->date("lastdonated");
            $table->integer("interval");
        });
    }


    public function down()
    {
        Schema::dropIfExists('medicalprofiles');
    }
}
