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
            $table->foreign('store_id')->references('id')->on('stores');
            $table->tinyInteger('gender')->nullable();   // 0 => male , 1 => female
            $table->tinyInteger('age')->nullable();
            $table->string('address')->nullable();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->tinyInteger('role')->nullable()->default(0);  // .. user=0 || Owner-assistant=1 || Owner=4 || Store-Owner=2 || Store-Admin=3 || shipping_combany-Admin=5..
            $table->string('profile_image')->default('jpg.jpg');  
            $table->rememberToken();
            $table->timestamps();
        });
    } 

    
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
