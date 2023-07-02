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
            $table->string('Gender',6)->nullable();
            $table->string('Address')->nullable()->default('cairo');
            $table->string('Email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('Password');
            $table->integer('Kind')->nullable()->default(1);  //admin or user or user&store-manager or admin-in-store or owner
            $table->rememberToken()->nullable();
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
