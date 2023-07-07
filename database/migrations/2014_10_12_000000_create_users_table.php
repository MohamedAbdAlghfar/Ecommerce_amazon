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
            $table->string('F_Name')->nullable();
            $table->string('L_Name')->nullable();
            $table->string('Phone' )->nullable();
            $table->integer('Gender')->nullable();   // 0 => male , 1 => female
            $table->string('Address')->nullable();
            $table->string('Email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('Password');
            $table->integer('Kind')->nullable()->default(0);  //admin 1 or user 0 or user&store-manager 2 or admin-in-store 3 or owner  4
            $table->rememberToken();
            $table->timestamps();
        });
    } 

    
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
