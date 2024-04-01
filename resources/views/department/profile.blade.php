@extends('department.layouts.dept-layouts')

@section('deptcontent')
<!-- Font Awesome -->
@push('admincss')
<!-- Font Awesome -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

@endpush
<style>
    .social-icons {
        display: flex;
        justify-content: center;
    }

    .social-icon {
        font-size: 20px;
        margin: 0 5px;
        color: #333;
        /* Change color if needed */
    }
</style>


@php
$segments = Request::segments();
$currentFaculty = isset($segments[1]) ? $segments[1] : '';
$currentDept = isset($segments[2]) ? $segments[2] : '';
@endphp
<section id="breadcrumbs" class="breadcrumbs">
    <div class="container">

        <div class="d-flex justify-content-between align-items-center">
            <h2>শিক্ষক প্রোফাইল</h2>
            <ol>
                <li><a href="{{route('index')}}">হোম</a></li>
                <li>শিক্ষক প্রোফাইল</li>
            </ol>
        </div>

    </div>
</section><!-- End Breadcrumbs -->


<!-- ======= Blog Section ======= -->
<section id="blog" class="blog">
    <div class="container" data-aos="fade-up">

        <div class="row">


            <div class="col-md-4">
                <div class="card mb-3">
                    <img src="{{ asset('storage/img/teacher_img/' . $teacher->teacher_image) }}" class="card-img-top" alt="{{ $teacher->teacher_name }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $teacher->teacher_name }}</h5>
                        <p class="card-text">{{ $teacher->teacher_email }}</p>
                        <!-- Add other related information here -->
                        <ul class="list-unstyled">
                            <li><i class="fas fa-user-tie"></i> {{ $teacher->teacher_designation }}</li>
                            <li><i class="fas fa-phone"></i> {{ $teacher->teacher_mobile }}</li>
                            <!-- Add other social media icons if available -->
                            <div class="social-icons mt-3">
                                @if($teacher->twitter)
                                <a href="{{ $teacher->twitter }}" class="social-icon"><i class="fab fa-twitter"></i></a>
                                @endif
                                @if($teacher->facebook)
                                <a href="{{ $teacher->facebook }}" class="social-icon"><i class="fab fa-facebook"></i></a>
                                @endif
                                @if($teacher->instagram)
                                <a href="{{ $teacher->instagram }}" class="social-icon"><i class="fab fa-instagram"></i></a>
                                @endif
                                @if($teacher->linkedin)
                                <a href="{{ $teacher->linkedin }}" class="social-icon"><i class="fab fa-linkedin"></i></a>
                                @endif
                            </div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Description</h5>
                        <p class="card-text">{!! $teacher->teacher_desc !!}</p>
                    </div>
                </div>
            </div>

        </div><!-- End blog sidebar -->

    </div>

    </div>
</section><!-- End Blog Section -->

@endsection