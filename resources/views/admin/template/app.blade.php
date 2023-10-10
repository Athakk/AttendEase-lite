<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="en"
  class="light-style layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{ asset('backoffice') }}"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <meta name="description" content="" />

      <!-- Favicon -->
      <link rel="icon" type="image/x-icon" href="{{ asset('backoffice/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('backoffice/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('backoffice/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('backoffice/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('backoffice/css/demo.css') }}" />

    {{-- toastr --}}
    <link rel="stylesheet" href="{{ asset('backoffice/css/toastr.css') }}"/>



    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{ asset('backoffice/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />

    <link rel="stylesheet" href="{{ asset('backoffice/vendor/libs/apex-charts/apex-charts.css') }}" />

    <!-- Page CSS -->

    <!-- Helpers -->
    <script src="{{ asset('backoffice/vendor/js/helpers.js') }}"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('backoffice/js/config.js') }}"></script>
    <script src="{{ asset('backoffice/vendor/libs/jquery/jquery.js') }}"></script>

    
    {{-- SweetAlert --}}
    <script src="{{ asset('backoffice/js/SweetAlert.min.js') }}"></script>
    
    {{-- DataTable --}}
    <script src="{{ asset('backoffice/js/jquery.dataTables.js') }}"></script>
    <link href="{{ asset('backoffice/css/jquery.dataTables.css') }}" rel="stylesheet">

    {{-- Dropify --}}
    <script src="{{ asset('backoffice/js/dropify.js') }}"></script>
    <link href="{{ asset('backoffice/css/dropify.css') }}" rel="stylesheet">

    <script src="{{ asset('backoffice/js/select2.min.js') }}"></script>
    <link href="{{ asset('backoffice/css/select2.min.css') }}" rel="stylesheet" />
  

    @yield('head')


  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
        <!-- Menu -->

        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
          <div class="app-brand demo">
            <a href="index.html" class="app-brand-link">
              <span class="app-brand-logo demo">
                <i class='bx bxs-user-circle fs-1'></i>
              </span>
              <span class="demo menu-text fs-3 fw-bolder ms-2">Attend<span class="text-primary">Ease</span></span>
            </a>

            <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
              <i class="bx bx-chevron-left bx-sm align-middle"></i>
            </a>
          </div>

          <div class="menu-inner-shadow"></div>

          <ul class="menu-inner py-1 {{ Auth::user()->level == 'admin' ? '' : 'd-none' }}">
            <li class="menu-item {{ Route::current()->getName() == 'dashboard' ? 'active' : '' }}">
              <a href="{{ route('dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div>Dashboard</div>
              </a>
            </li>
            <li class="menu-item {{ Route::current()->getName() == 'admin.absensi' ? 'active' : '' }}">
              <a href="{{ route('admin.absensi') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div>Absensi</div>
              </a>
            </li>
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Laporan</span></li>
            <li class="menu-item {{ Route::current()->getName() == 'laporan.index' ? 'active' : '' }}">
              <a href="{{ route('laporan.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-copy-alt"></i>
                <div>Laporan Absensi</div>
              </a>
            </li>
            <li class="menu-header small text-uppercase"><span class="menu-header-text">Components</span></li>
            <li class="menu-item {{ Auth::user()->level !== 'admin' ? 'd-none' : '' }}">
              <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-calendar"></i>
                <div data-i18n="Pola Kerja">Pola Kerja</div>
              </a>
              <ul class="menu-sub">
                <li class="menu-item {{ explode('.', Route::current()->getName())[0] == 'hariKerja' ? 'active' : '' }}">
                  <a href="{{ route('hariKerja.index') }}" class="menu-link">
                    <div data-i18n="Hari Kerja">Hari Kerja</div>
                  </a>
                </li>
                <li class="menu-item {{ explode('.', Route::current()->getName())[0] == 'shift' ? 'active' : '' }}">
                  <a href="{{ route('shift.index') }}" class="menu-link">
                    <div data-i18n="Shift">Shift</div>
                  </a>
                </li>
              </ul>
            </li>
            <li class="menu-item {{ Route::current()->getName() == 'user' ? 'active' : '' }}">
              <a href="{{ route('user.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="User">User</div>
              </a>
            </li>
          </ul>
          <ul class="menu-inner py-1 {{ Auth::user()->level == 'user' ? '' : 'd-none' }}">
            <li class="menu-item {{ Route::current()->getName() == 'user.absensi' ? 'active' : '' }}">
              <a href="{{ route('user.absensi') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-calendar-check"></i>
                <div>Absensi</div>
              </a>
            </li>
            <li class="menu-item {{ Route::current()->getName() == 'hariKerjaShift.index' ? 'active' : '' }}">
              <a href="{{ route('hariKerjaShift.index') }}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-clipboard"></i>
                <div>Hari Kerja & shift</div>
              </a>
            </li>
          </ul>
        </aside>
        <!-- / Menu -->

        <!-- Layout container -->
        <div class="layout-page">
          <!-- Navbar -->
          <nav
            class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
            id="layout-navbar"
          >
            <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
              <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
              </a>
            </div>

            <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
              <!-- Search -->
              <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                  <div id="clock"></div>
                </div>
              </div>
              <!-- /Search -->

              <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->
           
                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                  <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                      <img src="{{ asset('backoffice/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                    </div>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                      <div class="dropdown-item">
                        <div class="d-flex">
                          <div class="flex-shrink-0 me-3">
                            <div class="avatar avatar-online">
                              <img src="{{ asset('backoffice/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle" />
                            </div>
                          </div>
                          <div class="flex-grow-1">
                            <span class="fw-semibold d-block">{{ Auth::user()->name }}</span>
                            <small class="text-muted">{{ Auth::user()->level }}</small>
                          </div>
                        </div>
                      </div>
                    </li>
                    <li>
                      <div class="dropdown-divider"></div>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ route('myprofile.index', Auth::user()) }}">
                        <i class="bx bx-user me-2"></i>
                        <span class="align-middle">My Profile</span>
                      </a>
                    </li>
                    <li class="{{ Auth::user()->level == 'admin' ? 'd-none' : '' }}">
                      <a class="dropdown-item" href="{{ route('hariKerjaShift.index') }}">
                        <i class="bx bx-network-chart me-2"></i>
                        <span class="align-middle">Pilih Pola Kerja</span>
                      </a>
                    </li>
                    <li>
                      <a class="dropdown-item" href="{{ route('logout') }}">
                        <i class="bx bx-power-off me-2"></i>
                        <span class="align-middle">Log Out</span>
                      </a>
                    </li>
                  </ul>
                </li>
                <!--/ User -->
              </ul>
            </div>
          </nav>

          <!-- / Navbar -->

          <!-- Content wrapper -->
          <div class="content-wrapper">
            <!-- Content -->

            <div class="container-xxl flex-grow-1 container-p-y">
             
                @yield('content')

            </div>
            <!-- / Content -->



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

    

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{ asset('backoffice/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('backoffice/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('backoffice/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>

    <script src="{{ asset('backoffice/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->
    <script src="{{ asset('backoffice/vendor/libs/apex-charts/apexcharts.js') }}"></script>

    <!-- Main JS -->
    <script src="{{ asset('backoffice/js/main.js') }}"></script>

    <!-- Page JS -->
    <script src="{{ asset('backoffice/js/dashboards-analytics.js') }}"></script>

    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    {{-- Toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <!-- Clock -->
    <script>
        function updateClock() {
            const now = new Date();
            const days = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', "Jum'at", 'Sabtu'];
            const months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Augustus', 'September',
                'Oktober', 'November', 'Desember'
            ];

            const day = days[now.getDay()];
            const date = now.getDate();
            const month = months[now.getMonth()];
            const year = now.getFullYear();

            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');

            const clockDiv = document.getElementById('clock');
            clockDiv.innerHTML = `${day}, ${date} ${month} ${year} - ${hours}:${minutes}:${seconds}`;
        }

        // Update clock every second
        setInterval(updateClock, 1000);

        // DataTable
        $(document).ready(function() {
            $('#myTable').DataTable();
            $('#hariKerjaTable').DataTable();
            $('#shiftTable').DataTable();
        });

        //Toastr
        @if (Session::has('success'))
            toastr.success('{{ Session::get('success') }}');
        @elseif (Session::has('error'))
            toastr.error('{{ Session::get('error') }}');
        @endif
    </script>


  </body>
</html>
