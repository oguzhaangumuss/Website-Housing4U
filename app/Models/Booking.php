<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'room_id',
        'user_id',   // Kim rezervasyonu yaptı
        'available_from',
        'available_until',
        'status'
    ];

    // Bir rezervasyon bir odaya aittir
    public function room()
    {
        return $this->belongsTo(Room::class);
    }
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
