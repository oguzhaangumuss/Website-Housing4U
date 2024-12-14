<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    protected $table = 'bookings';

    protected $fillable = [
        'room_id', 'user_id', 'name', 'description', 'key_price', 
        'service_fee', 'rent_price', 'price', 'available_from', 
        'available_until', 'status' , 'payment_status',
    ];

    // Bir rezervasyon bir odaya aittir
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function user()
{
    return $this->belongsTo(User::class);
}
public function payment()
{
    return $this->hasOne(Payment::class);
}

}
