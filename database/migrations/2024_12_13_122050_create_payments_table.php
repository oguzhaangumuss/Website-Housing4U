<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id(); // Benzersiz ID
            $table->foreignId('booking_id')->constrained()->onDelete('cascade'); // Hangi kiralamaya ait ödeme yapılıyor
            $table->date('payment_date'); // Ödeme tarihi
            $table->decimal('amount', 8, 2); // Yapılan ödeme tutarı
            $table->string('status'); // Ödeme durumu (tamamlanmış, beklemede vs.)
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
        Schema::dropIfExists('payments');
    }
}
