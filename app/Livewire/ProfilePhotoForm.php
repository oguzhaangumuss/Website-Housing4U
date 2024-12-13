<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfilePhotoForm extends Component
{
    use WithFileUploads;

    public $photo; // Fotoğraf değişkeni

    // Fotoğraf güncelleme işlemi
    public function updateProfilePhoto()
    {
        // Validation
        $this->validate([
            'photo' => ['required', 'image', 'mimes:jpg,jpeg,png', 'max:1024'], // Yalnızca geçerli fotoğraf dosyaları
        ]);

        $user = Auth::user();

        // Fotoğrafı depolama
        $path = $this->photo->store('profile-photos', 'public'); // Fotoğrafı storage/public dizinine kaydet
        
        // Fotoğrafın URL'sini almak
        $url = Storage::disk('public')->url($path);

        // Kullanıcıyı güncelleme (Jetstream'in profile_photo_path ve profile_photo_url kullanımı)
        $user->update([
            'profile_photo_path' => $path,  // Fotoğrafın path'ini kaydet
            'profile_photo_url' => $url,    // Fotoğrafın URL'sini kaydet
        ]);

        // Başarı mesajı
        session()->flash('message', 'Profil fotoğrafınız başarıyla güncellendi!');
    }

    public function render()
    {
        return view('livewire.profile-photo-form');
    }
}
