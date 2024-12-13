<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

    protected $table = 'rooms';

    protected $fillable = [
        'name',
        'description',
        'price',
        'location',
        'available_from',
        'available_until',
        'status',
        'service_fee',
        'key_price',
        'rent_price',
    ];

    // İlişkiler
    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'room_tag', 'room_id', 'tag_id');
    }

    public function photos()
    {
        return $this->hasMany(Photo::class);
    }

    // Toplam fiyat hesaplama
    public function getTotalPriceAttribute()
    {
        return ($this->service_fee ?? 0) + ($this->key_price ?? 0) + ($this->rent_price ?? 0);
    }

    // Price mutator
    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = ($this->service_fee ?? 0) + ($this->key_price ?? 0) + ($this->rent_price ?? 0);
    }
}
