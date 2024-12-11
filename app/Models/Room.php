<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';  // Kullanılacak tablo adı
    protected $fillable = [
        'name',
        'description',
        'price',
        'location',
        'available_from',
        'available_until',
        'status',
    ];

    // İlişkiler, örneğin bir oda birçok kiralamaya sahip olabilir
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }
}
