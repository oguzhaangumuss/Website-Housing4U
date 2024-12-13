<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'photos';

    // Bu modelin hangi alanlarının doldurulabileceğini belirtir
    protected $fillable = ['room_id', 'path'];

    // Oda ile ilişkiyi tanımlar
    public function room()
    {
        return $this->belongsTo(Room::class);
    }}
