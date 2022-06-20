
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('admin/assets/img/apple-icon.png') }} ">
  <link rel="icon" type="image/png" href="{{ asset('admin/assets/img/favicon.png') }}">
  <title>
    SILKROAD
  </title>
  <!--     Fonts and icons     -->
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
  <!-- Nucleo Icons -->
  <link href="{{ asset('admin/assets/css/nucleo-icons.css') }}" rel="stylesheet" />
  <link href="{{ asset('admin/assets/css/nucleo-svg.css') }}" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <script src="https://cdn.tiny.cloud/1/n8v5fd3e4kbniumd19u6u1a67etkem223kcmevvt7fw25pjc/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
  <!-- Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
  <!-- CSS Files -->
  <link id="pagestyle" href="{{ asset('admin/assets/css/material-dashboard.css?v=3.0.0') }}" rel="stylesheet" />
</head>

<body class="g-sidenav-show  bg-gray-200">
  @include('layout_admin.asidebar')
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
   <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                  <i class="sidenav-toggler-line"></i>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4" style="min-height: 100vh;">
	    <div class="row" style="min-height: 82vh;">
	        @yield('content')
	    </div>
      @include('layout_admin.footer')
    </div>
  </main>



  <!--   Core JS Files   -->
  <script src="{{ asset('admin/assets/js/core/popper.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/core/bootstrap.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/plugins/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/plugins/smooth-scrollbar.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/plugins/chartjs.min.js') }}"></script>

  
  
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="{{ asset('admin/assets/js/material-dashboard.min.js?v=3.0.0') }}"></script>
  @yield('js')
</body>

</html>