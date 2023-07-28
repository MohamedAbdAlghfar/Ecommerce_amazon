<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()  
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();  
            $table->string('f_name')->nullable();
            $table->string('l_name')->nullable(); 
            $table->string('phone' )->nullable();
            $table->integer('gender')->nullable();   // 0 => male , 1 => female
            $table->string('address')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->integer('kind')->nullable()->default(0);  //admin 1 or user 0 or user&store-manager 2 or admin-in-store 3 or owner  4
            $table->string('profile_image'); 
            $table->rememberToken();
            $table->timestamps();
        });
    } 

    
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
