<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Kullanıcıyı uygun panele yönlendirin.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        // Kullanıcı rolüne göre yönlendirme yapıyoruz
        if (auth()->user()->role === 'admin') {
            // Admin paneline yönlendir
            return redirect()->route('admin.dashboard');
        }

        // Kullanıcı paneline yönlendir
        return redirect()->route('user.dashboard');
    }
}
