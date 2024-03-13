
<!DOCTYPE html>

<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title')</title>
  <base href="{{ \URL::to('/') }}">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

<!-- Font Awesome Icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<!-- Bootstrap 4 -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
<link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet">

<!-- Custom styles for AdminLTE -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/css/adminlte.min.css">


  @stack('admincss')



  <link rel="stylesheet" href="dist/css/custom.css">

  <style>
    [class*="sidebar-light-"] .nav-sidebar > .nav-item > .nav-treeview {
    background-color: rgb(6 59 229 / 5%);
    @import url('https://fonts.maateen.me/solaiman-lipi/font.css');
    }
  </style>

</head>
{{-- <body class="hold-transition sidebar-mini"> --}}
  {{-- <body class="sidebar-mini skin-green-light" data-gr-c-s-loaded="true" style="height: auto; min-height: 100%;"> --}}
<body class="sidebar-mini skin-blue-light text-sm" data-gr-c-s-loaded="true" style="height: auto; min-height: 100%; font-family: 'SolaimanLipi', sans-serif;">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('admin.home') }}" class="nav-link">হোম</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="https://iconbangla.net" target="_blank" class="nav-link">যোগাযোগ</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a target="_blank" href="https://drive.google.com/file/d/1KglRYIPzHDPzEW_ZxnDTfkyVgHzpeelC/view" target="_blank" class="nav-link">ভিডিও টিউটোরিয়াল</a>
      </li>
    </ul>


  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  {{-- <aside class="main-sidebar sidebar-dark-success elevation-4"> --}}
    <aside class="main-sidebar sidebar-light-info elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('admin.home') }}" class="brand-link bg-success">
      <span class="brand-text font-weight-bold">{{ $webs->school_title }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- SidebarSearch Form -->
      {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="অনুসন্ধান করুন" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar text-sm flex-column" data-widget="treeview" role="menu" data-accordion="false">

          {{-- <li class="nav-item">
            <a href="{{ route('admin.home') }}" class="nav-link">
              <i class="fas fa-tachometer-alt nav-icon"></i>
              <p>ড্যাশবোর্ড</p>
            </a>
          </li>
           --}}

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                ওয়েব ম্যানেজমেন্ট
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('admin.home') }}" class="nav-link">
                  <i class="fas fa-tachometer-alt nav-icon"></i>
                  <p>ড্যাশবোর্ড</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.menu-list') }}" class="nav-link">
                  <i class="fas fa-bars nav-icon"></i>
                  <p>মেনু ম্যানেজমেন্ট</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.submenu-list') }}" class="nav-link">
                  <i class="fas fa-list-alt nav-icon"></i>
                  <p>সাবমেনু ম্যানেজমেন্ট</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.childmenu-list') }}" class="nav-link">
                  <i class="fas fa-bars nav-icon"></i>
                  <p>চাইল্ড মেনু ম্যানেজমেন্ট</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.notice-list') }}" class="nav-link">
                  <i class="far fa-bell nav-icon"></i>
                  <p>নোটিশ ম্যানেজমেন্ট</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.history') }}" class="nav-link">
                  <i class="fas fa-history nav-icon"></i>
                  <p>প্রতিষ্ঠানের ইতিহাস</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.link-list') }}" class="nav-link">
                  <i class="fas fa-link nav-icon"></i>
                  <p>গুরুত্বপূর্ণ লিঙ্ক</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.slider-list') }}" class="nav-link">
                  <i class="fas fa-images nav-icon"></i>
                  <p>স্লাইডার ম্যানেজমেন্ট</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.mujib-corner-list') }}" class="nav-link">
                  <i class="fas fa-images nav-icon"></i>
                  <p>মুজিব কর্ণার ম্যানেজমেন্ট</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.upload-list') }}" class="nav-link">
                  <i class="fas fa-upload nav-icon"></i>
                  <p>আপলোড ম্যানেজমেন্ট</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.message-list') }}" class="nav-link">
                  <i class="far fa-envelope nav-icon"></i>
                  <p>বাণী ম্যানেজমেন্ট</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.changepass') }}" class="nav-link">
                  <i class="fas fa-key nav-icon"></i>
                  <p>পাসওয়ার্ড পরিবর্তন করুন</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.web-settings') }}" class="nav-link">
                  <i class="fas fa-cogs nav-icon"></i>
                  <p>ওয়েব সেটিংস</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{ route('admin.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="nav-link">
                  <i class="fas fa-sign-out-alt nav-icon"></i>
                  <p>লগআউট</p>
                  <form action="{{ route('admin.logout') }}" id="logout-form" method="post">@csrf</form>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

 @yield('content')

  <!-- Main Footer -->
  <footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      ডেভেলপড বাই: <a href="https://iconbangla.net" target="_blank" rel="noopener noreferrer">আইকন বাংলা</a>
    </div>
    <!-- Default to the left -->
    <strong>কপিরাইট &copy; ২০২৩ <a href="">ডাইনামিক স্কুল ম্যানেজমেন্ট সিস্টেম</a></strong> সর্বস্বত্ব সংরক্ষিত
  </footer>
</div>
<!-- ./wrapper -->



<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Bootstrap 4 -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/js/bootstrap.bundle.min.js"></script>


<!-- AdminLTE App -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.1.0/js/adminlte.min.js"></script>





@stack('adminjs')

<script type="text/javascript">

// AdminLTe 3.0.x
/** add active class and stay opened when selected */
var url = window.location;

// for sidebar menu entirely but not cover treeview
  $('ul.nav-sidebar a').filter(function() {
    return this.href == url;
  }).addClass('active');

// for treeview
  $('ul.nav-treeview a').filter(function() {
    return this.href == url;
  }).parentsUntil(".nav-sidebar > .nav-treeview").addClass('menu-open').prev('a').addClass('active');

  $('.select2bs4').select2({
      theme: 'bootstrap4'
    });


</script>

<script>
  $('body').on('focus',".datepicker", function(){
      $(this).datepicker();
  });

  $('.datepicker').datepicker().on('changeDate', function(){
    $(this).datepicker('hide');
        });
</script>

<script>
  $(function () {
    // Summernote
    $('.summernote').summernote();
  })
</script>


</body>
</html>
