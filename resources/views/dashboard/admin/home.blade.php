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
                  test
              </div>
          </div>
      </div>
  </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->




  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
    <div class="p-3">
      <h5>Title</h5>
      <p>Sidebar content</p>
    </div>
  </aside>
  <!-- /.control-sidebar -->

  
  
@endsection

