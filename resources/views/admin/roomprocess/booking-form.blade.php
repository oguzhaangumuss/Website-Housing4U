<form action="{{ route('admin.roomprocess.create-booked') }}" method="POST" class="form-container">
    @csrf
    
    <!-- Room Selection -->
    <h1>Create New Booking</h1>

    <div class="form-group">
        <label for="room_id">Room:</label>
        <select name="room_id" id="room_id" required class="form-control">
            @foreach ($rooms as $room)
                <option value="{{ $room->id }}">{{ $room->name }}</option>
            @endforeach
        </select>
    </div>

    <!-- User Selection -->
    <div class="form-group">
        <label for="user_id">User:</label>
        <input type="text" name="user_id" id="user_id" required class="form-control">
    </div>

    <!-- Name Input -->
    <div class="form-group">
        <label for="name">Name:</label>
        <input type="text" name="name" id="name" required class="form-control">
    </div>

    <!-- Description Textarea -->
    <div class="form-group">
        <label for="description">Description:</label>
        <textarea name="description" id="description" required class="form-control"></textarea>
    </div>

    <!-- Key Price Input -->
    <div class="form-group">
        <label for="key_price">Key Price:</label>
        <input type="number" name="key_price" id="key_price" min="0" required class="form-control">
    </div>

    <!-- Service Fee Input -->
    <div class="form-group">
        <label for="service_fee">Service Fee:</label>
        <input type="number" name="service_fee" id="service_fee" min="0" required class="form-control">
    </div>

    <!-- Rent Price Input -->
    <div class="form-group">
        <label for="rent_price">Rent Price:</label>
        <input type="number" name="rent_price" id="rent_price" min="0" required class="form-control">
    </div>

    <!-- Available From Date -->
    <div class="form-group">
        <label for="available_from">Available From:</label>
        <input type="date" name="available_from" id="available_from" required class="form-control">
    </div>

    <!-- Available Until Date -->
    <div class="form-group">
        <label for="available_until">Available Until:</label>
        <input type="date" name="available_until" id="available_until" required class="form-control">
    </div>

    <!-- Status Selection -->
    <div class="form-group">
        <label for="status">Status:</label>
        <select name="status" id="status" required class="form-control">
            <option value="available">Available</option>
            <option value="booked">Booked</option>
            <option value="under_maintenance">Under Maintenance</option>
        </select>
    </div>

    <!-- Submit Button -->
    <div class="form-group text-center">
        <button type="submit" class="btn btn-primary">Create Booking</button>
    </div>
</form>