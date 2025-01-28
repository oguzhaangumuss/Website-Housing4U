<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Room;

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
        if ($user->hasRole('user')) {
            return redirect()->route('user.dashboard');
        }

        // Tanımlanmamış bir rol varsa 403 hatası döndür
        return abort(403, 'Rolünüz tanimlanmadi');
    }

    // Welcome sayfasını döndür
    public function welcome()
    {
        // Odaları al
        $rooms = Room::all(); // Veya başka bir sorgu ile uygun odaları alabilirsiniz.
        
        // Odaları 'welcome' view'ine gönder
        return view('home.pages.welcome', compact('rooms'));
    }
    

    public function profilesettings()
    {
        return view('profile-settings');
    }
    // Hakkında sayfasını döndür
    public function about()
    {
        return view('home.pages.about');
    }

    // Hizmetler sayfasını döndür
    public function services()
    {
        return view('home.pages.services');
    }

    // Odalar sayfasını döndür
    public function rooms(Request $request)
    {
        $query = Room::query();

        // Price Range Filter
        if ($request->price_range) {
            list($min, $max) = explode('-', $request->price_range);
            if ($max == '+') {
                $query->where('price', '>=', $min);
            } else {
                $query->whereBetween('price', [$min, $max]);
            }
        }

        // Room Type Filter
        if ($request->type) {
            $query->where('type', $request->type);
        }

        // Beds Filter
        if ($request->beds) {
            if ($request->beds == '3') {
                $query->where('bed_count', '>=', 3);
            } else {
                $query->where('bed_count', $request->beds);
            }
        }

        // Wifi Filter
        if ($request->wifi) {
            $query->where('has_wifi', true);
        }

        // Sort options
        $sort = $request->sort ?? 'price-asc';
        switch ($sort) {
            case 'price-desc':
                $query->orderBy('price', 'desc');
                break;
            case 'price-asc':
                $query->orderBy('price', 'asc');
                break;
            case 'name-asc':
                $query->orderBy('name', 'asc');
                break;
            case 'name-desc':
                $query->orderBy('name', 'desc');
                break;
        }

        $rooms = $query->paginate(9);
        
        return view('home.pages.rooms', compact('rooms'));
    }

    // İletişim sayfasını döndür
    public function contact()
    {
        return view('home.pages.contact');
    }
}
