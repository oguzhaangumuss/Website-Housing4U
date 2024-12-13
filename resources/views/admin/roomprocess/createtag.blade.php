
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Create Tag</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <base href="/public">
    @include('admin.headinfo') <!-- Admin paneli başlık bilgileri -->
</head>
<body>

    @include('admin.sidebar') <!-- Admin paneli sol menü -->
    @include('admin.navbar') <!-- Admin paneli üst menü -->
    @include('admin.infosection') <!-- Admin paneli bilgi bölümü -->
    <div class="container my-4">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Create New Tag</h5>
            </div>
            <div class="card-body">
                <!-- Etiket Oluşturma Formu -->
                <form action="{{ route('admin.roomprocess.storetag') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Tag Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <button type="submit" class="btn btn-success">Create Tag</button>
                </form>
            </div>
        </div>
    </div>
    
    @include('admin.adminfooter') <!-- Admin paneli altbilgi -->
    @include('admin.infooutofproject') <!-- Diğer scriptler -->

</body>
</html>