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
    <h1>User Management</h1>
    <a href="{{ route('admin.userprocess.create') }}" class="btn btn-primary mb-3">Add New User</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->roles->pluck('name')->join(', ') }}</td>
                    <td>
                        <a href="{{ route('admin.userprocess.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.userprocess.destroy', $user->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pagination Links -->
    <div class="d-flex justify-content-center mt-4">
        {{ $users->links('pagination::bootstrap-5') }}
    </div>
</div>
    <!-- Start Footer -->
    @include('admin.adminfooter')
      <!-- End Footer -->
      <!-- Start Scriptsrc codes -->
      @include('admin.infooutofproject')
      <!-- End Scriptsrc codes -->
  
  </body>
</html>
