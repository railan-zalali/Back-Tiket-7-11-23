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
        Schema::create('tikets', function (Blueprint $table) {
            $table->id('ticketId');
            $table->unsignedBigInteger('booking_id');
            $table->unsignedBigInteger('ticket_type_id');
            $table->double('price');
            $table->timestamps();

            $table->foreign('booking_id')->references('bookingId')->on('bookings');
            $table->foreign('ticket_type_id')->references('typeId')->on('ticket_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
