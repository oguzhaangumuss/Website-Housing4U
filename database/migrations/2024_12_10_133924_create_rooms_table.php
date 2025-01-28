<?php

namespace Database\Migrations;

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
        Schema::create('rooms', function (Blueprint $table) {
            $table->id();  // Odanın benzersiz ID'si
            $table->string('name');  // Odanın adı
            $table->text('description');  // Odanın açıklaması
            $table->decimal('price', 10, 2);  // Odanın fiyatı (örneğin: 100.00)
            $table->decimal('key_price', 10, 2)->nullable(); 
            $table->decimal('service_fee', 10, 2)->nullable(); 
            $table->decimal('rent_price', 10, 2)->nullable(); // Anahtar ücreti
            $table->string('location');  // Odanın konumu (adres)
            $table->date('available_from');  // Odanın kullanılabilir olduğu tarih
            $table->date('available_until');  // Odanın kullanılabilir olduğu bitiş tarihi
            $table->enum('status', ['available', 'booked', 'under_maintenance'])->default('available');  // Odanın durumu
            $table->timestamps();  // Oluşturulma ve güncellenme tarihleri
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rooms');
    }
};
