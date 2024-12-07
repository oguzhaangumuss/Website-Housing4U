<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class HomeController extends Controller
{
    

    public function index()
    {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
    
        return redirect()->route('user.dashboard');
    }
    public function welcome() {
        return view('welcome');
    }
    public function about() {
        return view('about');
    }
    public function services() {
        return view('services');
    }
    public function rooms() {
        return view('rooms');
    }
    public function contact() {
        return view('contact');
    }
}
