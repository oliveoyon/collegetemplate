<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $webs->school_title }}</title>
    <meta name="author" content="IconBangla <contact@iconbangla.net>">
    <meta name="description" content="{{ $webs->school_title }}">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ route('index') }}">
    <meta property="og:title" content="{{ $webs->school_title }}">
    <meta property="og:description" content="{{ $webs->school_title }}">
    <meta property="og:image" content="{{ asset('web/img/mujib-corner.jpg') }}">
    <meta property="og:url" content="{{ route('index') }}">
    <meta property="og:type" content="website">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $webs->school_title }}">
    <meta name="twitter:description" content="{{ $webs->school_title }}">
    <meta property="og:image" content="{{ asset('web/img/mujib-corner.jpg') }}">

    <!-- Favicons -->
    <link href="{{ asset('web/img/favicon.png') }}" rel="icon">

    <!-- Add Bootstrap 4 CSS link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    
    <!-- Add Font Awesome CSS link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://fonts.maateen.me/solaiman-lipi/font.css" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('web/css/custom.css') }}"> 
    <!-- Custom CSS for styling -->
    
</head>
<body>
    <!-- Boxed Layout Container -->
    <div class="boxed-layout">
        <!-- Top Bar -->
        <div class="top-bar">
            <div class="container">
                <div class="left-content"> 
                    <a href="{{ route('index') }}">
                        @if ($webs->logo)
                        <img class="logo_img img-responsive" src="{{ asset('storage/img/logo/'.$webs->logo) }}" alt="{{ $webs->school_title }}" >
                        @else
                        <span class="school-name">{{ $webs->school_title }}</span>
                        @endif
                    </a>
                </div>
                <div class="right-content text-right">
                    <a target="_blank" href="#">EIIN: {{ $webs->eiin }}</a>
                    {{-- <a target="_blank" href="{{ $webs->facebook }}"><i class="fab fa-facebook"></i></a>
                    <a target="_blank" href="{{ $webs->twitter }}"><i class="fab fa-twitter"></i></a>
                    <a target="_blank" href="{{ $webs->instagram }}"><i class="fab fa-instagram"></i></a> --}}
                    <br>
                    <span class="top-phone">
                        ফোন: {{ $webs->phone1 }}{{ $webs->phone2 ? ', '.$webs->phone2 : '' }}
                        {!! $webs->email ? '<br>'.$webs->email : ''!!}
                    </span>
                </div>
            </div>
        </div>
        

        <!-- <div class="jumbotron">
            <div class="container">
                <div class="school-icon">
                    <img src="your-school-icon.jpg" alt="School Icon">
                </div>
                <h1>School Name</h1>
                <p>Your tagline or description goes here.</p>
            </div>
        </div> -->

        <!-- Carousel (Slider) -->
        @if (count($ntcs)>0)
            <div class="notice-lists">
                <marquee behavior="scroll" direction="left" onmouseover="this.stop();" onmouseout="this.start();">
                    @foreach($ntcs as $ntc)
                    <a href="{{ url('notice/'.$ntc->url) }}" class="notice-items">{{ $ntc->event_title }}</a> {{ $loop->last ? '' : '|' }}
                    @endforeach
                </marquee>
            </div>
        @endif
        
        
        
       

        <div id="slider" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                

                @foreach($sliders as $slider)
                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                    <a href="#"> 
                        <img src="{{ asset('storage/img/slider/'.$slider->upload) }}" alt="{{ $slider->upload }}" class="d-block w-100">
                    </a>
                    <div class="carousel-caption">
                        <!-- <h3>Welcome to School Name</h3> -->
                    </div>
                </div>
                @endforeach
                
                
            </div>

            <!-- Controls (Optional) -->
            <!-- <a class="carousel-control-prev" href="#slider" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#slider" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a> -->

        </div> 



        <nav class="navbar navbar-expand-xl border">
            <div class="classic">
                <!-- Navbar Toggler Button (Hamburger Icon) -->
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Collapsible Navbar Content -->
                <div class="collapse navbar-collapse" id="navbarNav">
                    <!-- Nav Links --> 
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="{{ route('index') }}"><i class="fas fa-home"></i></a>
                        </li>
                        @foreach($menusWithSubMenus as $menu)
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="{{ $menu->menu_name }}Dropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                {{ $menu->menu_name }}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="{{ $menu->menu_name }}Dropdown">
                                @foreach($menu->subMenus as $subMenu)
                                <a class="dropdown-item" href="{{ route('menudesc', ['slug' => $subMenu->submenu_slug]) }}">
                                    {{ $subMenu->submenu_name }}
                                </a>
                                
                                @endforeach
                            </div>
                        </li>
                            
                        @endforeach
                        
                    </ul>
                </div>
            </div>
        </nav>


        


        @yield('webcontent')

        <div class="col-sm-12 col-12 bg-white p-0 pt-5"> 
            <img src="{{ asset('web/img/footerbg.png') }}" class="img-fluid w-100">
        </div>
        <footer class="footer">
            <div class="container">
                
                <div class="row">
                    <div class="col-md-4">
                        <h5>{{ $webs->school_title }}</h5>
                        <p style="font-size: 16px">وَقُل رَّبِّ زِدۡنِي عِلۡمٗا <br> <small style="color:orange">- طه: ١١٤</small></p>
                        <p style="font-size: 16px">আর আপনি বলুন, ‘হে প্রভু! আপনি আমার জ্ঞান বৃদ্ধি করে দিন। <br> <small style="color:orange">- সূরা ত্বা হা : ১১৪।</small></p>
                        
                    </div>
                    <div class="col-md-3">
                        <h5>যোগাযোগ</h5>
                        <address>
                            <p style="font-size: 14px">{{ $webs->address_one }}</p>
                            <p style="font-size: 14px">{{ $webs->address_two }}</p>
                            <p>Email: {{ $webs->email }} <br>Phone: {{ $webs->phone1 }}</p>
                        </address>
                    </div>
                    <div class="col-md-3">
                        <h5>গুরুত্বপূর্ণ লিঙ্ক</h5>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('index') }}">হোম</a></li>
                            <li><a href="{{ route('alldownload') }}">সকল ডাউনলোড</a></li>
                            <li><a href="{{ route('allnotice') }}">সকল নোটিশ</a></li>
                            <li><a href="{{ route('mujib-corner') }}">মুজিব কর্ণার</a></li>
                            <li><a target="_blank" href="{{ route('admin.login') }}">লগইন</a></li>
                        </ul>
                    </div>
                    <div class="col-md-2">
                        <h5>সোস্যাল সাইট</h5>
                        <ul class="list-unstyled">
                            <li><a target="_blank" href="{{ $webs->facebook }}"><i class="fab fa-facebook"></i> Facebook</a></li>
                            <li><a target="_blank" href="{{ $webs->twitter }}"><i class="fab fa-twitter"></i> Twitter</a></li>
                            <li><a target="_blank" href="{{ $webs->instagram }}"><i class="fab fa-instagram"></i> Instagram</a></li>
                        </ul>
                    </div>
                </div>
            </div>
           
          </footer>
    
        <div class="credit-bar">
            <div class="container">
                <p>&copy; ২০২৩ {{ $webs->school_title }}। সর্বসত্ব সংরক্ষিত | Developed by <a target="_blank" href="https://iconbangla.net">IconBangla</a></p>
            </div>
        </div>
        
        
        
    </div>

    <!-- Bootstrap 4 JavaScript and jQuery (if needed) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- JavaScript -->
<script>
    // Enable hover-triggered dropdowns for elements with the "nav-item dropdown" class
    $('.nav-item.dropdown:not(.mega-menu)').hover(function() {
        var $this = $(this);
        $this.addClass('show');
        $this.find('.dropdown-menu').addClass('show');
    }, function() {
        var $this = $(this);
        setTimeout(function() {
            $this.removeClass('show');
            $this.find('.dropdown-menu').removeClass('show');
        }, 100); // Adjust the delay time (in milliseconds) as needed
    });
</script>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const menuDropdown = document.querySelector("#menuDropdown");
        const megaMenu = document.querySelector(".dropdown-menu");
    
        menuDropdown.addEventListener("mouseenter", function () {
            const menuItems = megaMenu.querySelectorAll(".dropdown-item");
            let maxWidth = 0;
    
            menuItems.forEach((item) => {
                const itemWidth = item.getBoundingClientRect().width;
                if (itemWidth > maxWidth) {
                    maxWidth = itemWidth;
                }
            });
    
            megaMenu.style.minWidth = maxWidth + "px";
        });
    });
    </script>

</body>
</html>
