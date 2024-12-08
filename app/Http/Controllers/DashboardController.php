<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
   
public function index()
{
    $user = Auth::user();

    if ($user->hasRole('admin')) {
        return redirect()->route('admin.dashboard');
    }

    if ($user->hasRole('user')) {
        return redirect()->route('user.dashboard');
    }

    return abort(403, 'Rolünüz tanımlanmadı');
}
}
