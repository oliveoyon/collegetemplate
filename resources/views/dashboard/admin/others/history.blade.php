@extends('dashboard.admin.layouts.admin-layout')
@section('title',  'প্রতিষ্ঠানের ইতিহাস')
@push('admincss')
<!-- DataTables -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
@endpush

@section('content')
     <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">প্রতিষ্ঠানের ইতিহাস</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">প্রতিষ্ঠানের ইতিহাস</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">

                  <div class="card card-success card-outline">
                      <div class="card-header bg-success">
                        <h3 class="card-title">
                          <i class="fas fa-chalkboard-teacher mr-1"></i>
                          প্রতিষ্ঠানের ইতিহাস
                        </h3>
                        
                      </div>
                      <form action="{{ route('admin.updatehistory') }}" enctype="multipart/form-data" files="true" method="post" autocomplete="off" id="add-notice-form">
                        @csrf
                        
                        <input type="hidden" name="history_id" value="{{ $history->id }}">
                        <div class="form-group">
                            <textarea name="history" class="summernote" id="history" required>{{ $history->history }}</textarea>
                            <span class="text-danger error-text history_error"></span>
                        </div>
            
                        <div class="form-group">
                            <button type="submit" class="btn btn-block btn-success">আপডেট করুন</button>
                        </div>
                    </form>
                      
                  </div>
            </div>
            
        </div>





      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  
@endsection


@push('adminjs')


<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.2.0/dist/sweetalert2.min.js"></script>

<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>

<script>
  new DataTable('#menu-table');
</script>
    



    
@endpush

