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
            $table->unsignedBigInteger('room_id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->text('description');
            $table->decimal('key_price', 8, 2);
            $table->decimal('service_fee', 8, 2);
            $table->decimal('rent_price', 8, 2);
            $table->decimal('price', 8, 2);
            $table->date('available_from');
            $table->date('available_until');
            $table->enum('status', ['available', 'booked', 'under_maintenance']);
            $table->enum('payment_status', ['Payment Pending', 'Payment Completed', 'Payment Cancel']);
            $table->timestamps();
        
            // İlişkiler
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
