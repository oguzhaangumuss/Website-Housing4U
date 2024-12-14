<?php
namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoomRequest extends FormRequest
{
    public function authorize()
    {
        return true; // Yetkilendirme kontrolü
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
            'available_from' => 'required|date',
            'available_until' => 'required|date',
            'status' => 'required|in:available,booked,under_maintenance',
            'key_price' => 'required|numeric',
            'service_fee' => 'required|numeric',
            'rent_price' => 'required|numeric',
            'services' => 'nullable|array', // Add this rule to ensure services is an array
            'services.*' => 'exists:tags,id', // Make sure each tag ID exists in the tags table
        ];
    }
}
