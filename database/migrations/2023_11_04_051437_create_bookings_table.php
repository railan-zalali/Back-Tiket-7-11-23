<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id('bookingId');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('event_id');
            $table->date('bookingDate');
            $table->unsignedBigInteger('status_id');
            $table->timestamps();

            $table->foreign('user_id')->references('userId')->on('users');
            $table->foreign('event_id')->references('event_id')->on('events');
            $table->foreign('status_id')->references('status_id')->on('booking_statuses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
