<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Admin rolüne sahip kullanıcıyı admin dashboard'a yönlendir
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        // User rolüne sahip kullanıcıyı user dashboard'a yönlendir
        if ($user->hasRole('user')) {
            return redirect()->route('user.dashboard');
        }

        // Tanımlanmamış bir rol varsa 403 hatası döndür
        return abort(403, 'Rolünüz tanımlanmadı');
    }
}
