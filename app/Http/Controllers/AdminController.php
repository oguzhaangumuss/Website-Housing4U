<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{

    public function dashboard()
    {
        // Tüm kullanıcı sayısını al
        $usersCount = User::count();
        // Dashboard view'ına kullanıcı sayısını ve kullanıcıyı gönder
        return view('admin.dashboard', compact('usersCount')); // resources/views/admin/dashboard.blade.php
    }
    public function adminprofile()
    {
        // İlgili view dosyasını döndürüyoruz
        return view('admin.adminprofile');
    }

  
  
}
