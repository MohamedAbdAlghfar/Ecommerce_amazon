<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('categories', function (Blueprint $table) { 
            $table->bigIncrements('id')->unsigned();          
            $table->string('name')->nullable();             
            $table->unsignedInteger('parent_id');  
            $table->string('image'); 
           // $table->integer('Ordering')->nullable();
           // $table->biginteger('Store_Id')->nullable();        
            $table->timestamps();
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('categories');
    }
};
