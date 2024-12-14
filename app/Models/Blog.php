<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',    // Blog başlığı
        'content',  // Blog içeriği
        'author',   // Yazar (isteğe bağlı)
        'published_at',  // Yayınlanma tarihi (isteğe bağlı)
    ];

    // İhtiyaç duyuluyorsa diğer ilişkiler ve fonksiyonlar buraya eklenebilir
}
