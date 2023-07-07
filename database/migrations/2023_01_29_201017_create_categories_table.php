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
            $table->integer('Price')->nullable();
            $table->integer('Discount')->nullable();
            $table->integer('Available_Bices')->nullable();
            $table->integer('Weight')->nullable();
            $table->string('Color')->nullable();
            $table->string('Col_1')->nullable();
            $table->integer('Buy')->nullable();
            $table->string('Description',500)->nullable(); 
            $table->string('Col_2')->nullable();
            $table->string('Col_3')->nullable();
            $table->string('Col_4')->nullable();
            $table->string('About',500)->nullable();  
            $table->string('Name')->nullable();
            $table->string('Brand')->nullable();
            $table->unsignedInteger('Parent_id')->nullable();
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
