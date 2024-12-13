<div>
    <form wire:submit.prevent="updateProfilePhoto">
        <input type="file" wire:model="photo" class="form-input">
        @error('photo') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <button type="submit" class="btn btn-primary">Update Profile Photo</button>
    </form>

    @if (session()->has('message'))
        <div class="mt-3 text-green-500">
            {{ session('message') }}
        </div>
    @endif

    <!-- Current Profile Photo -->
    <div class="mt-3">
        <img src="{{ auth()->user()->profile_photo_url }}" alt="Profile Photo" class="w-20 h-20 rounded-full">
    </div>
</div>
