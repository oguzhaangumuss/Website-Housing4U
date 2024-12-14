<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Admin Panel - Add New Room</title>
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

    <h1>Bookings List</h1>

    <table class="table">
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Room Name</th>
                <th>Total Price</th>
                <th>Payment Status</th>
                <th>Payment Details</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($payments as $payment)
                <tr>
                    <td>{{ $payment->booking->id }}</td>
                    <td>{{ $payment->booking->room->name }}</td>
                    <td>{{ $payment->totalprice }}</td>
                    <td>{{ ucfirst($payment->status) }}</td>
                    <td>
                        <!-- Payment details sayfasına yönlendiren link -->
                        <a href="{{ route('admin.paymentdetails.details', ['bookingId' => $payment->booking_id]) }}" class="btn btn-info">Payment Details</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $payments->links() }}

    <!-- Start Footer -->
    @include('admin.adminfooter')
    <!-- End Footer -->

    <!-- Start Scriptsrc codes -->
    @include('admin.infooutofproject')
    <!-- End Scriptsrc codes -->

 
  </body>
</html>