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
        Schema::create('payment', function (Blueprint $table) {
            $table->id('payment_id');
            $table->integer('customer_id');
            $table->foreign('customer_id')->references('customer_id')->on('customer');
            $table->string('payment_method');
            $table->integer('grand_total');
            $table->integer('Jrl_No')->nullable();
            $table->string('payment_status')->default('Pending');
            $table->string('date');
            $table->integer('tax')->default(25);
            $table->integer('service_charge')->default(25);
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
