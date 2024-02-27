<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('offers', function (Blueprint $table) {
            $table->id();
            $table->integer('price')->nullable(); 
            $table->string('name')->nullable();
            $table->string('about')->nullable();  
            $table->tinyInteger('custom')->nullable();// this to know if offer for public = 0 or for customers = 1
            $table->tinyInteger('status')->nullable(); // .. to know offer is active = 1 or no = 0 ..
            $table->tinyInteger('no_pieces')->nullable(); // that used when offer contains just one product but many pices , then this be the number of pices 
            $table->foreignId('store_id')->constrained(); 
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('offers');
    }
};
