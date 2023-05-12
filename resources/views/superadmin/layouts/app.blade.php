<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Skydash Admin</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{asset('Admin/vendors/feather/feather.css')}}">
  <link rel="stylesheet" href="{{asset('Admin/vendors/ti-icons/css/themify-icons.css')}} ">
  <link rel="stylesheet" href="{{asset('Admin/vendors/css/vendor.bundle.base.css')}}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <link rel="stylesheet" href="{{asset('Admin/vendors/datatables.net-bs4/dataTables.bootstrap4.css')}}">
  <link rel="stylesheet" href="{{asset('Admin/vendors/ti-icons/css/themify-icons.css')}}">
  <link rel="stylesheet" href="{{asset('assets/vendors/datatables/datatables.min.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" type="text/css" href="{{asset('Admin/js/select.dataTables.min.css')}}">
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{asset('Admin/css/vertical-layout-light/style.css')}}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{asset('Admin/images/favicon.png')}}" />
  @yield('css')
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/css/toastr.css" rel="stylesheet" />

</head>
<body>
  <div class="container-scroller">
    <!-- partial:partials/_navbar.html -->
    @include('superadmin.layouts.nav')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
      <!-- partial:partials/_settings-panel.html -->
      @include('superadmin.layouts.thems')
      <!-- partial -->

      @include('superadmin.layouts.sidebar')
      
      <div class="main-panel">
        <div class="content-wrapper">
          <div class="row">

          @yield('content')
          </div>
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
       @include('superadmin.layouts.footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  <script src="{{asset('Admin/vendors/js/vendor.bundle.base.js')}} "></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="{{asset('Admin/vendors/chart.js/Chart.min.js')}} "></script>
  <script src="{{asset('Admin/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>
  <script src="{{asset('Admin/js/dataTables.select.min.js')}}"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" integrity="sha512-fD9DI5bZwQxOi7MhYWnnNPlvXdp/2Pj3XSTRrFs5FQa4mizyGLnJcN6tuvUS6LbmgN1ut+XGSABKvjN0H6Aoow==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="{{asset('Admin/vendors/datatables/jquery.dataTables.min.js')}}"></script>
  <script src="{{asset('Admin/vendors/datatables/datatables.min.js')}}"></script>

  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="{{asset('Admin/js/off-canvas.js')}}"></script>
  <script src="{{asset('Admin/js/hoverable-collapse.js')}}"></script>
  <script src="{{asset('Admin/js/template.js')}}"></script>
  <script src="{{asset('Admin/js/settings.js')}}"></script>
  <script src="{{asset('Admin/js/todolist.js')}}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{asset('Admin/js/dashboard.js')}}"></script>
  <script src="{{asset('Admin/js/Chart.roundedBarCharts.js')}}"></script>
  <!-- End custom js for this page-->

  @yield('js')

  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.0/js/toastr.js"></script>
  <script>
    $(document).ready(function() {
        toastr.options.timeOut = 10000;
        @if (Session::has('error'))
            toastr.error('{{ Session::get('error') }}');
        @elseif(Session::has('success'))
            toastr.success('{{ Session::get('success') }}');
        @endif
    });

</script>
</body>

</html>

