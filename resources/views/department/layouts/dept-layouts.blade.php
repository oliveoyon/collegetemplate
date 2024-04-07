@php
    $segments = Request::segments();
    $currentFaculty = isset($segments[1]) ? $segments[1] : '';
    $currentDept = isset($segments[2]) ? $segments[2] : '';
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>{{$deptName}}</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('dept/assets/') }}/img/favicon.png" rel="icon">
    <link href="{{ asset('dept/assets/') }}/img/apple-touch-icon.png" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Roboto:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">
    <link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet">
    <!-- Vendor CSS Files -->
    <link href="{{ asset('dept/assets/') }}/vendor/animate.css/animate.min.css" rel="stylesheet">
    <link href="{{ asset('dept/assets/') }}/vendor/aos/aos.css" rel="stylesheet">
    <link href="{{ asset('dept/assets/') }}/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('dept/assets/') }}/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="{{ asset('dept/assets/') }}/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="{{ asset('dept/assets/') }}/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
    <link href="{{ asset('dept/assets/') }}/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="{{ asset('dept/assets/') }}/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">
    @stack('admincss')
    <!-- Template Main CSS File -->
    <link href="{{ asset('dept/assets/') }}/css/style.css" rel="stylesheet">



</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top">
        <div class="container d-flex align-items-center">



            <h1 class="logo me-auto"><a
                    href="{{ route('department', ['faculty' => $currentFaculty, 'dept' => $currentDept]) }}"><span>{{$deptName}}</span></a>
            </h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="{{ asset('dept/assets/') }}/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    <li><a
                            href="{{ route('department', ['faculty' => $currentFaculty, 'dept' => $currentDept]) }}">Home</a>
                    </li>
                    @foreach ($menus as $menu)
                        @if ($menu->is_home == 0)
                            @if ($menu->subMenus->isEmpty())
                                <li><a
                                        href="{{ route('deptmenudesc', ['faculty' => request()->segment(2), 'dept' => request()->segment(3), 'slug' => $menu->menu_slug]) }}">{{ $menu->menu_name }}</a>
                                </li>
                            @else
                                <li class="dropdown"><a href="#"><span>{{ $menu->menu_name }}</span> <i
                                            class="bi bi-chevron-down"></i></a>
                                    <ul>
                                        @foreach ($menu->subMenus as $submenu)
                                            @if (!$submenu->childMenus->isEmpty())
                                                <li class="dropdown"><a
                                                        href="#"><span>{{ $submenu->submenu_name }}</span> <i
                                                            class="bi bi-chevron-right"></i></a>
                                                    <ul>
                                                        @foreach ($submenu->childMenus as $childMenu)
                                                            <li><a
                                                                    href="{{ route('deptmenudesc', ['faculty' => request()->segment(2), 'dept' => request()->segment(3), 'slug' => $menu->menu_slug, 'submenu' => $submenu->submenu_slug, 'childmenu' => $childMenu->child_menu_slug]) }}">{{ $childMenu->childmenu_name }}</a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                </li>
                                            @else
                                                <li><a
                                                        href="{{ route('deptmenudesc', ['faculty' => request()->segment(2), 'dept' => request()->segment(3), 'slug' => $menu->menu_slug, 'submenu' => $submenu->submenu_slug]) }}">{{ $submenu->submenu_name }}</a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </li>
                            @endif
                        @endif
                    @endforeach
                    <li><a href="{{ route('deptcontact', ['faculty' => $currentFaculty, 'dept' => $currentDept]) }}">Contact</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

            <div class="header-social-links d-flex">
                <a href="#" class="twitter"><i class="bu bi-twitter"></i></a>
                <a href="#" class="facebook"><i class="bu bi-facebook"></i></a>
                <a href="#" class="instagram"><i class="bu bi-instagram"></i></a>
                <a href="#" class="linkedin"><i class="bu bi-linkedin"></i></i></a>
            </div>

        </div>
    </header><!-- End Header -->

    @yield('deptcontent')

    <!-- ======= Footer ======= -->
    <footer id="footer">

        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-4 col-md-6 footer-contact">
                        <h3>{{ $webs->school_title }}</h3>
                        {{-- <img width="50" height="50" src="{{ asset('web/assets/img/fcc.png') }}" alt="" class="img-fluid"> --}}
                        <p style="font-family: solaimanlipi">
                            {{ $webs->address_one }} <br>
                            {{ $webs->address_two }} <br><br>
                            <strong>ফোন:</strong> {{ $webs->phone1 }}<br>
                            <strong>ফোন:</strong> {{ $webs->phone2 }}<br>
                            <strong>ইমেইল:</strong> {{ $webs->email }}<br>
                        </p>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-links">
                        <h4>প্রয়োজনীয় লিঙ্ক</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="{{ route('index') }}">হোম</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a
                                    href="{{ route('allnotice', ['cat' => 'all-notice']) }}">একাডেমিক নোটিশ</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a
                                    href="{{ route('allnotice', ['cat' => 'all-event']) }}">ইভেন্ট
                                    সমুহ</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">যোগাযোগ</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-links">
                        <h4>সুযোগ-সুবিধা</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">অত্যাধুনিক ল্যাব</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">সুবিশাল অডিটোরিয়াম</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">সমৃদ্ধ লাইব্রেরী</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">ক্লাব</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">খেলার মাঠ</a></li>
                        </ul>
                    </div>

                    {{-- <div class="col-lg-4 col-md-6 footer-newsletter">
                        <h4>Join Our Newsletter</h4>
                        <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                        <form action="" method="post">
                            <input type="email" name="email"><input type="submit" value="Subscribe">
                        </form>
                    </div> --}}

                </div>
            </div>
        </div>

        <div class="container d-md-flex py-4">

            <div class="me-md-auto text-center text-md-start">
                <div class="copyright">
                    &copy; কপিরাইট <strong><span>{{ $webs->school_title }}</span></strong>. সর্বস্বত্ব
                    সংরক্ষিত
                </div>
                <div class="credits">
                    Developed By <a href="https://iconbangla.net/">IconBangla</a>
                </div>
            </div>
            <div class="social-links text-center text-md-right pt-3 pt-md-0">
                <a href="{{ $webs->facebook }}" target="_blank" class="facebook"><i
                        class="bx bxl-facebook"></i></a>
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('dept/assets/') }}/vendor/aos/aos.js"></script>
    <script src="{{ asset('dept/assets/') }}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('dept/assets/') }}/vendor/glightbox/js/glightbox.min.js"></script>
    <script src="{{ asset('dept/assets/') }}/vendor/isotope-layout/isotope.pkgd.min.js"></script>
    <script src="{{ asset('dept/assets/') }}/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="{{ asset('dept/assets/') }}/vendor/waypoints/noframework.waypoints.js"></script>
    <script src="{{ asset('dept/assets/') }}/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('dept/assets/') }}/js/main.js"></script>

    <?php
    if (isset($eventsJson)) {
    } else {
        $eventsJson = '';
    }
    ?>
    <script>
        $(document).ready(function() {
            // Use PHP to echo the dynamic data from the controller
            var noticedata = <?php echo $eventsJson; ?>;

            // Initialize FullCalendar
            $('#fullCalendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay',
                },
                events: noticedata,
                eventRender: function(event, element) {
                    // Check if the event has a URL
                    if (event.url) {
                        // Make the event a clickable link
                        element.css('cursor', 'pointer');
                        element.attr('onclick', "window.location='" + event.url + "'");
                    }

                    // Set the title attribute for additional information
                    element.attr('title', event.title);
                    element.css('background-color', event.color);
                },
            });
        });
    </script>

<script type="text/javascript">
    // Get the current URL path
    var url = window.location.pathname;

    // Find and add the 'active' class to the appropriate navigation item
    $('#navbar ul li a').each(function() {
        // Check if the URL matches the href attribute of the link
        if ($(this).attr('href') === url) {
            $(this).addClass('active');

            // If the link is in a dropdown menu, also add the 'active' class to its parent
            $(this).closest('.dropdown').addClass('active');
        }
    });
</script>



</body>

</html>
