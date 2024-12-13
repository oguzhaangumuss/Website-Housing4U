<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Admin Panel</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <base href="/public">
      <!-- Start Headinfo -->
      @include('admin.headinfo')
      <!-- End Headinfo -->
       <style>
        /* Alt kaydırma çubuğu için stil */
.scrollbar-container {
  width: 100%;
  overflow-x: auto; /* Yatay kaydırma */
  overflow-y: hidden; /* Dikey kaydırma gizlenir */
  margin-top: 10px;
  border: 1px solid #ddd;
  border-radius: 8px;
  box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

/* Kaydırma çubuğu stilleri */
.scrollbar-container::-webkit-scrollbar {
  height: 8px;
}

.scrollbar-container::-webkit-scrollbar-thumb {
  background-color: #888;
  border-radius: 4px;
}

.scrollbar-container::-webkit-scrollbar-thumb:hover {
  background-color: #555;
}

.scrollbar-container::-webkit-scrollbar-track {
  background-color: #f1f1f1;
}

.table-container {
  width: 100%;
  overflow-x: auto;
  margin-bottom: 30px;
}

table {
  width: 100%;
  min-width: 1500px;
  border-collapse: collapse;
}

th, td {
  text-align: center;
  padding: 12px 15px;
  font-size: 14px;
  white-space: nowrap;
}
.table-container {
  width: 100%;
  overflow-x: auto; /* Yatay kaydırma */
  margin-bottom: 30px;
  position: relative; /* Kaydırma işlemi için konumlandırma */
}


.scrollbar-container::-webkit-scrollbar {
  height: 8px;
}

.scrollbar-container::-webkit-scrollbar-thumb {
  background-color: #888;
  border-radius: 4px;
}

.scrollbar-container::-webkit-scrollbar-thumb:hover {
  background-color: #555;
}

.scrollbar-container::-webkit-scrollbar-track {
  background-color: #f1f1f1;
}
       </style>
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
      <div class="container">
        <h1 class="mb-4">Room Bookings - Monthly View</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Datepicker for selecting a month -->
        <form action="{{ route('admin.roomprocess.saleroom') }}" method="GET" class="mb-4">
            <label for="month" class="form-label">Select Month:</label>
            <input type="month" id="month" name="month" value="{{ request()->get('month', \Carbon\Carbon::now()->format('Y-m')) }}" class="form-control">
            <button type="submit" class="btn btn-primary mt-2">Show</button>
        </form>

        <div class="table-container">
        <table class="table table-bordered">
    <thead>
        <tr>
            <th>Room Name</th>
            @foreach ($dates as $date)
                <th>{{ \Carbon\Carbon::parse($date)->format('j M Y') }}</th>
            @endforeach
        </tr>
    </thead>
    <tbody>
    @foreach ($rooms as $room)
    <tr>
        <td>{{ $room->name }}</td>
        @foreach ($dates as $date)
            <td>
                @php
                    // O tarihe ait rezervasyonu kontrol et
                    $booking = $room->bookings->first(function ($booking) use ($date) {
                        return $date >= $booking->available_from && $date <= $booking->available_until;
                    });
                @endphp
                @if ($booking)
    @if ($booking->status == 'booked')
        <span class="badge badge-success">Booked</span>
    @elseif ($booking->status == 'under_maintenance')
        <span class="badge badge-warning">Under Maintenance</span>
    @else
        <span class="badge badge-secondary">Available</span>
    @endif
    
    <!-- Ödeme durumu -->
    @if ($booking->payment_status == 'completed')
        <span class="badge badge-info">Payment Completed</span>
    @elseif ($booking->payment_status == 'pending')
        <span class="badge badge-warning">Payment Pending</span>
    @endif
@else
    <span class="badge badge-secondary">Available</span>
@endif
            </td>
        @endforeach
    </tr>
@endforeach

</tbody>
</table>
</div>

        <!-- Alt Kaydırma Çubuğu -->
        <div class="scrollbar-container" id="scroll-container">
            <div style="width: 3000px;"></div> <!-- Kaydırma çubuğunun görünmesini sağlamak için geniş bir div ekliyoruz -->
        </div>

        <!-- Pagination if necessary -->
{{ $rooms->links() }}
    </div>
    <!-- Start Footer -->
    @include('admin.adminfooter')
      <!-- End Footer -->
      <!-- Start Scriptsrc codes -->
      @include('admin.infooutofproject')
      <!-- End Scriptsrc codes -->
      <script>
    document.addEventListener('DOMContentLoaded', function () {
    let isMouseDown = false;
    let startX, scrollLeft;

    const tableContainer = document.querySelector('.table-container');

    // Mouse basılı tutulduğunda
    tableContainer.addEventListener('mousedown', (e) => {
        isMouseDown = true;
        startX = e.pageX - tableContainer.offsetLeft;
        scrollLeft = tableContainer.scrollLeft;
    });

    // Mouse hareket ettiğinde
    tableContainer.addEventListener('mousemove', (e) => {
        if (!isMouseDown) return; // Eğer mouse basılı değilse, işlemi durdur
        e.preventDefault();
        const x = e.pageX - tableContainer.offsetLeft;
        const walk = (x - startX) * 2; // Kaydırma hızını ayarlıyoruz
        tableContainer.scrollLeft = scrollLeft - walk;
    });

    // Mouse bırakıldığında
    tableContainer.addEventListener('mouseup', () => {
        isMouseDown = false;
    });

    // Mouse dışarıya çıktığında
    tableContainer.addEventListener('mouseleave', () => {
        isMouseDown = false;
    });

    // Yatay kaydırma işlemi için fare tekerleği desteği
    tableContainer.addEventListener('wheel', function(e) {
        if (e.deltaY === 0) {
            // Yalnızca yatay kaydırma işlemi
            tableContainer.scrollLeft += e.deltaX;
        }
    });
});
</script>

  </body>
</html>
