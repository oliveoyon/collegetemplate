@extends('department.layouts.dept-layouts')

@section('deptcontent')
@push('admincss')
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/moment@2.29.1/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@3.10.2/dist/fullcalendar.min.js"></script>
@endpush


@php
$segments = Request::segments();
$currentFaculty = isset($segments[1]) ? $segments[1] : '';
$currentDept = isset($segments[2]) ? $segments[2] : '';
@endphp
<section id="hero">
    <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">

        <div class="carousel-inner" role="listbox">

            @foreach ($sliders as $slider)
            <div class="carousel-item active" style="background-image: url('{{ asset('storage/img/slider/' . $slider->upload) }}');">
                @if ($slider->title)
                <div class="carousel-container">
                    <div class="carousel-content animate__animated animate__fadeInUp">
                        <h2>{{ $slider->title }}</h2>
                        <p>{{ $slider->desc }}</p>
                    </div>
                </div>
                @endif
            </div>
            @endforeach





        </div>

        <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>

    </div>
</section><!-- End Hero -->

<main id="main">

    <!-- ======= About Us Section ======= -->
    <section id="about-us" class="about-us">
        <div class="container" data-aos="fade-up">
            @if ($about)
            <div class="row content">
                <div class="col-lg-6" data-aos="fade-right">
                    <img src="{{ asset('storage/img/about_img/' . $about->upload) }}" class="principal-image float-left" alt="" style="max-width: 100%; height: auto;">
                    <h4 class="mt-4">{{ $about->name }}</h4>
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0" data-aos="fade-left">
                    <p>{!! $about->about_desc !!}</p>
                </div>
            </div>
            @endif


        </div>
    </section><!-- End About Us Section -->

    <section class="principal-message-section">
        <div class="container principal-container">
            @if ($messages)
            <div class="row">
                <div class="col-md-4 text-center mb-4 mb-md-0">
                    <div class="image-container" data-aos="fade-right">
                        <img src="{{ asset('storage/img/message_img/' . $messages->upload) }}" height="200" class="principal-image float-left" alt="">
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
            @endif
        </div>
    </section>

    <section id="features" class="features mt-5">
        <div class="container">

            <div class="section-title" data-aos="fade-up">
                <h2 style="font-family: SolaimanLipi"><strong>নোটিশ বোর্ড</strong></h2>
                <p>সকল নোটিশ, ইভেন্ট, সেমিনার, ওয়ার্কশপ ও অন্যান্য তথ্য</p>
                <hr>
            </div>

            @if (isset($provider_ntcs))



            <div class="row">
                <div class="col-lg-4 mb-5 mb-lg-0" data-aos="fade-right" style="border-right: 1px solid rgb(189, 189, 189)">
                    <ul class="nav nav-tabs flex-column">
                        @php $index = 1; @endphp
                        @foreach ($provider_ntcs->unique('type_name') as $ntcs)
                        <li class="nav-item">
                            <a class="nav-link {{ $index === 1 ? 'active show' : '' }}" data-bs-toggle="tab" href="#tab-{{ $index }}">
                                <h4>{{ $ntcs->type_name }}</h4>
                                <p>সকল প্রকার {{ $ntcs->type_name }} তথ্য</p>
                            </a>
                        </li>
                        @php $index++; @endphp
                        @endforeach
                    </ul>
                </div>

                <div class="col-lg-8 ml-auto" data-aos="fade-left" data-aos-delay="100">
                    <div class="tab-content">
                        @php $tabIndex = 1; @endphp
                        @foreach ($provider_ntcs->unique('type_name') as $ntcs)
                        <div class="tab-pane {{ $tabIndex === 1 ? 'active show' : '' }}" id="tab-{{ $tabIndex }}">
                            <table class="table bottom-border-table">
                                <tbody>
                                    @php $count = 0; @endphp
                                    @foreach ($provider_ntcs as $event)
                                    @if ($event->type_name === $ntcs->type_name)
                                    @if ($count < 10) <tr>
                                        <td>{{ $event->event_title }}</td>
                                        <td><small>{{ \Carbon\Carbon::parse($event->created_at)->format('d F, Y') }}</small>
                                        </td>
                                        <td>
                                            <a href="{{ route('deptnotice', ['faculty' => $currentFaculty, 'dept' => $currentDept, 'noticeslug' => $event->url]) }}" class="btn btn-sm btn-info">View</a>
                                        </td>
                                        </tr>
                                        @php $count++; @endphp
                                        @else
                                        @break
                                        @endif
                                        @endif
                                        @endforeach

                                        @if ($count > 8)
                                        <tr>
                                            <td colspan="3" class="text-center">
                                                <a href="{{ route('allnotice', ['cat' => $ntcs->type_name]) }}" class="btn btn-success show-all-button btn-sm">
                                                    সকল নোটিশ
                                                </a>
                                            </td>
                                        </tr>
                                        @endif
                                </tbody>
                            </table>
                        </div>
                        @php $tabIndex++; @endphp
                        @endforeach
                    </div>
                </div>
            </div>

            @endif


        </div>
    </section><!-- End Features Section -->

    <section id="team" class="team section-bg">
        <div class="container">

            <div class="section-title" data-aos="fade-up">
                <h2>শিক্ষকবৃন্দ</h2>
                <p>আমাদের কলেজের শিক্ষকগণ একাধিক ধরনের অভিজ্ঞতা এবং সম্প্রতি প্রাপ্ত জ্ঞানের সাথে আসতে পছন্দ করেন। তারা ছাত্রদের বিভিন্ন বিষয়ে উন্নতি করতে প্রস্তুত এবং তাদের পথে সহায়তা করতে সচেষ্ট। আমাদের শিক্ষকদের অধ্যাপনা এবং সাথে সাথে ছাত্রদের সাথে সম্পর্ক স্থাপনের মাধ্যমে একটি সমৃদ্ধ শিক্ষা পরিবেশ প্রদান করা হয়। আমরা গর্বিত এবং সৎ শিক্ষকদের সাথে সম্পর্ক গড়ে তোলার জন্য প্রতিশ্রুতিবদ্ধ। তাদের প্রশিক্ষণ ও পরামর্শের মাধ্যমে, ছাত্ররা নিজেদের আদর্শ লক্ষ্যের দিকে এগিয়ে যাচ্ছেন এবং পেশাদার জীবনে সফলতা অর্জন করতে সক্ষম হচ্ছেন।</p>
            </div>

            <div class="row">
                @foreach ($teachers as $teacher)
                <div class="col-lg-3 col-md-6 d-flex align-items-stretch">
                    <div class="member" data-aos="fade-up">
                        <div class="member-img">
                            <img src="{{ asset('storage/img/teacher_img/' . $teacher->teacher_image) }}" class="img-fluid" alt="">
                            <div class="social">
                                @if($teacher->twitter)
                                <a href="{{ $teacher->twitter }}"><i class="bi bi-twitter"></i></a>
                                @endif
                                @if($teacher->facebook)
                                <a href="{{ $teacher->facebook }}"><i class="bi bi-facebook"></i></a>
                                @endif
                                @if($teacher->instagram)
                                <a href="{{ $teacher->instagram }}"><i class="bi bi-instagram"></i></a>
                                @endif
                                @if($teacher->linkedin)
                                <a href="{{ $teacher->linkedin }}"><i class="bi bi-linkedin"></i></a>
                                @endif
                            </div>

                        </div>
                        <div class="member-info">
                            <h4><a href="{{ route('profile', ['faculty' => $currentFaculty, 'dept' => $currentDept, 'slug' => $teacher->teacher_slug]) }}">{{ $teacher->teacher_name }}</a></h4>
                            <span>{{ $teacher->teacher_designation }}</span>
                        </div>
                    </div>
                </div>
                @endforeach



            </div>

        </div>
    </section><!-- End Our Team Section -->

    <section class="menu-section">
        <div class="container">
            @isset($menus)
            <div class="row">
                @foreach ($menus as $menu)
                @if ($menu->is_home == 1)
                <div class="col-sm-4 col-12 mb-4">
                    <div class="menu-box d-flex flex-column h-100">
                        <div class="col-sm-12 col-12 pt-3 pb-2" id="cart" data-aos="fade-in" data-aos-duration="1000">
                            <p class="session" style="font-weight: bold">&nbsp;&nbsp;{{ $menu->menu_name }}
                            </p>
                            <div class="row">
                                <div class="col-sm-3 col-3">
                                    <img width="200" src="{{ asset('storage/img/menu_img/' . $menu->upload) }}" class="img-fluid">
                                </div>
                                <div class="col-sm-9 col-9 p-0">
                                    <ul class="menus">

                                        @foreach ($menu->subMenus as $subMenu)
                                        <li><i class="fa fa-caret-right"></i><a href="{{ route('menudesc', ['slug' => $menu->menu_slug, 'submenu' => $subMenu->submenu_slug]) }}">{{ $subMenu->submenu_name }}</a>
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
            @endisset


        </div>
    </section>



    <!-- ======= Services Section ======= -->
    <section class="custom-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center text-lg-left">
                    <h3 style="font-family: SolaimanLipi" class="mb-4"><strong>ডাউনলোড</strong></h3>
                    <div class="card-body table-container">
                        <!-- Notice List -->
                        <table class="custom-table table-striped">
                            <tr>
                                <th>নং</th>
                                <th>শিরোনাম</th>
                                <th>বর্ণনা</th>
                                <th>তারিখ</th>
                                <th>একশন</th>
                            </tr>
                            @foreach ($uploads as $upload)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $upload->title }}</td>
                                <td>{!! Str::substr($upload->description, 0, 100) !!}</td>
                                <td>{{ date('M j, Y', strtotime($upload->created_at)) }}</td>
                                <td><a href="{{ route('deptdownload', ['faculty' => $currentFaculty, 'dept' => $currentDept, 'slug' => $upload->url]) }}" class="btn btn-sm btn-success">বিস্তারিত</a></td>

                            </tr>
                            @endforeach
                        </table>
                        <div class="show-all-notices">
                            <a href="{{ route('deptalldownload', ['faculty' => $currentFaculty, 'dept' => $currentDept]) }}" class="btn btn-success show-all-button btn-sm">সকল
                                ডাউনলোড</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row">

                <div class="col-md-9">
                    <h3 style="font-family: SolaimanLipi" class="mb-4"><strong>একাডেমিক ক্যালেন্ডার</strong></h3>

                    <div class="card">
                        <div class="card-body">
                            <div class="container">
                                <div id="fullCalendar"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <h3 style="font-family: SolaimanLipi" class="mb-4"><strong>গুরুত্বপূর্ণ লিঙ্ক</strong></h3>
                    @isset($important_links)
                    <div class="card important-links-card">
                        <div class="card-body">
                            <ul class="menus">

                                @foreach ($important_links as $link)
                                <li class="list-group-item"><a href="{{ $link->link }}">{{ $link->link_name }}</a></li>
                                @endforeach
                                <!-- Add more links as needed -->
                            </ul>
                        </div>
                    </div>
                    @endisset


                </div>
            </div>
        </div>
    </section>




</main><!-- End #main -->

@endsection