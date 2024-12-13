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
    <h1>Edit User</h1>
    <form action="{{ route('admin.userprocess.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ $user->name }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ $user->email }}" required>
        </div>

        <div class="form-group">
            <label for="role">Role</label>
            <select name="role" id="role" class="form-control" required>
                @foreach($roles as $role)
                    <option value="{{ $role->name }}" {{ in_array($role->name, $user->roles->pluck('name')->toArray()) ? 'selected' : '' }}>{{ $role->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success mt-3">Update User</button>
    </form>
</div>

    <!-- Start Footer -->
    @include('admin.adminfooter')
      <!-- End Footer -->
      <!-- Start Scriptsrc codes -->
      @include('admin.infooutofproject')
      <!-- End Scriptsrc codes -->
  
  </body>
</html>
