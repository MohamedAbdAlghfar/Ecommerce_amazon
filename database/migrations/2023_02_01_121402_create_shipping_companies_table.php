<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('shipping_companies', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->string('name');   
            $table->string('phone'); 
            $table->string('website');                         // .. Done ..
            $table->string('email'); 
            $table->string('address');
            $table->string('location'); 
            $table->string('cover_image'); 
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('shipping_companies');
    }
};
