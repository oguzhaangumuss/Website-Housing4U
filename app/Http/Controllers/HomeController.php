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
    if (auth()->check()) {
        return $this->redirectToDashboard();
    }

    return redirect()->route('login');
}

    protected function redirectToDashboard()
{
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }

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
