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
    <h1>Edit Contact Information</h1>

<form action="{{ route('admin.contact_info.update') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="facebook">Facebook</label>
        <input type="url" name="facebook" id="facebook" value="{{ $contactInfo->facebook ?? '' }}" class="form-control" />
    </div>

    <div class="form-group">
        <label for="twitter">Twitter</label>
        <input type="url" name="twitter" id="twitter" value="{{ $contactInfo->twitter ?? '' }}" class="form-control" />
    </div>

    <div class="form-group">
        <label for="instagram">Instagram</label>
        <input type="url" name="instagram" id="instagram" value="{{ $contactInfo->instagram ?? '' }}" class="form-control" />
    </div>

    <div class="form-group">
        <label for="linkedin">LinkedIn</label>
        <input type="url" name="linkedin" id="linkedin" value="{{ $contactInfo->linkedin ?? '' }}" class="form-control" />
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" name="email" id="email" value="{{ $contactInfo->email ?? '' }}" class="form-control" />
    </div>

    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" name="phone" id="phone" value="{{ $contactInfo->phone ?? '' }}" class="form-control" />
    </div>

    <button type="submit" class="btn btn-primary mt-3">Update</button>
</form>
    @include('admin.adminfooter')
    <!-- Admin paneli altbilgi -->
    @include('admin.infooutofproject')
    <!-- Diğer scriptler -->

</body>

</html>