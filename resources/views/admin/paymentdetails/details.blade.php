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

    <h1>Payment Details for Booking #{{ $booking->id }}</h1>
    <form action="{{ route('admin.paymentdetails.payment.process', ['bookingId' => $booking->id]) }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="key_price">Key Price</label>
        <input type="number" name="key_price" class="form-control" value="{{ $payment->key_price }}" id="key_price" readonly>
    </div>
    <div class="form-group">
        <label for="paid_key_price">Paid Key Price</label>
        <input type="number" name="paid_key_price" class="form-control" value="{{ $payment->paid_key_price }}" required id="paid_key_price">
    </div>
    <div class="form-group">
        <label for="service_fee">Service Fee</label>
        <input type="number" name="service_fee" class="form-control" value="{{ $payment->service_fee }}" id="service_fee" readonly>
    </div>
    <div class="form-group">
        <label for="paid_service_fee">Paid Service Fee</label>
        <input type="number" name="paid_service_fee" class="form-control" value="{{ $payment->paid_service_fee }}" required id="paid_service_fee">
    </div>
    <div class="form-group">
        <label for="rent_price">Rent Price</label>
        <input type="number" name="rent_price" class="form-control" value="{{ $payment->rent_price }}" id="rent_price" readonly>
    </div>
    <div class="form-group">
        <label for="paid_rent_price">Paid Rent Price</label>
        <input type="number" name="paid_rent_price" class="form-control" value="{{ $payment->paid_rent_price }}" required id="paid_rent_price">
    </div>
    <div class="form-group">
        <label for="totalprice">Total Price</label>
        <input type="number" name="totalprice" class="form-control" value="{{ $payment->totalprice }}" readonly id="totalprice">
    </div>
    <div class="form-group">
        <label for="paid_amount">Paid Amount</label>
        <input type="number" name="paid_amount" class="form-control" value="{{ $payment->paid_amount }}" readonly id="paid_amount">
    </div>
    <div class="form-group">
        <label for="remaining_amount">Remaining Amount</label>
        <input type="number" name="remaining_amount" class="form-control" value="{{ $payment->remaining_amount }}" readonly id="remaining_amount">
    </div>
    <button type="submit" class="btn btn-primary">Update Payment</button>
</form>

    <!-- Start Footer -->
    @include('admin.adminfooter')
    <!-- End Footer -->

    <!-- Start Scriptsrc codes -->
    @include('admin.infooutofproject')
    <!-- End Scriptsrc codes -->

    <!-- JavaScript to calculate Total Price and Paid Amount -->
    <script>
        // Function to calculate total price and paid amount
        function calculateTotalAndPaidAmount() {
            var keyPrice = parseFloat(document.getElementById('key_price').value) || 0;
            var serviceFee = parseFloat(document.getElementById('service_fee').value) || 0;
            var rentPrice = parseFloat(document.getElementById('rent_price').value) || 0;

            // Calculate total price
            var totalPrice = keyPrice + serviceFee + rentPrice;

            // Set total price to the totalprice field

            // Calculate Paid Amount
            var paidKeyPrice = parseFloat(document.getElementById('paid_key_price').value) || 0;
            var paidServiceFee = parseFloat(document.getElementById('paid_service_fee').value) || 0;
            var paidRentPrice = parseFloat(document.getElementById('paid_rent_price').value) || 0;

            // Calculate paid amount
            var paidAmount = paidKeyPrice + paidServiceFee + paidRentPrice;

            // Set paid amount to the paid_amount field
            document.getElementById('paid_amount').value = paidAmount;

            // Calculate remaining amount
            var remainingAmount = totalPrice - paidAmount;

            // Set remaining amount to the remaining_amount field
            document.getElementById('remaining_amount').value = remainingAmount;
        }

        // Add event listeners to update total price, paid amount, and remaining amount when fields change
        document.getElementById('paid_key_price').addEventListener('input', calculateTotalAndPaidAmount);
        document.getElementById('paid_service_fee').addEventListener('input', calculateTotalAndPaidAmount);
        document.getElementById('paid_rent_price').addEventListener('input', calculateTotalAndPaidAmount);

        // Call calculateTotalAndPaidAmount function to set initial values
        calculateTotalAndPaidAmount();
    </script>
  </body>
</html>
