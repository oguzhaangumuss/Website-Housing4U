<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Edit Room</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <base href="/public">
    @include('admin.headinfo')
    <!-- Admin paneli başlık bilgileri -->
</head>

<body>

    @include('admin.sidebar')
    <!-- Admin paneli sol menü -->
    @include('admin.navbar')
    <!-- Admin paneli üst menü -->
    @include('admin.infosection')
    <!-- Admin paneli bilgi bölümü -->
    <div class="container my-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Edit Room: {{ $room->name }}</h5>
            </div>
            <div class="card-body">
                <!-- Oda Özelliklerini Gösteren Tablo -->
                <div class="table-responsive mb-4">
                    <table class="table table-bordered">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>Property</th>
                                <th>Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><strong>Room Name</strong></td>
                                <td>{{ $room->name }}</td>
                            </tr>
                            <tr>
                                <td><strong>Description</strong></td>
                                <td>{{ $room->description }}</td>
                            </tr>
                            <tr>
                                <td><strong>Service Fee</strong></td>
                                <td>{{ number_format($room->service_fee, 2) }} $</td>
                            </tr>
                            <tr>
                                <td><strong>Key Price</strong></td>
                                <td>{{ number_format($room->key_price, 2) }} $</td>
                            </tr>
                            <tr>
                                <td><strong>Rent Price</strong></td>
                                <td>{{ number_format($room->rent_price, 2) }} $</td>
                            </tr>
                            <tr>
                                <td><strong>Total Price</strong></td>
                                <td class="text-success fw-bold">{{ number_format($room->price, 2) }} $</td>
                            </tr>
                            <tr>
                                <td><strong>Location</strong></td>
                                <td>{{ $room->location }}</td>
                            </tr>
                            <tr>
                                <td><strong>Status</strong></td>
                                <td>{{ ucfirst($room->status) }}</td>
                            </tr>
                            <tr>
                                <td><strong>Available From</strong></td>
                                <td>{{ $room->available_from }}</td>
                            </tr>
                            <tr>
                                <td><strong>Available Until</strong></td>
                                <td>{{ $room->available_until }}</td>
                            </tr>
                            <tr>
                                <td><strong>Tags</strong></td>
                                <td>
                                    @if($room->tags->isNotEmpty())
                                        @foreach($room->tags as $tag)
                                            <span class="badge bg-secondary">{{ $tag->name }}</span>
                                        @endforeach
                                    @else
                                        <span>No tags available</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><strong>Photos</strong></td>
                                <td>
                                    @foreach($room->photos as $photo)
                                        <img src="{{ asset('storage/' . $photo->path) }}" alt="Room Photo"
                                            class="img-thumbnail" style="width: 50px; height: 50px; margin-right: 5px;">
                                    @endforeach
                                    <span class="text-muted">Click to remove or upload new photos below.</span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <!-- Düzenleme Formu -->
                <form action="{{ route('admin.roomprocess.updateRoom', $room->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT') 
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">Room Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ $room->name }}"
                                required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control" id="location" name="location"
                                value="{{ $room->location }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description"
                            required>{{ $room->description }}</textarea>
                    </div>
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="service_fee" class="form-label">Service Fee</label>
                            <input type="number" step="0.01" class="form-control" id="service_fee" name="service_fee"
                                value="{{ $room->service_fee }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="key_price" class="form-label">Key Price</label>
                            <input type="number" step="0.01" class="form-control" id="key_price" name="key_price"
                                value="{{ $room->key_price }}" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="rent_price" class="form-label">Rent Price</label>
                            <input type="number" step="0.01" class="form-control" id="rent_price" name="rent_price"
                                value="{{ $room->rent_price }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="available_from" class="form-label">Available From</label>
                            <input type="date" class="form-control" id="available_from" name="available_from"
                                value="{{ $room->available_from }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="available_until" class="form-label">Available Until</label>
                            <input type="date" class="form-control" id="available_until" name="available_until"
                                value="{{ $room->available_until }}" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="available" {{ $room->status == 'available' ? 'selected' : '' }}>Available
                            </option>
                            <option value="booked" {{ $room->status == 'booked' ? 'selected' : '' }}>Booked</option>
                            <option value="under_maintenance" {{ $room->status == 'under_maintenance' ? 'selected' : '' }}>Under Maintenance</option>
                        </select>
                    </div>

                    <!-- Etiketler Alanı -->
                    <div class="mb-3">
                        <label for="services" class="form-label">Services</label>
                        @foreach ($tags as $tag)
                            <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="tag_{{ $tag->id }}" name="services[]"
                            value="{{ $tag->id }}" {{ in_array($tag->id, $room->tags->pluck('id')->toArray()) ? 'checked' : '' }}>

                                <label class="form-check-label" for="tag_{{ $tag->id }}">{{ $tag->name }}</label>
                            </div>
                        @endforeach
                    </div>

                    <!-- Fotoğraf Yükleme Alanı -->
                    <div class="mb-3">
                        <label for="photos" class="form-label">Upload Photos</label>
                        <input type="file" class="form-control" id="photos" name="photos[]" multiple>
                    </div>
                
        <div class="mb-3">
        @foreach ($room->photos as $photo)
    <div class="photo-item">
        <img src="{{ asset('storage/' . $photo->path) }}" alt="Room Photo" class="img-thumbnail" style="width: 50px; height: 50px;">
        <input type="checkbox" class="delete-photo-checkbox" value="{{ $photo->id }}" />
    </div>
@endforeach
            <button type="button" class="btn btn-danger" id="delete-selected-photos">Delete Selected Photos</button>

        </div>



                    <button type="submit" class="btn btn-success">Update Room</button>
                </form>
            </div>
        </div>
    </div>
    @include('admin.adminfooter')
    <!-- Admin paneli altbilgi -->
    @include('admin.infooutofproject')
    <!-- Diğer scriptler -->
 <script>
    document.getElementById('delete-selected-photos').addEventListener('click', function () {
        var selectedPhotos = [];
        document.querySelectorAll('.delete-photo-checkbox:checked').forEach(function (checkbox) {
            selectedPhotos.push(checkbox.value);
        });

        if (selectedPhotos.length === 0) {
            alert('No photos selected for deletion.');
            return;
        }

        // Send a POST request to delete the selected photos
        axios.post('/admin/roomprocess/photo/delete', {
            ids: selectedPhotos
        })
        .then(response => {
            alert(response.data.message);
            location.reload(); // Reload the page to reflect changes
        })
        .catch(error => {
            console.error(error);
            alert('There was an error deleting the photos.');
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

</body>

</html>