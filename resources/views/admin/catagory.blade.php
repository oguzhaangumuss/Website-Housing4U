<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Admin Panel</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />

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

      <!-- Start Navbar -->
      @include('admin.tableresponsive1')
      <!-- End Navbar -->

      <!-- Start Scriptsrc codes -->
      @include('admin.infooutofproject')
      <!-- End Scriptsrc codes -->
  
  </body>
</html>
