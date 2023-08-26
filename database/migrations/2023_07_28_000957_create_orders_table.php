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
        Schema::create('orders', function (Blueprint $table) { 
            $table->id();
            $table->integer('price')->nullable();   
            $table->foreignId('user_id')->constrained();
            $table->tinyInteger('status')->nullable();
            $table->foreignId('shipping_company_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained(); 
            $table->foreignId('store_id')->constrained(); 
            $table->string('location')->nullable();
            $table->datetime('trans_date');
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
        Schema::dropIfExists('orders');
    }
};
