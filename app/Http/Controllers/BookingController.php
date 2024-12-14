<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
use App\Models\User;
use App\Models\Payment;

class BookingController extends Controller
{
    public function booked(Request $request)
    {
        $bookings = Booking::all();
        $rooms = Room::where('status', 'available')->get();
        $users = User::all();
        return view('admin.roomprocess.booked', compact('bookings', 'rooms', 'users'));   
    }

    public function createbooked(Request $request)
    {
        // Gelen verileri doğrula
        $validated = $request->validate([
            "room_id"=> "required|exists:rooms,id", // room_id'nin rooms tablosunda mevcut olmasını sağlıyoruz
            "user_id"=> "required|exists:users,id", // user_id'nin users tablosunda mevcut olmasını sağlıyoruz
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'key_price' => 'required|numeric|min:0',
            'service_fee' => 'required|numeric|min:0',
            'rent_price' => 'required|numeric|min:0',
            'available_from' => 'required|date',
            'available_until' => 'required|date|after_or_equal:available_from',
            'status' => 'required|in:available,booked,under_maintenance',
        ]);
    
        // Fiyatları hesapla
        $keyPrice = $validated['key_price'];
        $serviceFee = $validated['service_fee'];
        $rentPrice = $validated['rent_price'];
        $totalPrice = (float) $keyPrice + (float) $serviceFee + (float) $rentPrice;
    
        // Oda ve kullanıcıyı doğrula
        $room = Room::find($validated['room_id']);
        $user = User::find($validated['user_id']);
        if (!$room || !$user) {
            return redirect()->back()->withErrors('Invalid room or user.');
        }
    
        if ($room->status !== 'available') {
            return redirect()->back()->withErrors('Room is not available for booking.');
        }
    
        // Yeni bir rezervasyon oluştur
        $booking = new Booking();
    
        // Oda bilgilerini kaydet
        $booking->name = $validated['name'];
        $booking->description = $validated['description'];
        $booking->available_from = $validated['available_from'];
        $booking->available_until = $validated['available_until'];
        $booking->status = $validated['status'];
        $booking->key_price = $keyPrice;
        $booking->service_fee = $serviceFee;
        $booking->rent_price = $rentPrice;
        $booking->price = $totalPrice; // Toplam fiyatı kaydet
        $booking->room_id = $validated['room_id'];
        $booking->user_id = $validated['user_id'];
    
        // Kaydet
        $booking->save();
    
        // Ödeme kaydını oluştur
        $payment = new Payment();
        $payment->booking_id = $booking->id; // Booking ile ilişkilendiriyoruz
        $payment->key_price = $keyPrice; // Toplam fiyatı ödeme kaydına ekliyoruz
        $payment->service_fee = $serviceFee; // Toplam fiyatı ödeme kaydına ekliyoruz
        $payment->rent_price = $rentPrice; // Toplam fiyatı ödeme kaydına ekliyoruz
        $payment->totalprice = $totalPrice; // Toplam fiyatı ödeme kaydına ekliyoruz
        $payment->remaining_amount = $totalPrice; // Başlangıçta tüm tutar kalan ödeme olarak belirleniyor
        $payment->status = 'pending'; // Başlangıçta ödeme durumu 'pending' olarak ayarlanıyor
        $payment->save();
    
        // Başarıyla ekleme mesajı ve yönlendirme
        return redirect()->route('admin.roomprocess.saleroom')->with('success', 'Booking added and payment initialized successfully!');
    }
    
    


}
