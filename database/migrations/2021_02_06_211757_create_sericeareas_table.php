<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSericeareasTable extends Migration
{
    public function up()
    {
        Schema::create('sericeareas', function (Blueprint $table) {
            $table->id();
            $table->string("state");
            $table->string("city");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sericeareas');
    }
}
