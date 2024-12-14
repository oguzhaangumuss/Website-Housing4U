<?php

namespace App\Http\Controllers;

use App\Models\Room;
use App\Models\Tag;
use App\Models\Photo;
use App\Http\Requests\UpdateRoomRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;

class RoomController extends Controller
{
    public function saleroom(Request $request)
    {
        $month = $request->get('month', now()->format('Y-m'));
        $startDate = Carbon::parse($month . '-01');
        $endDate = $startDate->copy()->endOfMonth();

        $dates = [];
        while ($startDate <= $endDate) {
            $dates[] = $startDate->toDateString();
            $startDate->addDay();
        }

        $rooms = Room::with('bookings')->paginate(10);

        foreach ($rooms as $room) {
            foreach ($dates as $date) {
                $booking = $room->bookings->first(function ($booking) use ($date) {
                    return $date >= $booking->available_from && $date <= $booking->available_until;
                });

                if ($booking) {
                    if ($booking->status == 'booked') {
                        $room->status = 'booked';
                    } elseif ($booking->status == 'under_maintenance') {
                        $room->status = 'under_maintenance';
                    }
                } else {
                    $room->status = 'available';
                }
            }

            $room->save();
        }

        return view('admin.roomprocess.saleroom', compact('rooms', 'dates'));
    }

    public function showAddRoomForm()
    {
        $tags = Tag::all();
        return view('admin.roomprocess.addsaleroom', compact('tags'));
    }

    public function storeRoom(Request $request)
    {
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

        $room = new Room();
        $keyPrice = $validated['key_price'];
        $serviceFee = $validated['service_fee'];
        $rentPrice = $validated['rent_price'];
        $totalPrice = (float) $keyPrice + (float) $serviceFee + (float) $rentPrice;

        $room->name = $validated['name'];
        $room->description = $validated['description'];
        $room->location = $validated['location'];
        $room->available_from = $validated['available_from'];
        $room->available_until = $validated['available_until'];
        $room->status = $validated['status'];
        $room->key_price = $keyPrice;
        $room->service_fee = $serviceFee;
        $room->rent_price = $rentPrice;
        $room->price = $totalPrice;
        $room->save();

        // Etiketleri ekleyelim
        if ($validated['services']) {
            $room->tags()->attach($validated['services']);
        }

        // Fotoğrafları yükle (varsa)
        if ($request->hasFile('photos')) {
            $photos = $request->file('photos');
            foreach ($photos as $photo) {
                $path = $photo->store('room_photos', 'public');
                $room->photos()->create(['path' => $path]);
            }
        }

        return redirect()->route('admin.roomprocess.saleroom')->with('success', 'Room added successfully!');
    }

    public function updateRoom(UpdateRoomRequest $request, $id)
    {
        $validated = $request->validated();
        $room = Room::findOrFail($id);

        $room->update([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'location' => $validated['location'],
            'available_from' => $validated['available_from'],
            'available_until' => $validated['available_until'],
            'status' => $validated['status'],
            'key_price' => $validated['key_price'],
            'service_fee' => $validated['service_fee'],
            'rent_price' => $validated['rent_price'],
            'price' => $validated['key_price'] + $validated['service_fee'] + $validated['rent_price'],
        ]);

        // Etiketleri güncelle
        if (isset($validated['services'])) {
            $room->tags()->sync($validated['services']);
        }

        // Fotoğrafları yükle
        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('room_photos', 'public');
                $room->photos()->create(['path' => $path]);
            }
        }

        return redirect()->route('admin.roomprocess.showroom')->with('success', 'Room updated successfully!');
    }

    public function editRoom($id)
    {
        $room = Room::findOrFail($id);
        $tags = Tag::all();
        return view('admin.roomprocess.editroom', compact('room', 'tags'));
    }

    public function showroom(Request $request)
    {
        $rooms = Room::paginate(10);
        return view('admin.roomprocess.showrooms', compact('rooms'));
    }

    public function deleteRoom($id)
    {
        // Find the room by ID
        $room = Room::find($id);
        
        if (!$room) {
            return redirect()->route('admin.roomprocess.showroom')->with('error', 'Room not found.');
        }
    
        // Delete associated photos
        foreach ($room->photos as $photo) {
            // Delete the photo file from storage
            if (Storage::exists('public/' . $photo->path)) {
                Storage::delete('public/' . $photo->path);
            }
            // Delete the photo record from the database
            $photo->delete();
        }
    
        // Delete the room
        $room->delete();
    
        return redirect()->route('admin.roomprocess.showroom')->with('success', 'Room and associated photos deleted successfully.');
    }
    public function deletePhoto(Request $request)
    {
        try {
            // Check if the request has photo IDs to delete
            $photoIds = $request->ids;
    
            if (empty($photoIds)) {
                return response()->json(['message' => 'No photo IDs provided.'], 400);
            }
    
            // Find and delete each photo
            $photos = Photo::whereIn('id', $photoIds)->get();
            if ($photos->isEmpty()) {
                return response()->json(['message' => 'No photos found.'], 404);
            }
    
            foreach ($photos as $photo) {
                // Check if the photo exists in the storage
                if (Storage::exists('public/' . $photo->path)) {
                    Storage::delete('public/' . $photo->path);
                }
    
                // Delete the photo record from the database
                $photo->delete();
            }
    
            return response()->json(['message' => 'Photos deleted successfully.']);
        } catch (\Exception $e) {
            // Log the exception for debugging
            return response()->json(['message' => 'There was an error deleting the photos.'], 500);
        }
    }
    
}
