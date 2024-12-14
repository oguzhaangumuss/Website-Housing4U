<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Booking;

class PaymentController extends Controller
{
    // Tüm ödeme işlemlerini listeleme
    public function index()
    {
        // Tüm rezervasyonları ve ilişkili ödeme bilgilerini getir
        $payments = Payment::with('booking')  // booking ilişkisini de dahil ediyoruz
                           ->paginate(10);  // sayfalama
                           
        return view('admin.paymentdetails.index', compact('payments'));
    }
    
    // Ödeme detaylarını düzenlemek için
    public function details($bookingId)
    {
        // İlgili booking'i bul
        $booking = Booking::find($bookingId);
        if (!$booking) {
            return redirect()->back()->withErrors('Booking not found.');
        }

        // İlgili ödeme kaydını bul
        $payment = Payment::where('booking_id', $bookingId)->first();
        if (!$payment) {
            return redirect()->back()->withErrors('Payment record not found.');
        }

        // Ödeme detayları sayfasını görüntüle
        return view('admin.paymentdetails.details', compact('booking', 'payment'));
    }

    // Ödeme işlemini güncelleme
    public function processPayment(Request $request, $bookingId)
    {
        // Ödeme verilerini request'ten al
        $paidKeyPrice = $request->input('paid_key_price');
        $paidServiceFee = $request->input('paid_service_fee');
        $paidRentPrice = $request->input('paid_rent_price');
        $paidAmount = $request->input('paid_amount');

        // İlgili ödeme kaydını bul
        $payment = Payment::where('booking_id', $bookingId)->first();
        if (!$payment) {
            return redirect()->back()->withErrors('Payment record not found.');
        }

        // Ödenen tutarları güncelle
        $payment->paid_key_price = $paidKeyPrice;
        $payment->paid_service_fee = $paidServiceFee;
        $payment->paid_rent_price = $paidRentPrice;
        $payment->paid_amount = $paidAmount;

        // Kalan tutarı hesapla
        $payment->remaining_amount = $payment->totalprice - $payment->paid_amount;

        // Ödeme durumunu güncelle
        $payment->status = $payment->remaining_amount > 0 ? 'pending' : 'paid';

        // Ödeme kaydını kaydet
        $payment->save();

        // Başarı mesajı ile yönlendir
        return redirect()->route('admin.paymentdetails.index')->with('success', 'Payment updated successfully.');
    }
}
