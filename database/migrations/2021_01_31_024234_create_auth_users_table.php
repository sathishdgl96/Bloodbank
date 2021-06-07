<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuthUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('auth_users', function (Blueprint $table) {

            $table->string('email',50)->primary()->comment("This will be primary key for entire db");
            $table->string('password',100);
            $table->integer('usertype',)->comment("0=>donar,1=>hospital,2=>admin")->default(0);
            $table->smallInteger('isActive')->comment("0=>deleted,1=>active,8=>deactivated,9=>unverfied")->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('auth_users');
    }
}
