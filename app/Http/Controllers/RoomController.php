<?php
namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Tag;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RoomController extends Controller
{
    public function saleroom(Request $request)
    {
        // Aylık verileri almak
        $month = $request->get('month', now()->format('Y-m'));
        $startDate = Carbon::parse($month . '-01'); // Ayın ilk günü
        $endDate = $startDate->copy()->endOfMonth(); // Ayın son günü
    
        // Ayın tüm günlerini al
        $dates = [];
        while ($startDate <= $endDate) {
            $dates[] = $startDate->toDateString(); // Yıl-Ay-Gün formatında tarih ekliyoruz
            $startDate->addDay(); // Bir sonraki güne geçiyoruz
        }
    
        // Odalar ve ilişkili rezervasyonları getir
        $rooms = Room::with(['bookings' => function ($query) use ($startDate, $endDate) {
            $query->where(function ($query) use ($startDate, $endDate) {
                $query->whereBetween('available_from', [$startDate, $endDate])
                      ->orWhereBetween('available_until', [$startDate, $endDate])
                      ->orWhere(function ($query) use ($startDate, $endDate) {
                          $query->where('available_from', '<=', $startDate)
                                ->where('available_until', '>=', $endDate);
                      });
            });
        }])->paginate(10);
    
        return view('admin.roomprocess.saleroom', compact('rooms', 'dates'));
    }
    
    public function showAddRoomForm()
    {
        // Veritabanındaki tüm tagları çekiyoruz
        $tags = Tag::all();

        // Formu render ederken tag verilerini gönderiyoruz
        return view('admin.roomprocess.addsaleroom', compact('tags'));
    }

    // Aynı işlevleri birleştirebiliriz (store ve update işlemleri benzer)
    public function storeRoom(Request $request)
{
    // Gelen verileri doğrula
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'key_price' => 'required|numeric|min:0',
        'service_fee' => 'required|numeric|min:0',
        'rent_price' => 'required|numeric|min:0',
        'location' => 'required|string|max:255',
        'available_from' => 'required|date',
        'available_until' => 'required|date|after_or_equal:available_from',
        'status' => 'required|in:available,booked,under_maintenance',
        'services' => 'nullable|array',
        'services.*' => 'exists:tags,id',
    ]);

    // Yeni bir oda oluştur
    $room = new Room();

    // Fiyatları hesapla ve kaydet
    $keyPrice = $validated['key_price'];
    $serviceFee = $validated['service_fee'];
    $rentPrice = $validated['rent_price'];
    $totalPrice = (float) $keyPrice + (float) $serviceFee + (float) $rentPrice;

    // Oda bilgilerini kaydet
    $room->name = $validated['name'];
    $room->description = $validated['description'];
    $room->location = $validated['location'];
    $room->available_from = $validated['available_from'];
    $room->available_until = $validated['available_until'];
    $room->status = $validated['status'];
    $room->key_price = $keyPrice;
    $room->service_fee = $serviceFee;
    $room->rent_price = $rentPrice;
    $room->price = $totalPrice; // Toplam fiyatı kaydet
    $room->save();

    // Oda ile ilişkilendirilmiş hizmetleri (tags) kaydet
    if ($validated['services']) {
        $room->tags()->sync($validated['services']);
    }

    // Fotoğrafları yükle (varsa)
    if ($request->hasFile('photos')) {
        $photos = $request->file('photos');
        foreach ($photos as $photo) {
            $path = $photo->store('room_photos', 'public');
            $room->photos()->create(['path' => $path]);
        }
    }

    // Başarıyla ekleme mesajı ve yönlendirme
    return redirect()->route('admin.roomprocess.saleroom')->with('success', 'Room added successfully!');
}
        public function updateRoom(Request $request, $id)
{
    // Gelen verileri doğrula
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string',
        'service_fee' => 'required|numeric|min:0',
        'key_price' => 'required|numeric|min:0',
        'rent_price' => 'required|numeric|min:0',
        'location' => 'required|string|max:255',
        'available_from' => 'required|date',
        'available_until' => 'required|date|after_or_equal:available_from',
        'status' => 'required|in:available,booked,under_maintenance',
        'tags' => 'nullable|array',
        'tags.*' => 'exists:tags,id',
    ]);

    // Odayı bul ve güncelle
    $room = Room::findOrFail($id);

    // Fiyatları hesapla ve güncelle
    $keyPrice = $validated['key_price'];
    $serviceFee = $validated['service_fee'];
    $rentPrice = $validated['rent_price'];
    $totalPrice = (float) $keyPrice + (float) $serviceFee + (float) $rentPrice;

    // Oda bilgilerini güncelle
    $room->name = $validated['name'];
    $room->description = $validated['description'];
    $room->location = $validated['location'];
    $room->available_from = $validated['available_from'];
    $room->available_until = $validated['available_until'];
    $room->status = $validated['status'];
    $room->key_price = $keyPrice;
    $room->service_fee = $serviceFee;
    $room->rent_price = $rentPrice;
    $room->price = $totalPrice; // Toplam fiyatı güncelle
    $room->save(); // Odayı güncelle

    // Fotoğrafları yükle (varsa)
    if ($request->hasFile('photos')) {
        $photos = $request->file('photos');
        foreach ($photos as $photo) {
            $path = $photo->store('room_photos', 'public');
            $room->photos()->create(['path' => $path]); // Yeni fotoğraflar ekle
        }
    }

    // Başarıyla güncelleme mesajı ve yönlendirme
    return redirect()->route('admin.roomprocess.saleroom')->with('success', 'Room updated successfully!');
}

    public function editRoom($id)
    {
        $room = Room::findOrFail($id);
        $tags = Tag::all();  // Tüm etiketleri alıyoruz
        return view('admin.roomprocess.editroom', compact('room', 'tags'));
    }

    public function showroom(Request $request)
    {
        $rooms = Room::paginate(10); // 10 odada bir sayfaya bölme
        return view('admin.roomprocess.showrooms', compact('rooms'));
    }

    public function deleteRoom($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();

        return redirect()->route('admin.roomprocess.saleroom')->with('success', 'Room deleted successfully!');
    }
}