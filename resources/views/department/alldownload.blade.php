@extends('department.layouts.dept-layouts')

@section('deptcontent')
@php
$segments = Request::segments();
$currentFaculty = isset($segments[1]) ? $segments[1] : '';
$currentDept = isset($segments[2]) ? $segments[2] : '';
@endphp
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h2>ডাউনলোড</h2>
            <ol>
                <li><a href="{{route('index')}}">হোম</a></li>
                <li>ডাউনলোড</li>
            </ol>
        </div>

    </div>
</section><!-- End Breadcrumbs -->


<!-- ======= Blog Section ======= -->
<section id="blog" class="blog">
    <div class="container" data-aos="fade-up">

        <div class="row">

            <div class="col-lg-8 entries">

                <article class="entry">

                    <h2 class="entry-title">
                        <a href=রl">সকল ডাউনলোড</a>
                    </h2>

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

                    </div>
                </article><!-- End blog entry -->



            </div><!-- End blog entries list -->

            <div class="col-lg-4">

                <div class="sidebar">
                    <h3 class="sidebar-title">অন্যান্য নোটিশ</h3>
                    <div class="sidebar-item recent-posts">

                        @php $count = 0; @endphp

                        @foreach ($provider_ntcs as $ntcs)
                        @if ($count < 10) <div class="post-item clearfix">
                            @if ($ntcs->upload)
                            @if (pathinfo($ntcs->upload, PATHINFO_EXTENSION) === 'pdf')
                            <img src="{{ asset('web/assets/img/pdf.png') }}" alt="" class="img-fluid">
                            @else
                            <div class="entry-img">
                                <img src="{{ asset('storage/img/events/' . $ntcs->upload) }}" alt="" class="img-fluid">
                            </div>
                            @endif
                            @else
                            <img src="{{ asset('web/assets/img/noimg.png') }}" alt="" class="img-fluid">
                            @endif
                            <h4><a href="{{ url('notice/'.$ntcs->url) }}">{{ $ntcs->event_title }}</a></h4>
                            <time>{{ date('F j, Y', strtotime($ntcs->created_at)) }}</time>
                    </div>
                    @php $count++; @endphp
                    @else
                    @break
                    @endif
                    @endforeach



                </div><!-- End sidebar recent posts-->



            </div><!-- End sidebar -->

        </div><!-- End blog sidebar -->

    </div>

    </div>
</section><!-- End Blog Section -->

@endsection