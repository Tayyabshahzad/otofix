<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('workshop_id');
            $table->foreign('workshop_id')->references('id')->on('workshops')->onDelete('cascade');
            $table->unsignedBigInteger('quote_id');
            $table->foreign('quote_id')->references('id')->on('quotes')->onDelete('cascade');
            $table->unsignedBigInteger('accepted_quotes_id');
            $table->foreign('accepted_quotes_id')->references('id')->on('accepted_quotes')->onDelete('cascade');
            $table->integer('booking_number')->unique();
            $table->integer('discount');
            $table->integer('total');
            $table->float('tax')->default(0.00);
            $table->enum('payment_method',['cash','stripe']);
            $table->boolean('payment_clear')->default(false);
            $table->float('admin_commission');
            $table->enum('status',['pending','ongoing','completed','cancelled']);
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
        Schema::dropIfExists('bookings');
    }
}
