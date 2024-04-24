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
  class="light-style customizer-hide"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{asset('adminasset')}}/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />

    <title>Set New Password</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{asset('adminasset')}}/img/logo/cera_golden_logo.png" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{asset('adminasset')}}/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{asset('adminasset')}}/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{asset('adminasset')}}/vendor/css/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{asset('adminasset')}}/css/demo.css" />

    <!-- Vendors CSS -->
    <link rel="stylesheet" href="{{asset('adminasset')}}/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{asset('adminasset')}}/vendor/css/pages/page-auth.css" />
    <!-- Helpers -->
    <script src="{{asset('adminasset')}}/vendor/js/helpers.js"></script>

    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{asset('adminasset')}}/js/config.js"></script>
  </head>

  <body>
    <!-- Content -->

    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner py-4">
          <!-- Forgot Password -->
          <div class="card">
            <div class="card-body">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="index.html" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                    <img src="{{asset('adminasset')}}/img/logo/cera_golden_logo.png" alt="Notfound" width="80">
                  </span>
                  <span class="app-brand-text demo text-body fw-bolder"></span>
                </a>
              </div>
              <!-- /Logo -->
              <p class="mb-4">Please enter require information to reset your password</p>

              @if (session('errorMessage'))
                <div class="d-flex justify-content-center mb-1" >
                    <span class="badge bg-label-danger text-wrap" style="line-height: 1.5em;">{{ session('errorMessage') }}</span>
                </div>                  
              @endif

              <form id="formAuthentication" class="mb-3" action="{{url('/admin/resetpasswordwithtoken')}}" method="POST">
              @csrf
                <div class="mb-3" hidden>
                  <label for="token" class="form-label">Reset Token</label>
                  <input type="password" class="form-control" name="token" value="{{isset($token) ? $token : ''}}" placeholder="Enter reset token" autofocus autocomplete="FALSE"/>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" name="password" placeholder="Enter password" autofocus />
                </div>
                <div class="mb-3">
                  <label for="confirmpassword" class="form-label">Re-enter Password</label>
                  <input type="password" class="form-control" name="confirmpassword" placeholder="Confirm Password" autofocus />
                </div>
                <button type="submit" class="btn btn-primary d-grid w-100">Change Password</button>
              </form>

              <div class="text-center">
                <a href="{{url('/admin/login')}}" class="d-flex align-items-center justify-content-center">
                  <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                  Back to login
                </a>
              </div>
            </div>
          </div>
          <!-- /Forgot Password -->
        </div>
      </div>
    </div>

    <!-- / Content -->

    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->
    <script src="{{asset('adminasset')}}/vendor/libs/jquery/jquery.js"></script>
    <script src="{{asset('adminasset')}}/vendor/libs/popper/popper.js"></script>
    <script src="{{asset('adminasset')}}/vendor/js/bootstrap.js"></script>
    <script src="{{asset('adminasset')}}/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

    <script src="{{asset('adminasset')}}/vendor/js/menu.js"></script>
    <!-- endbuild -->

    <!-- Vendors JS -->

    <!-- Main JS -->
    <script src="{{asset('adminasset')}}/js/main.js"></script>

    <!-- Page JS -->
  </body>
</html>
