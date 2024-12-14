<?php

namespace App\Http\Controllers;

use App\Models\ContactInfo;
use Illuminate\Http\Request;

class ContactInfoController extends Controller
{
    // İletişim bilgilerini gösterme
    public function index()
    {
        $contactInfo = ContactInfo::first();  // Veritabanından ilk iletişim bilgilerini alıyoruz
        return view('admin.contact_info.index', compact('contactInfo'));
    }

    // İletişim bilgilerini güncelleme
    public function update(Request $request)
    {
        $request->validate([
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'instagram' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'email' => 'nullable|email',
            'phone' => 'nullable|string',
        ]);

        // İlk iletişim bilgilerini al veya yeni bir tane oluştur
        $contactInfo = ContactInfo::first();

        if (!$contactInfo) {
            $contactInfo = new ContactInfo();  // Eğer iletişim bilgisi yoksa yeni bir kayıt oluştur
        }

        // Veriyi güncelle
        $contactInfo->facebook = $request->facebook;
        $contactInfo->twitter = $request->twitter;
        $contactInfo->instagram = $request->instagram;
        $contactInfo->linkedin = $request->linkedin;
        $contactInfo->email = $request->email;
        $contactInfo->phone = $request->phone;
        $contactInfo->save();  // Veriyi kaydet

        // Başarılı bir şekilde güncellendikten sonra yönlendir
        return redirect()->route('admin.contact_info.index')->with('success', 'Contact information updated successfully!');
    }

    // Düzenleme formunu gösterme
    public function edit()
    {
        $contactInfo = ContactInfo::first();  // Mevcut iletişim bilgilerini al
        return view('admin.contact_info.edit', compact('contactInfo'));
    }
}
