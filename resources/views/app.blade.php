<!DOCTYPE html>

<html lang="en" class="light-style layout-navbar-fixed layout-menu-fixed layout-compact " dir="ltr" data-theme="theme-bordered" data-assets-path="/Leopard_courier/assets/" data-template="vertical-menu-template-bordered" data-style="light">


<!-- Mirrored from demos.themeselection.com/materio-bootstrap-html-admin-template/html/vertical-menu-template-bordered/form-layouts-vertical.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 01 May 2024 13:20:12 GMT -->
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Booking</title>


    <meta name="description" content="Start your development with a Dashboard for Bootstrap 5" />
    <meta name="keywords" content="dashboard, material, material design, bootstrap 5 dashboard, bootstrap 5 design, bootstrap 5">
    <!-- Canonical SEO -->
    <link rel="canonical" href="https://themeselection.com/item/materio-bootstrap-html-admin-template/">


    <!-- ? PROD Only: Google Tag Manager (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
      new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
      j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
      '../../../../www.googletagmanager.com/gtm5445.html?id='+i+dl;f.parentNode.insertBefore(j,f);
      })(window,document,'script','dataLayer','GTM-5DDHKGP');</script>
    <!-- End Google Tag Manager -->

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com/">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;ampdisplay=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset("assets/vendor/fonts/remixicon/remixicon.css") }}" />
    <link rel="stylesheet" href="{{ asset("assets/vendor/fonts/flag-icons.css") }}" />

    <!-- Menu waves for no-customizer fix -->
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/node-waves/node-waves.css') }}" />

<!-- Core CSS -->
<link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/core.css') }}" class="template-customizer-core-css" />
<link rel="stylesheet" href="{{ asset('assets/vendor/css/rtl/theme-bordered.css') }}" class="template-customizer-theme-css" />
<link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" />

<!-- Vendors CSS -->
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/typeahead-js/typeahead.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/flatpickr/flatpickr.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/select2/select2.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-buttons-bs5/buttons.bootstrap5.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/jquery-timepicker/jquery-timepicker.css') }}" />
<link rel="stylesheet" href="{{ asset('assets/vendor/libs/pickr/pickr-themes.css') }}" />


<!-- Include JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>


    <!-- Page CSS -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Helpers -->
<script src="{{ asset('assets/vendor/js/helpers.js') }}"></script>

<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
<!--? Template customizer: To hide customizer set displayCustomizer value false in config.js.  -->
<!-- <script src="{{ asset('assets/vendor/js/template-customizer.js') }}"></script> -->

<!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
<script src="{{ asset('assets/js/config.js') }}"></script>

    <!-- In header.php -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<style>
    /* Dropdown container */
.multiselect__content-wrapper {
  position: absolute;
  width: 100%;
  max-height: 250px;
  overflow-y: auto;
  background: #ffffff;               /* White background */
  border: 1px solid #cbd5e1;        /* Soft gray border */
  border-radius: 5px;
  box-shadow: 0 2px 6px rgba(100, 116, 139, 0.1); /* subtle shadow */
  z-index: 1000;
  box-sizing: border-box;
}

/* Each option */
.multiselect__option {
  padding: 10px 15px;
  font-size: 14px;
  color: #374151;                   /* Medium dark gray */
  cursor: pointer;
  width: 100%;                     /* Full width */
  box-sizing: border-box;
  transition: background-color 0.15s ease;
}

/* Hover effect */
.multiselect__option--highlight {
  background-color: #f3f4f6;       /* Very light gray */
  color: #1f2937;
  width: 100%;           /* Darker gray */
}

/* Selected option styling */
.multiselect__option--selected {
  background-color: #e5e7eb;       /* Light gray */
  font-weight: 600;
  width: 100%;                    /* Ensure selected option fills width */
  color: #111827;                 /* Darker text for selected */
}

/* Disabled option */
.multiselect__option--disabled {
  color: #9ca3af;
  cursor: not-allowed;
}

/* Scrollbar for Webkit browsers */
.multiselect__content-wrapper::-webkit-scrollbar {
  width: 7px;
}

.multiselect__content-wrapper::-webkit-scrollbar-track {
  background: #f9fafb;
  border-radius: 5px;
}

.multiselect__content-wrapper::-webkit-scrollbar-thumb {
  background-color: #cbd5e1;
  border-radius: 5px;
  border: 2px solid #f9fafb;
}
    </style>

@routes
@vite(['resources/js/app.ts', "resources/js/pages/{$page['component']}.vue"])
@inertiaHead
</head>
<style>

  .menu-vertical .menu-item .menu-link{
        text-decoration: none;

  }
   .dataTables_wrapper .row{
        padding: 15px 25px;
  }
  .dataTables_wrapper .dt-row{
    padding: 0 !important;
  }
  .text-nowrap {
    white-space: wrap !important;
}

.loader {
    width: 48px;
    height: 48px;
    border: 5px solid #FFF;
    border-bottom-color: transparent;
    border-radius: 50%;
    display: inline-block;
    box-sizing: border-box;
    animation: rotation 1s linear infinite;
    }
.loader.small {
    width: 20px;
    height: 20px;
}

    @keyframes rotation {
    0% {
        transform: rotate(0deg);
    }
    100% {
        transform: rotate(360deg);
    }
    }
</style>
<body>


  <!-- ?PROD Only: Google Tag Manager (noscript) (Default ThemeSelection: GTM-5DDHKGP, PixInvent: GTM-5J3LMKC) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5DDHKGP" height="0" width="0" style="display: none; visibility: hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->

  <!-- Layout wrapper -->
<div class="layout-wrapper layout-content-navbar  ">
  <div class="layout-container">
<!-- Menu -->

<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">


  <div class="app-brand demo ">
    <a href="index.html" class="app-brand-link">
      <span class="app-brand-logo demo me-1">
<span style="color:var(--bs-primary);">
  <svg width="30" height="24" viewBox="0 0 250 196" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.3002 1.25469L56.655 28.6432C59.0349 30.1128 60.4839 32.711 60.4839 35.5089V160.63C60.4839 163.468 58.9941 166.097 56.5603 167.553L12.2055 194.107C8.3836 196.395 3.43136 195.15 1.14435 191.327C0.395485 190.075 0 188.643 0 187.184V8.12039C0 3.66447 3.61061 0.0522461 8.06452 0.0522461C9.56056 0.0522461 11.0271 0.468577 12.3002 1.25469Z" fill="currentColor" />
    <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd" d="M0 65.2656L60.4839 99.9629V133.979L0 65.2656Z" fill="black" />
    <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd" d="M0 65.2656L60.4839 99.0795V119.859L0 65.2656Z" fill="black" />
    <path fill-rule="evenodd" clip-rule="evenodd" d="M237.71 1.22393L193.355 28.5207C190.97 29.9889 189.516 32.5905 189.516 35.3927V160.631C189.516 163.469 191.006 166.098 193.44 167.555L237.794 194.108C241.616 196.396 246.569 195.151 248.856 191.328C249.605 190.076 250 188.644 250 187.185V8.09597C250 3.64006 246.389 0.027832 241.935 0.027832C240.444 0.027832 238.981 0.441882 237.71 1.22393Z" fill="currentColor" />
    <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd" d="M250 65.2656L189.516 99.8897V135.006L250 65.2656Z" fill="black" />
    <path opacity="0.077704" fill-rule="evenodd" clip-rule="evenodd" d="M250 65.2656L189.516 99.0497V120.886L250 65.2656Z" fill="black" />
    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z" fill="currentColor" />
    <path fill-rule="evenodd" clip-rule="evenodd" d="M12.2787 1.18923L125 70.3075V136.87L0 65.2465V8.06814C0 3.61223 3.61061 0 8.06452 0C9.552 0 11.0105 0.411583 12.2787 1.18923Z" fill="white" fill-opacity="0.15" />
    <path fill-rule="evenodd" clip-rule="evenodd" d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z" fill="currentColor" />
    <path fill-rule="evenodd" clip-rule="evenodd" d="M237.721 1.18923L125 70.3075V136.87L250 65.2465V8.06814C250 3.61223 246.389 0 241.935 0C240.448 0 238.99 0.411583 237.721 1.18923Z" fill="white" fill-opacity="0.3" />
  </svg>
</span>
</span>
      <span class="app-brand-text demo menu-text fw-semibold ms-2">Materio</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
      <i class="menu-toggle-icon d-xl-block align-middle"></i>
    </a>
  </div>

  <div class="menu-inner-shadow"></div>



<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<ul class="menu-inner py-1 <?php echo ($current_page == '/Leopard_courier/create_order.php' || $current_page == '/Leopard_courier/manage_booked_packet.php' || $current_page == '/Leopard_courier/add_vendor.php' || $current_page == '/Leopard_courier/manage_vendor.php') ? 'active open' : ''; ?>">

  <li class="menu-item">
    <a href="javascript:void(0);" class="menu-link menu-toggle">
      <i class="menu-icon tf-icons ri-box-3-line"></i>
      <div>Manage Booking</div>
    </a>
    <ul class="menu-sub">
      <li class="menu-item <?php echo ($current_page == '/Leopard_courier/create_order.php') ? 'active' : ''; ?>">
        <a href="/Leopard_courier/create_order.php" class="menu-link">
          <div>Booked A Packet</div>
        </a>
      </li>
      <li class="menu-item <?php echo ($current_page == '/Leopard_courier/manage_booked_packet.php') ? 'active' : ''; ?>">
        <a href="/Leopard_courier/manage_booked_packet.php" class="menu-link">
          <div>Manage Booked Packet</div>
        </a>
      </li>
    </ul>
  </li>


      <li class="menu-item <?php echo ($current_page == '/Leopard_courier/manage_vendor.php') ? 'active' : ''; ?>">
        <a href="/Leopard_courier/vendor/manage_vendor.php" class="menu-link">
        <i class="menu-icon tf-icons ri-box-3-line"></i>
          <div>Manage Vendor</div>
        </a>
      </li>
      <li class="menu-item <?php echo ($current_page == '/Leopard_courier/manage_platforms.php') ? 'active' : ''; ?>">
        <a href="/Leopard_courier/platform/manage_platforms.php" class="menu-link">
        <i class="menu-icon tf-icons ri-box-3-line"></i>
          <div>Manage Platform</div>
        </a>
      </li>
      <li class="menu-item <?php echo ($current_page == '/Leopard_courier/manage_packaging_materials.php') ? 'active' : ''; ?>">
        <a href="/Leopard_courier/packaging_material/manage_packaging_materials.php" class="menu-link">
        <i class="menu-icon tf-icons ri-box-3-line"></i>
          <div>Manage Packaging Material</div>
        </a>
      </li>

</ul>




</aside>
<!-- / Menu -->



    <!-- Layout container -->
    <div class="layout-page">





<!-- Navbar -->

<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">









      <div class="layout-menu-toggle navbar-nav align-items-xl-center me-4 me-xl-0   d-xl-none ">
        <a class="nav-item nav-link px-0 me-xl-6" href="javascript:void(0)">
          <i class="ri-menu-fill ri-24px"></i>
        </a>
      </div>


      <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">


        <!-- Search -->
        <div class="navbar-nav align-items-center">
          <div class="nav-item navbar-search-wrapper mb-0">
            <a class="nav-item nav-link search-toggler fw-normal px-0" href="javascript:void(0);">
              <i class="ri-search-line ri-22px scaleX-n1-rtl me-1_5"></i>
              <span class="d-none d-md-inline-block text-muted ms-1_5">Search (Ctrl+/)</span>
            </a>
          </div>
        </div>
        <!-- /Search -->





        <ul class="navbar-nav flex-row align-items-center ms-auto">
          <!-- User -->
          <li class="nav-item navbar-dropdown dropdown-user dropdown">
            <a class="nav-link dropdown-toggle hide-arrow p-0" href="javascript:void(0);" data-bs-toggle="dropdown">
              <div class="avatar avatar-online">
                <img src="{{ asset("assets/img/avatars/1.png") }}" alt class="w-px-40 h-auto rounded-circle">
              </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end mt-3 py-2">
              <li>
                <a class="dropdown-item pb-3" href="pages-account-settings-account.html">
                  <div class="d-flex align-items-center">
                    <div class="flex-shrink-0 me-3">
                      <div class="avatar avatar-online">
                        <img src="{{ asset('assets/img/avatars/1.png') }}" alt class="w-px-40 h-auto rounded-circle">
                      </div>
                    </div>
                    <div class="flex-grow-1">
                      <h6 class="mb-0 small">John Doe</h6>
                      <small class="text-muted">Admin</small>

                    </div>
                  </div>
                </a>
              </li>
              <li>
                <div class="dropdown-divider my-0"></div>
              </li>
              <li>
                <a class="dropdown-item" href="pages-profile-user.html">
                  <i class="ri-user-3-line ri-22px me-2"></i>
                  <span class="align-middle">My Profile</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="pages-account-settings-account.html">
                  <i class="ri-settings-4-line ri-22px me-2"></i>
                  <span class="align-middle">Settings</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="pages-account-settings-billing.html">
                  <span class="d-flex align-items-center align-middle">
                    <i class="flex-shrink-0 ri-file-text-line ri-22px me-2"></i>
                    <span class="flex-grow-1 align-middle">Billing</span>
                    <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger h-px-20 d-flex align-items-center justify-content-center">4</span>
                  </span>
                </a>
              </li>
              <li>
                <div class="dropdown-divider"></div>
              </li>
              <li>
                <a class="dropdown-item" href="pages-pricing.html">
                  <i class="ri-money-dollar-circle-line ri-22px me-2"></i>
                  <span class="align-middle">Pricing</span>
                </a>
              </li>
              <li>
                <a class="dropdown-item" href="pages-faq.html">
                  <i class="ri-question-line ri-22px me-2"></i>
                  <span class="align-middle">FAQ</span>
                </a>
              </li>
              <li>
                <div class="d-grid px-4 pt-2 pb-1">
                  <a class="btn btn-danger d-flex" href="auth-login-cover.html" target="_blank">
                    <small class="align-middle">Logout</small>
                    <i class="ri-logout-box-r-line ms-2 ri-16px"></i>
                  </a>
                </div>
              </li>
            </ul>
          </li>
          <!--/ User -->



        </ul>
      </div>


      <!-- Search Small Screens -->
      <div class="navbar-search-wrapper search-input-wrapper  d-none">
        <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..." aria-label="Search...">
        <i class="ri-close-fill search-toggler cursor-pointer"></i>
      </div>



</nav>

<!-- / Navbar -->



      <!-- Content wrapper -->
      <div class="content-wrapper">

        @inertia



<!-- Footer -->
<footer class="content-footer footer bg-footer-theme">
  <div class="container-xxl">
    <div class="footer-container d-flex align-items-center justify-content-between py-4 flex-md-row flex-column">
      <div class="text-body mb-2 mb-md-0">
        © <script>
        document.write(new Date().getFullYear())

        </script>, made with <span class="text-danger"><i class="tf-icons ri-heart-fill"></i></span> by <a href="https://themeselection.com/" target="_blank" class="footer-link">ThemeSelection</a>
      </div>
      <div class="d-none d-lg-inline-block">

        <a href="https://themeselection.com/license/" class="footer-link me-3" target="_blank">License</a>
        <a href="https://themeselection.com/" target="_blank" class="footer-link me-3">More Themes</a>

        <a href="https://demos.themeselection.com/materio-bootstrap-html-admin-template/documentation/" target="_blank" class="footer-link me-3">Documentation</a>


        <a href="https://themeselection.com/support/" target="_blank" class="footer-link d-none d-sm-inline-block">Support</a>

      </div>
    </div>
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


    <!-- Drag Target Area To SlideIn Menu On Small Screens -->
    <div class="drag-target"></div>

  </div>
  <!-- / Layout wrapper -->


  <!-- <div class="buy-now">
    <a href="https://themeselection.com/item/materio-bootstrap-html-admin-template/" target="_blank" class="btn btn-danger btn-buy-now">Buy Now</a>
  </div>
   -->

   <script>
function loadPage(pageUrl) {
  $.ajax({
    url: pageUrl,
    type: 'GET',
    success: function(data) {
      $('#content').html(data);
    },
    error: function(xhr) {
      $('#content').html('<p style="color:red;">Error loading page.</p>');
    }
  });
}
</script>

<!--/ Scrollable -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- Core JS -->
  <!-- build:js assets/vendor/js/core.js -->
  <!-- <script src="/Leopard_courier/assets/vendor/libs/jquery/jquery.js"></script> -->
 <!-- Core JS -->
<script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
<script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
<script src="{{ asset('assets/vendor/js/menu.js') }}"></script>

<!-- endbuild -->

<!-- Vendors JS -->
<script src="{{ asset('assets/vendor/libs/cleavejs/cleave.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/cleavejs/cleave-phone.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/moment/moment.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/flatpickr/flatpickr.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/select2/select2.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/bootstrap-datepicker/bootstrap-datepicker.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/bootstrap-daterangepicker/bootstrap-daterangepicker.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/jquery-timepicker/jquery-timepicker.js') }}"></script>
<script src="{{ asset('assets/vendor/libs/pickr/pickr.js') }}"></script>

<!-- Main JS -->
<script src="{{ asset('assets/js/main.js') }}"></script>

<!-- Page JS -->
<script src="{{ asset('assets/js/form-layouts.js') }}"></script>
<script src="{{ asset('assets/js/tables-datatables-basic.js') }}"></script>
<script src="{{ asset('assets/js/forms-pickers.js') }}"></script>


</body>
<script>
 $(document).ready(function() {
 $('#myTable').DataTable({
  "pageLength": 10,
  "lengthMenu": [ [10, 25, 50, -1], [10, 25, 50, "All"] ]
});

});

</script>

<!-- Mirrored from demos.themeselection.com/materio-bootstrap-html-admin-template/html/vertical-menu-template-bordered/form-layouts-vertical.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 01 May 2024 13:20:12 GMT -->
</html>

<!-- beautify ignore:end -->


