<!DOCTYPE html>
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="{{asset('adminasset')}}/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Cera Admin</title>

  <meta name="description" content="" />

  <!-- Favicon -->
  <link rel="icon" type="image/x-icon" href="{{asset('adminasset')}}/img/logo/cera_golden_logo.png" />

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

  <!-- Icons. Uncomment required icon fonts -->
  <link rel="stylesheet" href="{{asset('adminasset')}}/vendor/fonts/boxicons.css" />

  <!-- Core CSS -->
  <link rel="stylesheet" href="{{asset('adminasset')}}/vendor/css/core.css" class="template-customizer-core-css" />
  <link rel="stylesheet" href="{{asset('adminasset')}}/vendor/css/theme-default.css" class="template-customizer-theme-css" />
  <link rel="stylesheet" href="{{asset('adminasset')}}/css/demo.css" />

  <!-- Vendors CSS -->
  <link rel="stylesheet" href="{{asset('adminasset')}}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />
  <link rel="stylesheet" href="{{asset('adminasset')}}/vendor/libs/apex-charts/apex-charts.css" />
  <!-- Page CSS -->

  <!-- Helpers -->
  <script src="{{asset('adminasset')}}/vendor/js/helpers.js"></script>


  <script src="{{asset('adminasset')}}/js/config.js"></script>
  <link rel="stylesheet" type="text/css" href="{{asset('adminasset')}}/css/rtl/core.css" class="template-customizer-core-css">
  <link rel="stylesheet" type="text/css" href="{{asset('adminasset')}}/css/rtl/theme-default.css" class="template-customizer-theme-css">
  <script src="{{asset('adminasset')}}/vendor/libs/jquery/jquery.js"></script>
  <script src="{{asset('adminasset')}}/vendor/libs/DataTables/datatables.min.js"></script>

  <link rel="stylesheet" href="{{asset('adminasset')}}/vendor/libs/DataTables/datatables.min.css" />

  <style>
    #dataTable tbody tr {
      border-bottom: 1px solid #ddd;
    }
  </style>
</head>

<body>
  <!-- Layout wrapper -->
  <div class="layout-wrapper layout-content-navbar">
    <div class="layout-container">
      <!-- Menu -->

      <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
        <div class="app-brand demo">
          <a href="{{url('/admin/index')}}" class="app-brand-link">
            <span class="app-brand-logo demo">
              <img src="{{asset('adminasset')}}/img/logo/cera_golden_logo.png" alt="Notfound" width="45">
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">CERA</span>
          </a>

          <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
          </a>
        </div>

        <div class="menu-inner-shadow"></div>

        <ul class="menu-inner py-1">
          @if(session()->has('userfunctions'))


          <!-- Dashboard -->
          @php
          $dashboardFunctions = session('userfunctions')->whereIn('functionid',[11]);
          @endphp

          @if(!$dashboardFunctions->isEmpty())
          <li class="menu-item" id="menu_dashboard">
            <a href="{{url('admin/dashboard')}}" class="menu-link">
              <i class="menu-icon tf-icons bx bx-bar-chart-alt-2"></i>
              <div data-i18n="Analytics">Dashboard</div>
            </a>
          </li>
          @endif

          <!-- Company functions -->
          @php
          $scompanyFunctions = session('userfunctions')->whereIn('functionid',[3]);
          @endphp

          @if(!$scompanyFunctions->isEmpty())
          <li class="menu-item" id="menu_company">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-store"></i>
              <div data-i18n="menu_company">Company</div>
            </a>
            <ul class="menu-sub">
              @foreach($scompanyFunctions as $authorizedFunction)
              <li class="menu-item">
                {!! $authorizedFunction->function->url !!}
              </li>
              @endforeach
            </ul>
          </li>
          @endif

          <!-- Employee functions -->
          @php
          $employeeFunctions = session('userfunctions')->whereIn('functionid',[1,2]);
          @endphp

          @if(!$employeeFunctions->isEmpty())
          <li class="menu-item" id="menu_employee">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-user"></i>
              <div data-i18n="menu_employee">Employee</div>
            </a>
            <ul class="menu-sub">
              @foreach($employeeFunctions as $authorizedFunction)
              <li class="menu-item">
                {!! $authorizedFunction->function->url !!}
              </li>
              @endforeach
            </ul>
          </li>
          @endif


          <!-- Category functions -->
          @php
          $categoryFunctions = session('userfunctions')->whereIn('functionid',[12,13]);
          @endphp

          @if(!$categoryFunctions->isEmpty())
          <li class="menu-item" id="menu_category">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-category-alt"></i>
              <div data-i18n="menu_category">Category</div>
            </a>
            <ul class="menu-sub">
              @foreach($categoryFunctions as $authorizedFunction)
              <li class="menu-item">
                {!! $authorizedFunction->function->url !!}
              </li>
              @endforeach
            </ul>
          </li>
          @endif


          <!-- Production functions -->
          @php
          $productFunctions = session('userfunctions')->whereIn('functionid',[14]);
          @endphp

          @if(!$productFunctions->isEmpty())
          <li class="menu-item" id="menu_product">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-square"></i>
              <div data-i18n="menu_product">Product</div>
            </a>
            <ul class="menu-sub">
              @foreach($productFunctions as $authorizedFunction)
              <li class="menu-item">
                {!! $authorizedFunction->function->url !!}
              </li>
              @endforeach
            </ul>
          </li>
          @endif



          <!-- Fee functions -->
          @php
          $feeandvoucherFunctions = session('userfunctions')->whereIn('functionid',[7,8]);
          @endphp

          @if(!$feeandvoucherFunctions->isEmpty())
          <li class="menu-item" id="menu_feeandvoucher">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-money"></i>
              <div data-i18n="menu_feeandvoucher">Fee and Voucher</div>
            </a>
            <ul class="menu-sub">
              @foreach($feeandvoucherFunctions as $authorizedFunction)
              <li class="menu-item">
                {!! $authorizedFunction->function->url !!}
              </li>
              @endforeach
            </ul>
          </li>
          @endif


          <!-- Order functions -->
          @php
          $orderFunctions = session('userfunctions')->whereIn('functionid',[15]);
          @endphp

          @if(!$orderFunctions->isEmpty())
          <li class="menu-item" id="menu_order">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-shopping-bag"></i>
              <div data-i18n="menu_order">Order</div>
            </a>
            <ul class="menu-sub">
              @foreach($orderFunctions as $authorizedFunction)
              <li class="menu-item">
                {!! $authorizedFunction->function->url !!}
              </li>
              @endforeach
            </ul>
          </li>
          @endif

          <!-- Ecatalogue functions -->
          @php
          $ecatalogueFunctions = session('userfunctions')->whereIn('functionid',[9,10]);
          @endphp

          @if(!$ecatalogueFunctions->isEmpty())
          <li class="menu-item" id="menu_ecatalogue">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-book-open"></i>
              <div data-i18n="menu_ecatalogue">E-Catalogue</div>
            </a>
            <ul class="menu-sub">
              @foreach($ecatalogueFunctions as $authorizedFunction)
              <li class="menu-item">
                {!! $authorizedFunction->function->url !!}
              </li>
              @endforeach
            </ul>
          </li>
          @endif


          <!-- Blog functions -->
          @php
          $blogFunctions = session('userfunctions')->whereIn('functionid',[5,6]);
          @endphp

          @if(!$blogFunctions->isEmpty())
          <li class="menu-item" id="menu_blog">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-detail"></i>
              <div data-i18n="menu_blog">Blog</div>
            </a>
            <ul class="menu-sub">
              @foreach($blogFunctions as $authorizedFunction)
              <li class="menu-item">
                {!! $authorizedFunction->function->url !!}
              </li>
              @endforeach
            </ul>
          </li>
          @endif

          <!-- Contact functions -->
          @php
          $supportFunctions = session('userfunctions')->whereIn('functionid',[4]);
          @endphp

          @if(!$supportFunctions->isEmpty())
          <li class="menu-item" id="menu_support">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
              <i class="menu-icon tf-icons bx bx-support"></i>
              <div data-i18n="Blog">Support</div>
            </a>
            <ul class="menu-sub">
              @foreach($supportFunctions as $authorizedFunction)
              <li class="menu-item">
                {!! $authorizedFunction->function->url !!}
              </li>
              @endforeach
            </ul>
          </li>
          @endif





















          @endif





      </aside>
      <!-- / Menu -->

      <!-- Layout container -->
      <div class="layout-page">
        <!-- Navbar -->

        <nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
          <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
              <i class="bx bx-menu bx-sm"></i>
            </a>
          </div>

          <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            <div class="navbar-nav align-items-center">
              <div class="nav-item d-flex align-items-center">

              </div>
            </div>
            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">
              <!-- User -->
              <?php

              use Illuminate\Support\Facades\Auth;

              $sessionUser = Auth::guard('admin')->user();

              ?>

              <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                  <div class="avatar">
                    <img src="{{asset('adminasset/img/avatars/')}}/{{session('profilepic') != null ? session('profilepic') : ''}}" alt class="w-px-40 h-auto rounded-circle" />
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                  <li>
                    <a class="dropdown-item">
                      <div class="d-flex">
                        <div class="flex-shrink-0 me-3">
                          <div class="avatar avatar-online">
                            <img src="{{asset('adminasset/img/avatars/')}}/{{session('profilepic') != null ? session('profilepic') : ''}}" alt class="w-px-40 h-auto rounded-circle" />
                          </div>
                        </div>
                        <div class="flex-grow-1">
                          <span class="fw-semibold d-block">{{isset($sessionUser->firstname)? $sessionUser->firstname : ''}} {{isset($sessionUser->lastname)? $sessionUser->lastname : ''}}</span>
                          <small class="text-muted">{{session('role') != null ? session('role') : ''}}</small>
                        </div>
                      </div>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{url('admin/changepassword')}}">
                      <i class="bx bx-cog me-2"></i>
                      <span class="align-middle">Change Password</span>
                    </a>
                  </li>
                  <li>
                    <div class="dropdown-divider"></div>
                  </li>
                  <li>
                    <a class="dropdown-item" href="{{url('admin/logout')}}">
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

          <!-- Main body Section Begin -->
          @yield('mainbody')
          <!-- Main body Section End -->

          <!-- Toast Section -->
          @if(session('successMessage'))
          <div class="bs-toast toast fade show bg-success" role="alert" aria-live="assertive" aria-atomic="true" style="position: fixed; z-index:1000; bottom: 0; right: 0; margin-right:12px; margin-bottom:12px;">
            <div class="toast-header">
              <i class="bx bx-bell me-2"></i>
              <div class="me-auto fw-medium">Success</div>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
              {{session('successMessage')}}
            </div>
          </div>
          @endif

          @if(session('errorMessage'))
          <div class="bs-toast toast fade show bg-danger" role="alert" aria-live="assertive" aria-atomic="true" style="position: fixed; z-index:1000; bottom: 0; right: 0; margin-right:12px; margin-bottom:12px;">
            <div class="toast-header">
              <i class="bx bx-bell me-2"></i>
              <div class="me-auto fw-medium">Alert</div>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
              {{session('errorMessage')}}
            </div>
          </div>
          @endif

          @if(session('infoMessage'))
          <div class="bs-toast toast fade show bg-primary" role="alert" aria-live="assertive" aria-atomic="true" style="position: fixed; z-index:1000; bottom: 0; right: 0; margin-right:12px; margin-bottom:12px;">
            <div class="toast-header">
              <i class="bx bx-bell me-2"></i>
              <div class="me-auto fw-medium">Information</div>
              <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
              {{session('infoMessage')}}
            </div>
          </div>
          @endif
          <!-- Toast Section End -->

          <!-- Footer -->
          <footer class="content-footer footer bg-footer-theme">
            <div class="container-xxl d-flex flex-wrap justify-content-between py-2 flex-md-row flex-column">

            </div>
          </footer>
          <!-- / Footer -->

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

  <script src="{{asset('adminasset')}}/vendor/libs/popper/popper.js"></script>
  <script src="{{asset('adminasset')}}/vendor/js/bootstrap.js"></script>
  <script src="{{asset('adminasset')}}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
  <script src="{{asset('adminasset')}}/js/pages-account-settings-account.js"></script>
  <script src="{{asset('adminasset')}}/vendor/js/menu.js"></script>
  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="{{asset('adminasset')}}/vendor/libs/apex-charts/apexcharts.js"></script>
  <!-- Main JS -->
  <script src="{{asset('adminasset')}}/js/main.js"></script>

  <!-- Page JS -->
  <script src="{{asset('adminasset')}}/js/dashboards-analytics.js"></script>

</body>

</html>