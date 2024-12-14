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
    <h1>Bloglar</h1>
    <a href="{{ route('admin.blog.create') }}" class="btn btn-primary">Yeni Blog Ekle</a>

    @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
    @endif

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Başlık</th>
                <th>İşlemler</th>
            </tr>
        </thead>
        <tbody>
            @foreach($blogs as $blog)
                <tr>
                    <td>{{ $blog->title }}</td>
                    <td>
                        <a href="{{ route('admin.blog.edit', $blog->id) }}" class="btn btn-warning">Düzenle</a>
                        <form action="{{ route('admin.blog.destroy', $blog->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Sil</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Start Footer -->
    @include('admin.adminfooter')
    <!-- End Footer -->

    <!-- Start Scriptsrc codes -->
    @include('admin.infooutofproject')
    <!-- End Scriptsrc codes -->

 
  </body>
</html>