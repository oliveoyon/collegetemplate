@extends('web.layouts.web-layouts')

@section('webcontent')
    <!-- ======= Hero Section ======= -->
    <section id="hero">
        <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

            <div class="carousel-inner" role="listbox">

                @foreach ($sliders as $slider)
                    <div class="carousel-item active"
                        style="background-image: url({{ asset('storage/img/slider/' . $slider->upload) }});">
                        <div class="carousel-container">
                            <div class="carousel-content animate__animated animate__fadeInUp">
                                <h2>{{ $slider->title }}</h2>
                                <p>{{ $slider->desc }}</p>
                                <div class="text-center"><a href="" class="btn-get-started">Read More</a></div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>

            <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bx bx-left-arrow" aria-hidden="true"></span>
            </a>

            <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
                <span class="carousel-control-next-icon bx bx-right-arrow" aria-hidden="true"></span>
            </a>

            <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

        </div>
    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= Cta Section ======= -->
        <section id="cta" class="cta">
            <div class="container">

                <div class="row">
                    <div class="col-lg-12 text-center text-lg-left">
                        <h3 class="mb-4">ইডেন মহিলা কলেজে <span>স্বাগতম</span> আপনাকে</h3>
                        <p>{!! $histories->history !!}</p>

                        <a class="cta-btn align-middle mt-4" href="#">আরও পড়ুন</a>
                    </div>

                </div>

            </div>
        </section><!-- End Cta Section -->


        <section class="principal-message-section">
            <div class="container principal-container">
                <div class="row">
                    <div class="col-md-4 text-center mb-4 mb-md-0">
                        <div class="image-container" data-aos="fade-right">
                            <img src="{{ asset('storage/img/message_img/' . $messages->upload) }}" height="200"
                                class="principal-image float-left" alt="">
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="principal-message" data-aos="fade-left">
                            <h2>{{ $messages->message_type }}</h2>
                            <p>{!! $messages->message_desc !!}</p>
                            <!-- Add more content or styling as needed -->
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <section id="features" class="features mt-5">
            <div class="container">

                <div class="section-title" data-aos="fade-up">
                    <h2>কলেজ <strong>নোটিশ বোর্ড</strong> সকল তথ্য</h2>
                    <p>আপনি এখান থেকে সকল নোটিশ, ইভেন্ট, সেমিনার, ওয়ার্কশপ ও অন্যান্য তথ্য পাবেন</p>
                </div>

                <div class="row">
                    <div class="col-lg-4 mb-5 mb-lg-0" data-aos="fade-right">
                        <ul class="nav nav-tabs flex-column">
                            <li class="nav-item">
                                <a class="nav-link active show" data-bs-toggle="tab" href="#tab-1">
                                    <h4>একাডেমিক</h4>
                                    <p>সকল প্রকার একাডেমিক তথ্য</p>
                                </a>
                            </li>
                            <li class="nav-item mt-2">
                                <a class="nav-link" data-bs-toggle="tab" href="#tab-2">
                                    <h4>ইভেন্ট</h4>
                                    <p>সকল প্রকার ইভেন্টের তথ্য</p>
                                </a>
                            </li>
                            <li class="nav-item mt-2">
                                <a class="nav-link" data-bs-toggle="tab" href="#tab-3">
                                    <h4>বিজ্ঞপ্তি</h4>
                                    <p>সকল প্রকার বিজ্ঞপ্তি</p>
                                </a>
                            </li>
                            <li class="nav-item mt-2">
                                <a class="nav-link" data-bs-toggle="tab" href="#tab-4">
                                    <h4>এন ও সি</h4>
                                    <p>সকল প্রকার এন ও সি তথ্য</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-8 ml-auto" data-aos="fade-left" data-aos-delay="100">
                        <div class="tab-content">
                            <div class="tab-pane active show" id="tab-1">
                                <table class="table bottom-border-table">

                                    <tbody>
                                        @php $count = 0; @endphp
                                        @foreach ($provider_ntcs as $ntcs)
                                            @if ($ntcs->event_type == 1)
                                                @if ($count < 10)
                                                    <tr>
                                                        <td>{{ $ntcs->event_title }}</td>
                                                        <td><small>{{ \Carbon\Carbon::parse($ntcs->created_at)->format('d F, Y') }}</small>
                                                        </td>
                                                        <td>
                                                            <a href="{{ url('notice/'.$ntcs->url) }}"
                                                                class="btn btn-sm btn-info">View</a>
                                                        </td>
                                                    </tr>
                                                    @php $count++; @endphp
                                                @else
                                                @break
                                            @endif
                                        @endif
                                    @endforeach

                                    @if ($count > 5)
                                        <tr>
                                            <td colspan="3" class="text-center">
                                                <a href="{{ url('notice/'.$ntcs->url) }}" class="btn btn-info btn-block">View
                                                    All Notices</a>
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane" id="tab-2">
                            <table class="table bottom-border-table">

                                <tbody>
                                    @php $count = 0; @endphp
                                    @foreach ($provider_ntcs as $ntcs)
                                        @if ($ntcs->event_type == 2)
                                            @if ($count < 10)
                                                <tr>
                                                    <td>{{ $ntcs->event_title }}</td>
                                                    <td><small>{{ \Carbon\Carbon::parse($ntcs->created_at)->format('d F, Y') }}</small>
                                                    </td>
                                                    <td>
                                                        <a href="{{ url('notice/'.$ntcs->url) }}"
                                                            class="btn btn-sm btn-info">View</a>
                                                    </td>
                                                </tr>
                                                @php $count++; @endphp
                                            @else
                                            @break
                                        @endif
                                    @endif
                                @endforeach

                                @if ($count > 5)
                                    <tr>
                                        <td colspan="3" class="text-center">
                                            <a href="{{ url('notice/'.$ntcs->url) }}" class="btn btn-info btn-block">View
                                                All Notices</a>
                                        </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    <div class="tab-pane" id="tab-3">
                        <table class="table bottom-border-table">

                            <tbody>
                                @php $count = 0; @endphp
                                @foreach ($provider_ntcs as $ntcs)
                                    @if ($ntcs->event_type == 3)
                                        @if ($count < 10)
                                            <tr>
                                                <td>{{ $ntcs->event_title }}</td>
                                                <td><small>{{ \Carbon\Carbon::parse($ntcs->created_at)->format('d F, Y') }}</small>
                                                </td>
                                                <td>
                                                    <a href="{{ url('notice/'.$ntcs->url) }}"
                                                        class="btn btn-sm btn-info">View</a>
                                                </td>
                                            </tr>
                                            @php $count++; @endphp
                                        @else
                                        @break
                                    @endif
                                @endif
                            @endforeach
                            @if ($count > 5)
                                <tr>
                                    <td colspan="3" class="text-center">
                                        <a href="{{ route('allnotice') }}"
                                            class="btn btn-info btn-block">View All Notices</a>
                                    </td>
                                </tr>
                            @endif

                        </tbody>
                    </table>
                </div>
                <div class="tab-pane" id="tab-4">
                    <table class="table bottom-border-table">
                        <tbody>
                            @php $count = 0; @endphp
                            @foreach ($provider_ntcs as $ntcs)
                                @if ($ntcs->event_type == 4)
                                    @if ($count < 10)
                                        <tr>
                                            <td>{{ $ntcs->event_title }}</td>
                                            <td><small>{{ \Carbon\Carbon::parse($ntcs->created_at)->format('d F, Y') }}</small>
                                            </td>
                                            <td>
                                                <a href="{{ url('notice/'.$ntcs->url) }}"
                                                    class="btn btn-sm btn-info">View</a>
                                            </td>
                                        </tr>
                                        @php $count++; @endphp
                                    @else
                                    @break
                                @endif
                            @endif
                        @endforeach

                        @if ($count > 5)
                            <tr>
                                <td colspan="3" class="text-center">
                                    <a href="{{ route('allnotice') }}"
                                        class="btn btn-info btn-block">View All Notices</a>
                                </td>
                            </tr>
                        @endif



                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

</div>
</section><!-- End Features Section -->


<section class="menu-section">
<div class="container">
<div class="row">
    @foreach ($provider_menusWithSubMenus as $menu)
        @if ($menu->is_home == 1)
            <div class="col-sm-4 col-12 mb-4">
                <div class="menu-box d-flex flex-column h-100">
                    <div class="col-sm-12 col-12 pt-3 pb-2" id="cart" data-aos="fade-in"
                        data-aos-duration="1000">
                        <p class="session" style="font-weight: bold">&nbsp;&nbsp;{{ $menu->menu_name }}
                        </p>
                        <div class="row">
                            <div class="col-sm-3 col-3">
                                <img width="200"
                                    src="{{ asset('storage/img/menu_img/' . $menu->upload) }}"
                                    class="img-fluid">
                            </div>
                            <div class="col-sm-9 col-9 p-0">
                                <ul class="menus">

                                    @foreach ($menu->subMenus as $subMenu)
                                        <li><i class="fa fa-caret-right"></i><a
                                                href="{{ $subMenu->submenu_slug }}">{{ $subMenu->submenu_name }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    @endforeach


</div>


</div>
</section>

<!-- ======= Services Section ======= -->
<section id="services" class="services" style="background-color: antiquewhite;">
<div class="container">

<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="icon-box" data-aos="fade-up">
            <div class="icon"><i class="bi bi-briefcase"></i></div>
            <h4 class="title" style="text-align: left;"><a href="">Lorem Ipsum</a></h4>
            <p class="description">Voluptatum deleniti atque corrupti quos dolores et quas molestias
                excepturi sint
                occaecati cupiditate non provident</p>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="icon-box" data-aos="fade-up" data-aos-delay="100">
            <div class="icon"><i class="bi bi-card-checklist"></i></div>
            <h4 class="title"><a href="">Dolor Sitema</a></h4>
            <p class="description">Minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea
                commodo consequat tarad limino ata</p>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
            <div class="icon"><i class="bi bi-bar-chart"></i></div>
            <h4 class="title"><a href="">Sed ut perspiciatis</a></h4>
            <p class="description">Duis aute irure dolor in reprehenderit in voluptate velit esse cillum
                dolore eu
                fugiat nulla pariatur</p>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="icon-box" data-aos="fade-up" data-aos-delay="200">
            <div class="icon"><i class="bi bi-binoculars"></i></div>
            <h4 class="title"><a href="">Magni Dolores</a></h4>
            <p class="description">Excepteur sint occaecat cupidatat non proident, sunt in culpa qui
                officia deserunt
                mollit anim id est laborum</p>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="icon-box" data-aos="fade-up" data-aos-delay="300">
            <div class="icon"><i class="bi bi-brightness-high"></i></div>
            <h4 class="title"><a href="">Nemo Enim</a></h4>
            <p class="description">At vero eos et accusamus et iusto odio dignissimos ducimus qui
                blanditiis
                praesentium voluptatum deleniti atque</p>
        </div>
    </div>
    <div class="col-lg-4 col-md-6">
        <div class="icon-box" data-aos="fade-up" data-aos-delay="400">
            <div class="icon"><i class="bi bi-calendar4-week"></i></div>
            <h4 class="title"><a href="">Eiusmod Tempor</a></h4>
            <p class="description">Et harum quidem rerum facilis est et expedita distinctio. Nam libero
                tempore, cum
                soluta nobis est eligendi</p>
        </div>
    </div>
</div>

</div>
</section><!-- End Services Section -->

<!-- ======= Portfolio Section ======= -->
<section id="portfolio" class="portfolio" style="background-color: #f3f1f0;">
<div class="container">

<div class="row" data-aos="fade-up">
    <div class="col-lg-12 d-flex justify-content-center">
        <ul id="portfolio-flters">
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".filter-app">App</li>
            <li data-filter=".filter-card">Card</li>
            <li data-filter=".filter-web">Web</li>
        </ul>
    </div>
</div>

<div class="row portfolio-container" data-aos="fade-up">

    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
        <img src="assets/img/portfolio/portfolio-1.jpg" class="img-fluid" alt="">
        <div class="portfolio-info">
            <h4>App 1</h4>
            <p>App</p>
            <a href="assets/img/portfolio/portfolio-1.jpg" data-gallery="portfolioGallery"
                class="portfolio-lightbox preview-link" title="App 1"><i class="bx bx-plus"></i></a>
            <a href="portfolio-details.html" class="details-link" title="More Details"><i
                    class="bx bx-link"></i></a>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 portfolio-item filter-web">
        <img src="assets/img/portfolio/portfolio-2.jpg" class="img-fluid" alt="">
        <div class="portfolio-info">
            <h4>Web 3</h4>
            <p>Web</p>
            <a href="assets/img/portfolio/portfolio-2.jpg" data-gallery="portfolioGallery"
                class="portfolio-lightbox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
            <a href="portfolio-details.html" class="details-link" title="More Details"><i
                    class="bx bx-link"></i></a>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
        <img src="assets/img/portfolio/portfolio-3.jpg" class="img-fluid" alt="">
        <div class="portfolio-info">
            <h4>App 2</h4>
            <p>App</p>
            <a href="assets/img/portfolio/portfolio-3.jpg" data-gallery="portfolioGallery"
                class="portfolio-lightbox preview-link" title="App 2"><i class="bx bx-plus"></i></a>
            <a href="portfolio-details.html" class="details-link" title="More Details"><i
                    class="bx bx-link"></i></a>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
        <img src="assets/img/portfolio/portfolio-4.jpg" class="img-fluid" alt="">
        <div class="portfolio-info">
            <h4>Card 2</h4>
            <p>Card</p>
            <a href="assets/img/portfolio/portfolio-4.jpg" data-gallery="portfolioGallery"
                class="portfolio-lightbox preview-link" title="Card 2"><i class="bx bx-plus"></i></a>
            <a href="portfolio-details.html" class="details-link" title="More Details"><i
                    class="bx bx-link"></i></a>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 portfolio-item filter-web">
        <img src="assets/img/portfolio/portfolio-5.jpg" class="img-fluid" alt="">
        <div class="portfolio-info">
            <h4>Web 2</h4>
            <p>Web</p>
            <a href="assets/img/portfolio/portfolio-5.jpg" data-gallery="portfolioGallery"
                class="portfolio-lightbox preview-link" title="Web 2"><i class="bx bx-plus"></i></a>
            <a href="portfolio-details.html" class="details-link" title="More Details"><i
                    class="bx bx-link"></i></a>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 portfolio-item filter-app">
        <img src="assets/img/portfolio/portfolio-6.jpg" class="img-fluid" alt="">
        <div class="portfolio-info">
            <h4>App 3</h4>
            <p>App</p>
            <a href="assets/img/portfolio/portfolio-6.jpg" data-gallery="portfolioGallery"
                class="portfolio-lightbox preview-link" title="App 3"><i class="bx bx-plus"></i></a>
            <a href="portfolio-details.html" class="details-link" title="More Details"><i
                    class="bx bx-link"></i></a>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
        <img src="assets/img/portfolio/portfolio-7.jpg" class="img-fluid" alt="">
        <div class="portfolio-info">
            <h4>Card 1</h4>
            <p>Card</p>
            <a href="assets/img/portfolio/portfolio-7.jpg" data-gallery="portfolioGallery"
                class="portfolio-lightbox preview-link" title="Card 1"><i class="bx bx-plus"></i></a>
            <a href="portfolio-details.html" class="details-link" title="More Details"><i
                    class="bx bx-link"></i></a>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 portfolio-item filter-card">
        <img src="assets/img/portfolio/portfolio-8.jpg" class="img-fluid" alt="">
        <div class="portfolio-info">
            <h4>Card 3</h4>
            <p>Card</p>
            <a href="assets/img/portfolio/portfolio-8.jpg" data-gallery="portfolioGallery"
                class="portfolio-lightbox preview-link" title="Card 3"><i class="bx bx-plus"></i></a>
            <a href="portfolio-details.html" class="details-link" title="More Details"><i
                    class="bx bx-link"></i></a>
        </div>
    </div>

    <div class="col-lg-4 col-md-6 portfolio-item filter-web">
        <img src="assets/img/portfolio/portfolio-9.jpg" class="img-fluid" alt="">
        <div class="portfolio-info">
            <h4>Web 3</h4>
            <p>Web</p>
            <a href="assets/img/portfolio/portfolio-9.jpg" data-gallery="portfolioGallery"
                class="portfolio-lightbox preview-link" title="Web 3"><i class="bx bx-plus"></i></a>
            <a href="portfolio-details.html" class="details-link" title="More Details"><i
                    class="bx bx-link"></i></a>
        </div>
    </div>

</div>

</div>
</section><!-- End Portfolio Section -->

<!-- ======= Our Clients Section ======= -->
<section id="clients" class="clients">
<div class="container">

<div class="section-title" data-aos="fade-up">
    <h2>Our <strong>Clubs</strong></h2>
    <p>Our college has some beautifull active clubs for the development of our students</p>
</div>

<div class="row no-gutters clients-wrap clearfix" data-aos="fade-up">

    <div class="col-lg-3 col-md-4 col-xs-6 mb-2">
        <div class="client-logo">
            <img src="assets/img/clients/client-1.png" class="img-fluid" alt="">
        </div>
    </div>

    <div class="col-lg-3 col-md-4 col-xs-6">
        <div class="client-logo">
            <img src="assets/img/clients/client-2.png" class="img-fluid" alt="">
        </div>
    </div>

    <div class="col-lg-3 col-md-4 col-xs-6">
        <div class="client-logo">
            <img src="assets/img/clients/client-3.png" class="img-fluid" alt="">
        </div>
    </div>

    <div class="col-lg-3 col-md-4 col-xs-6">
        <div class="client-logo">
            <img src="assets/img/clients/client-4.png" class="img-fluid" alt="">
        </div>
    </div>

    <div class="col-lg-3 col-md-4 col-xs-6">
        <div class="client-logo">
            <img src="assets/img/clients/client-5.png" class="img-fluid" alt="">
        </div>
    </div>

    <div class="col-lg-3 col-md-4 col-xs-6">
        <div class="client-logo">
            <img src="assets/img/clients/client-6.png" class="img-fluid" alt="">
        </div>
    </div>

    <div class="col-lg-3 col-md-4 col-xs-6">
        <div class="client-logo">
            <img src="assets/img/clients/client-7.png" class="img-fluid" alt="">
        </div>
    </div>

    <div class="col-lg-3 col-md-4 col-xs-6">
        <div class="client-logo">
            <img src="assets/img/clients/client-8.png" class="img-fluid" alt="">
        </div>
    </div>

</div>

</div>
</section><!-- End Our Clients Section -->

</main><!-- End #main -->
@endsection
