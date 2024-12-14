<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = 'payments';

    protected $fillable = [
        'booking_id',
        'remaining_amount',
        'status',
        'key_price',
        'paid_key_price',
        'service_fee',
        'paid_service_fee',
        'rent_price',
        'paid_rent_price',
        'totalprice',
        'paid_amount',
    ];

    // Her ödeme bir rezervasyona aittir
    public function booking()
    {
        return $this->belongsTo(Booking::class); // Payment, Booking ile ilişkilidir
    }
}
