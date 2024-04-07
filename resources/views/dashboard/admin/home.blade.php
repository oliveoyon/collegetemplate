@extends('dashboard.admin.layouts.admin-layout')
@section('title', 'Dashboard')
@push('admincss')
<link rel="stylesheet" href="dist/css/custom.css">
@endpush

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <style>
      .content {
          background-color: #f8f9fa;
          padding: 40px;
          text-align: center;
          /* min-height: 80vh; */
          display: flex;
          align-items: center;
          justify-content: center;
          font-size: 30px;
      }

      .centered {
          text-align: center;
      }
  </style>
    <!-- Main content -->
    <div class="content">
      <div class="row">
          <div class="container">
              <div class="centered">
              {{ $webs->school_title }}
              </div>
          </div>
      </div>
  </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->






@endsection

