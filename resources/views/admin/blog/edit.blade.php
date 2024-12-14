<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Admin Panel - Add Blog</title>
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
    <h1>Blog Düzenle</h1>

<form action="{{ route('admin.blog.update', $blog->id) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label for="title">Başlık</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ $blog->title }}" required>
    </div>

    <div class="form-group">
        <label for="content">İçerik</label>
        <textarea name="content" id="content" class="form-control" rows="5" required>{{ $blog->content }}</textarea>
    </div>

    <button type="submit" class="btn btn-success mt-3">Güncelle</button>
</form>
    <!-- Start Footer -->
    @include('admin.adminfooter')
    <!-- End Footer -->

    <!-- Start Scriptsrc codes -->
    @include('admin.infooutofproject')
    <!-- End Scriptsrc codes -->

 
  </body>
</html>