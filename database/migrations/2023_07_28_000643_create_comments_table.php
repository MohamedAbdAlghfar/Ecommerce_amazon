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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('body', 500);
            $table->tinyInteger('type')->nullable(); // if type = 1 it were question , if it = 2 , it were rate , if it = 3 it were reply to question
            $table->unsignedInteger('parent_id')->nullable();
            $table->foreignId('product_id')->constrained()->nullable();
            $table->float('rate')->nullable();
            $table->foreignId('user_id')->constrained();
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
        Schema::dropIfExists('comments');
    }
};
