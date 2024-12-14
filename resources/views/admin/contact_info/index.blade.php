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
    <div class="container">
    <h1>Contact Information</h1>
    
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <ul>
        <li><strong>Facebook:</strong> {{ $contactInfo->facebook ?? 'N/A' }}</li>
        <li><strong>Twitter:</strong> {{ $contactInfo->twitter ?? 'N/A' }}</li>
        <li><strong>Instagram:</strong> {{ $contactInfo->instagram ?? 'N/A' }}</li>
        <li><strong>LinkedIn:</strong> {{ $contactInfo->linkedin ?? 'N/A' }}</li>
        <li><strong>Email:</strong> {{ $contactInfo->email ?? 'N/A' }}</li>
        <li><strong>Phone:</strong> {{ $contactInfo->phone ?? 'N/A' }}</li>
    </ul>

    <a href="{{ route('admin.contact_info.edit') }}" class="btn btn-primary">Edit Contact Info</a>
    </div>
    @include('admin.adminfooter')
    <!-- Admin paneli altbilgi -->
    @include('admin.infooutofproject')
    <!-- Diğer scriptler -->

</body>

</html>