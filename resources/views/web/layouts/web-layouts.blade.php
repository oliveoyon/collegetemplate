<!-- href="{{ asset('web/css/custom.css') }}" -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Flattern Bootstrap Template - Index</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="{{ asset('web/assets/img/favicon.png') }}" rel="icon"> 
    <link href="{{ asset('web/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon"> 

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Muli:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ asset('web/assets/vendor/animate.css/animate.min.css') }}" rel="stylesheet"> 
    <link href="{{ asset('web/assets/vendor/aos/aos.css') }}" rel="stylesheet">  
    <link href="{{ asset('web/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet"> 
    <link href="{{ asset('web/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet"> 
    <link href="{{ asset('web/assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet"> 
    <link href="{{ asset('web/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet"> 
    <link href="{{ asset('web/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet"> 

    <!-- Template Main CSS File -->
    <link href="{{ asset('web/assets/css/style.css') }}" rel="stylesheet"> 

</head>

<body>

    <!-- ======= Top Bar ======= -->
    <section id="topbar" class="d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-md-between">
            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-envelope d-flex align-items-center"><a href="mailto:contact@example.com">contact@example.com</a></i>
                <div class="notice-lists">


                    <div class="marquee-container">
                        <div class="marquee-content">
                            <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
                                <a href="https://example.com/notice/1" class="notice-items">Important Announcement for Class 6-10</a>
                                <a href="https://example.com/notice/2" class="notice-items">Meet the New School Principal - John Doe</a>
                                <a href="https://example.com/notice/3" class="notice-items">Upcoming Events and Activities</a>
                                <a href="https://example.com/notice/4" class="notice-items">Reminder: Parent-Teacher Meeting on February
                                    15</a>
                                <a href="https://example.com/notice/5" class="notice-items">School Holiday Schedule for the Month</a>
                            </marquee>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section>
    <section style="padding: 30px 0;">
        <div class="container" style="text-align: center; ">
            <img src="{{ asset('web/assets/img/test1.png') }}" alt=""> 
        </div>
    </section>

    <!-- ======= Header ======= -->
    <header id="header" class="d-flex align-items-center">
        <div class="container d-flex justify-content-between">

            <div class="logo">
                <h1 class="text-light"><a href="index.html">Flattern</a></h1>
                <!-- Uncomment below if you prefer to use an image logo -->
                <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
            </div>

            <nav id="navbar" class="navbar">
                <ul>
                    <li><a class="active" href="index.html">হোম</a></li>
                    <li><a href="about.html">সম্পর্কে</a></li>
                    <li><a href="services.html">সেবাসমূহ</a></li>
                    <li><a href="testimonials.html">প্রশংসাপত্র</a></li>
                    <li><a href="pricing.html">মূল্যনির্ধারণ</a></li>
                    <li><a href="portfolio.html">পোর্টফোলিও</a></li>
                    <li><a href="blog.html">ব্লগ</a></li>

                    <li class="dropdown"><a href="#"><span>Drop Down</span> <i class="bi bi-chevron-down"></i></a>
                        <ul>
                            <li><a href="#">Drop Down 1</a></li>
                            <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                                <ul>
                                    <li><a href="#">Deep Drop Down 1</a></li>
                                    <li><a href="#">Deep Drop Down 2</a></li>
                                    <li><a href="#">Deep Drop Down 3</a></li>
                                    <li><a href="#">Deep Drop Down 4</a></li>
                                    <li><a href="#">Deep Drop Down 5</a></li>
                                </ul>
                            </li>
                            <li><a href="#">Drop Down 2</a></li>
                            <li><a href="#">Drop Down 3</a></li>
                            <li><a href="#">Drop Down 4</a></li>
                        </ul>
                    </li>
                    <li><a href="contact.html">Contact</a></li>
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav><!-- .navbar -->

        </div>
    </header><!-- End Header -->

    @yield('webcontent')

    <!-- ======= Footer ======= -->
    <footer id="footer">

        <div class="footer-top">
            <div class="container">
                <div class="row">

                    <div class="col-lg-3 col-md-6 footer-contact">
                        <h3>Flattern</h3>
                        <p>
                            A108 Adam Street <br>
                            New York, NY 535022<br>
                            United States <br><br>
                            <strong>Phone:</strong> +1 5589 55488 55<br>
                            <strong>Email:</strong> info@example.com<br>
                        </p>
                    </div>

                    <div class="col-lg-2 col-md-6 footer-links">
                        <h4>Useful Links</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Home</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">About us</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Services</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Terms of service</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Privacy policy</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-3 col-md-6 footer-links">
                        <h4>Our Services</h4>
                        <ul>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Design</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Web Development</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Product Management</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Marketing</a></li>
                            <li><i class="bx bx-chevron-right"></i> <a href="#">Graphic Design</a></li>
                        </ul>
                    </div>

                    <div class="col-lg-4 col-md-6 footer-newsletter">
                        <h4>Join Our Newsletter</h4>
                        <p>Tamen quem nulla quae legam multos aute sint culpa legam noster magna</p>
                        <form action="" method="post">
                            <input type="email" name="email"><input type="submit" value="Subscribe">
                        </form>
                    </div>

                </div>
            </div>
        </div>

        <div class="container d-md-flex py-4">

            <div class="me-md-auto text-center text-md-start">
                <div class="copyright">
                    &copy; Copyright <strong><span>Flattern</span></strong>. All Rights Reserved
                </div>
                <div class="credits">
                    <!-- All the links in the footer should remain intact. -->
                    <!-- You can delete the links only if you purchased the pro version. -->
                    <!-- Licensing information: https://bootstrapmade.com/license/ -->
                    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/flattern-multipurpose-bootstrap-template/ -->
                    Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
                </div>
            </div>
            <div class="social-links text-center text-md-right pt-3 pt-md-0">
                <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a>
                <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
                <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
                <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
                <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
            </div>
        </div>
    </footer><!-- End Footer -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="{{ asset('web/assets/vendor/aos/aos.js') }}"></script>
    <script src="{{ asset('web/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('web/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
    <script src="{{ asset('web/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('web/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('web/assets/vendor/waypoints/noframework.waypoints.js') }}"></script>

    <!-- Template Main JS File -->
    <script src="{{ asset('web/assets/js/main.js') }}"></script>   

</body>

</html>