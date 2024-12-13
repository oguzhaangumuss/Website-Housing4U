<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Admin Panel - View All Rooms</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <base href="/public">
    <!-- Start Headinfo -->
    @include('admin.headinfo')
    <!-- End Headinfo -->
</head>
<body>
    <!-- Start Sidebar -->
    @include('admin.sidebar')
    <!-- End Sidebar -->

    <!-- Start Navbar -->
    @include('admin.navbar')
    <!-- End Navbar -->

    <!-- Start Info Section -->
    @include('admin.infosection')
    <!-- End Info Section -->

   
    <div class="container mt-5">
        <h2 class="mb-4">All Rooms</h2>
        
        <!-- Success Message -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Room Name</th>
                    <th>Price</th>
                    <th>Services</th>
                    <th>Photos</th> <!-- New column for Photos -->
                    <th>Status</th>
                    <th>Available From</th>
                    <th>Available Until</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rooms as $room)
                    <tr>
                        <td>{{ $room->name }}</td>
                        <td>{{ $room->price ? number_format($room->price, 2) : 'N/A' }}</td>

                        <!-- Display associated services -->
                        <td>
                            @foreach ($room->tags as $tag)
                                <span class="badge bg-info">{{ $tag->name }}</span>
                            @endforeach
                        </td>

                        <!-- Display associated photos -->
                        <td>
                            @foreach ($room->photos as $photo)
                                <a href="{{ asset('storage/' . $photo->path) }}" data-lightbox="room-{{ $room->id }}" data-title="Room Photo">
                                    <img src="{{ asset('storage/' . $photo->path) }}" alt="Room Photo" class="img-thumbnail" style="width: 50px; height: 50px; margin-right: 5px;">
                                </a>
                            @endforeach
                        </td>

                        <td>{{ ucfirst($room->status) }}</td>
                        <td>{{ $room->available_from }}</td>
                        <td>{{ $room->available_until }}</td>
                        <td>
                            <a href="{{ route('admin.roomprocess.editroom', $room->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('admin.roomprocess.deleteroom', $room->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                            
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="d-flex justify-content-center">
            {{ $rooms->links() }} <!-- Pagination links -->
        </div>
    </div>


    <!-- Start Footer -->
    @include('admin.adminfooter')
    <!-- End Footer -->

    <!-- Start Scriptsrc codes -->
    @include('admin.infooutofproject')
    <!-- End Scriptsrc codes -->    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>

</body>
</html>
