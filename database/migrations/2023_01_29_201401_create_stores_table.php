<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    
    public function up()
    {
        Schema::create('stores', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
          //$table->foreignId('user_id')->constrained();
            $table->string('name'); 
            $table->string('about_store',500);   
            $table->string('phone');                                      // .. Done ..
            $table->string('link_website')->nullable();
            $table->string('services',500);    
            $table->string('location');  
            $table->string('email');
       //     $table->string('store_cover');
       //     $table->string('store_image');  
            $table->unsignedBigInteger('deleted_by')->nullable();
            $table->foreign('deleted_by')->references('id')->on('users');
            $table->timestamps();
        });
    }

    
    public function down()
    {
        $table->dropForeign(['deleted_by']); 
        $table->dropColumn('deleted_by');
        Schema::dropIfExists('stores');
    }
};
