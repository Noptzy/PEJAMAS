
<!DOCTYPE html>

<html
  lang="en"
  class="@auth light-style layout-menu-fixed @else light-style customizer-hide @endauth"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('Backend') }}"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>@yield('title')</title>

    <meta name="description" content="Pengaduan Jalan Masyarakat" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Favicon -->
    <link href="{{ asset ('BizLand/Pejamas Icon.png')}}" rel="icon">
    <link href="{{ asset('BizLand/assets/img/apple-touch-icon.png')}}" rel="apple-touch-icon">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('Backend/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('Backend/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('Backend/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('Backend/css/demo.css') }}" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('Backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('Backend/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('Backend/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('Backend/js/config.js') }}"></script>
    @stack('custom-css')
  </head>

  <body>
    @auth
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->
         <!-- sidebar disini -->
         <x-Dashboard.sidebar-component/>
        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          <x-Dashboard.navbar-component />
          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->
             @yield('content')
            <!-- / Content -->

            <x-Dashboard.footer-component />

            <div class="content-backdrop fade"></div>
          </div>
          <!-- Content wrapper -->
        </div>
        <!-- / Layout page -->
      </div>

      <!-- Overlay -->
      <div class="layout-overlay layout-menu-toggle"></div>
    </div>
    <!-- / Layout wrapper -->
    @else
        @yield('content')
    @endauth
    <!-- build:js Backend/vendor/js/core.js -->
    <script src="{{ asset('Backend/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('Backend/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('Backend/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('Backend/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('Backend/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('Backend/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('Backend/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('Backend/js/Backends-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Core JS -->
    <script src="{{ asset('Backend/js/ui-toasts.js') }}"></script>
     @stack('custom-js')
  </body>
</html>
