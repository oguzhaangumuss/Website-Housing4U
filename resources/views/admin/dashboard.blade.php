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

      <!-- Start User Stats -->
      @include('admin.hoam')
      <!-- End User Stats -->

      <!-- Start User Stats -->
      @include('admin.userstats')
      <!-- End User Stats -->

      <!-- Start Daily Sales -->
      @include('admin.dailysalescard')
      <!-- End Daily Sales -->

      <!-- Start Online Users Chart -->
      @include('admin.onlineuserscard')
      <!-- End Online Users Chart -->

      
      <!-- Start User Geolocation -->
      @include('admin.usergeolocation')
      <!-- End User Geolocation -->

      <!-- Start New Customers -->
      @include('admin.newcustomers')
      <!-- End New Customers -->

      <!-- Start Transaction History -->
      @include('admin.transactionhistory')
      <!-- End Transaction History -->

      <!-- Start Footer -->
      @include('admin.adminfooter')
      <!-- End Footer -->
      <!-- Start Scriptsrc codes -->
      @include('admin.infooutofproject')
      <!-- End Scriptsrc codes -->
  
  </body>
</html>
