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

    <div class="container mt-5">
      <div class="card shadow">
        <div class="card-header bg-primary text-white">
          <h3 class="mb-0">Add New Room</h3>
        </div>
        <div class="card-body">
          <form action="{{ route('admin.roomprocess.storeRoom') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Room Name and Price -->
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="name" class="form-label">Room Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter room name" required />
              </div>

              <div class="col-md-6">
                <label for="price" class="form-label">Price</label>
                <input type="number" step="0.01" class="form-control" id="price" name="price" placeholder="Total price" readonly />
              </div>
            </div>

            <!-- Room Description -->
            <div class="mb-3">
              <label for="description" class="form-label">Description</label>
              <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter room description" required></textarea>
            </div>

            <!-- Location, Available From, Available Until -->
            <div class="row mb-3">
              <div class="col-md-6">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control" id="location" name="location" placeholder="Enter location" required />
              </div>

              <div class="col-md-3">
                <label for="available_from" class="form-label">Available From</label>
                <input type="date" class="form-control" id="available_from" name="available_from" required />
              </div>

              <div class="col-md-3">
                <label for="available_until" class="form-label">Available Until</label>
                <input type="date" class="form-control" id="available_until" name="available_until" required />
              </div>
            </div>

            <!-- Room Status -->
            <div class="mb-3">
              <label for="status" class="form-label">Status</label>
              <select class="form-select" id="status" name="status" required>
                <option value="available">Available</option>
                <option value="booked">Booked</option>
                <option value="under_maintenance">Under Maintenance</option>
              </select>
            </div>

            <!-- Services (Multiple Tags) -->
            <div class="mb-3">
              <label for="services" class="form-label">Services</label>
              @foreach ($tags as $tag)
                <div class="form-check">
                  <input class="form-check-input" type="checkbox" id="tag_{{ $tag->id }}" name="services[]" value="{{ $tag->id }}">
                  <label class="form-check-label" for="tag_{{ $tag->id }}">{{ $tag->name }}</label>
                </div>
              @endforeach
            </div>

            <!-- Rent Prices (key_price, rent_price, service_fee) -->
            <div class="mb-3">
        <label for="rent_prices" class="form-label">Rent Prices</label>
        <input type="number" step="0.01" class="form-control" id="key_price" name="key_price" placeholder="Key Price" required />
<input type="number" step="0.01" class="form-control mt-2" id="service_fee" name="service_fee" placeholder="Service Fee" required />
<input type="number" step="0.01" class="form-control mt-2" id="rent_price" name="rent_price" placeholder="Rent Price" required />   </div>


            <!-- Photos (Multiple Upload) -->
            <div class="mb-3">
              <label for="photos" class="form-label">Upload Photos</label>
              <input type="file" class="form-control" id="photos" name="photos[]" multiple />
            </div>

            <!-- Submit Button -->
            <div class="text-end">
              <button type="submit" class="btn btn-success">Save Room</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Start Footer -->
    @include('admin.adminfooter')
    <!-- End Footer -->

    <!-- Start Scriptsrc codes -->
    @include('admin.infooutofproject')
    <!-- End Scriptsrc codes -->

    <script>
      // Rent prices (key_price, service_fee, rent_price) alanlarındaki her değişiklikte total price'ı güncelle
      document.getElementById('key_price').addEventListener('input', updateTotalPrice);
document.getElementById('service_fee').addEventListener('input', updateTotalPrice);
document.getElementById('rent_price').addEventListener('input', updateTotalPrice);

function updateTotalPrice() {
    let keyPrice = parseFloat(document.getElementById('key_price').value) || 0;
    let serviceFee = parseFloat(document.getElementById('service_fee').value) || 0;
    let rentPrice = parseFloat(document.getElementById('rent_price').value) || 0;

    let totalPrice = keyPrice + serviceFee + rentPrice;

    // Toplam fiyatı price alanına yaz
    document.getElementById('price').value = totalPrice.toFixed(2);  // 2 ondalıklı göster
   }
    </script>
  </body>
</html>
