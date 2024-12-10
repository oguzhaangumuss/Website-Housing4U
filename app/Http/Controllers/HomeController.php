<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Kullanıcı giriş yaptıysa dashboard'a yönlendir
        if (auth()->check()) {
            return $this->redirectToDashboard();
        }

        // Kullanıcı giriş yapmamışsa login sayfasına yönlendir
        return redirect()->route('login');
    }

    /**
     * Kullanıcıyı rolüne göre dashboard'a yönlendir
     *
     * @return \Illuminate\Http\Response
     */
    protected function redirectToDashboard()
    {
        $user = auth()->user();

        // Admin rolüne sahip kullanıcıyı admin dashboard'a yönlendir
        if ($user->hasRole('admin')) {
            return redirect()->route('admin.dashboard');
        }

        // Kullanıcı rolüne sahip kullanıcıyı user dashboard'a yönlendir
        return redirect()->route('user.dashboard');
    }

    // Welcome sayfasını döndür
    public function welcome()
    {
        return view('welcome');
    }

    // Hakkında sayfasını döndür
    public function about()
    {
        return view('about');
    }

    // Hizmetler sayfasını döndür
    public function services()
    {
        return view('services');
    }

    // Odalar sayfasını döndür
    public function rooms()
    {
        return view('rooms');
    }

    // İletişim sayfasını döndür
    public function contact()
    {
        return view('contact');
    }
}
