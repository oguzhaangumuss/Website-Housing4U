<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Payments for Booking #{{ $booking->id }}</title>
    @include('admin.headinfo')
</head>
<body>
    @include('admin.sidebar')
    @include('admin.navbar')
    @include('admin.infosection')

    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Payments for Booking #{{ $booking->id }}</h3>
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Payment Date</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($payments as $payment)
                            <tr>
                                <td>{{ $payment->payment_date }}</td>
                                <td>{{ $payment->amount }}</td>
                                <td>{{ $payment->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @include('admin.adminfooter')
    @include('admin.infooutofproject')
</body>
</html>
