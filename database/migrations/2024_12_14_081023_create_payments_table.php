<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('booking_id'); // Booking tablosuyla ilişki kurmak için
            $table->decimal('key_price', 8, 2);
            $table->decimal('service_fee', 8, 2);
            $table->decimal('rent_price', 8, 2);
            $table->decimal('totalprice', 8, 2);
            $table->decimal('paid_key_price', 8, 2)->nullable();
            $table->decimal('paid_service_fee', 8, 2)->nullable();
            $table->decimal('paid_rent_price', 8, 2)->nullable();
            $table->decimal('paid_amount', 10, 2)->nullable();
            $table->decimal('remaining_amount', 10, 2); // Kalan tutar
            $table->enum('status', ['paid', 'unpaid', 'pending']); // Ödeme durumu
            $table->timestamps();
            
            // İlişkiyi oluşturuyoruz
            $table->foreign('booking_id')->references('id')->on('bookings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
