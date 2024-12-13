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
            $table->id(); // Kiralama için benzersiz ID
            $table->foreignId('room_id')->constrained()->onDelete('cascade'); // Odaya ait ID, odanın silinmesi durumunda booking de silinsin
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Kullanıcıya ait ID, kullanıcı silinirse booking de silinsin
            $table->date('available_from'); // Kiralamanın başlama tarihi
            $table->date('available_until'); // Kiralamanın bitiş tarihi
            $table->string('status')->default('pending'); // Kiralamanın durumu (pending, booked, completed vb.)
            $table->decimal('total_payment', 10, 2); // Oda için toplam ödeme tutarı
            $table->decimal('paid_amount', 10, 2)->default(0); // Ödenen miktar
            $table->decimal('remaining_amount', 10, 2); // Kalan ödeme tutarı
            $table->timestamps(); // Created at ve Updated at tarihleri
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
