<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('store_id')->constrained(); 
            $table->foreignId('user_id')->constrained(); 
            $table->tinyInteger('response')->nullable(); // if it were 1 user accept if 0 user refuse and only user have access to but a value on this column or disable all request 
            $table->string('message')->default('We Wish You Accept To Work With Us IN Our Store .!');
            $table->string('store_name')->nullable();
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
        Schema::dropIfExists('requests');
    }
};
