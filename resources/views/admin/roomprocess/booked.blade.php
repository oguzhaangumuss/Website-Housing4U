<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Edit Room</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <base href="/public">
    @include('admin.headinfo')
    <!-- Admin paneli başlık bilgileri --><style>
    .form-container {
        width: 100%;
        max-width: 600px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }
    .form-group {
        margin-bottom: 15px;
    }
    .form-group label {
        display: block;
        font-weight: bold;
        margin-bottom: 5px;
    }
    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 4px;
        font-size: 14px;
    }
    .form-control:focus {
        border-color: #007bff;
        outline: none;
    }
    .btn {
        padding: 10px 20px;
        background-color: #007bff;
        border: none;
        border-radius: 4px;
        color: white;
        font-size: 16px;
        cursor: pointer;
    }
    .btn:hover {
        background-color: #0056b3;
    }
</style>
</head>

<body>

    @include('admin.sidebar')
    <!-- Admin paneli sol menü -->
    @include('admin.navbar')
    <!-- Admin paneli üst menü -->
    @include('admin.infosection')
    <!-- Admin paneli bilgi bölümü -->

@include('admin.roomprocess.booking-form')
    @include('admin.adminfooter')
    <!-- Admin paneli altbilgi -->
    @include('admin.infooutofproject')
    <!-- Diğer scriptler -->

</body>

</html>
