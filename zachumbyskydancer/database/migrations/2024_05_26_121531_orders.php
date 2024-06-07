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
            $table->id('order_id');
            $table->string('order_date');
            $table->integer('customer_id');
            $table->foreign('customer_id')->references('customer_id')->on('customer');
            $table->unsignedBigInteger('payment_id');
            $table->foreign('payment_id')->references('payment_id')->on('payment');
            $table->unsignedBigInteger('contactNo');
            $table->string('customer_address');
            $table->string('additional_notes')->nullable();
            $table->json('item_ids');
            $table->string('order_status')->default('Pending');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
