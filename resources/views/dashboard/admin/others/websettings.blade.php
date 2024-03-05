@extends('dashboard.admin.layouts.admin-layout')
@section('title',  'ওয়েব সেটিংস')
@push('admincss')
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap.min.css') }}">
  <link rel="stylesheet" href="{{ asset('datatable/css/dataTables.bootstrap4.min.css') }}">
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
            <h1 class="m-0">ওয়েব সেটিংস</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">ওয়েব সেটিংস</a></li>
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
                          ওয়েব সেটিংস
                        </h3>
                        
                      </div>
                      
                      <div class="card-body">
                        <form action="{{ route('admin.updatewebsettings') }}" enctype="multipart/form-data" files="true" method="post" autocomplete="off">
                            @csrf
                            <input type="hidden" name="wsid" value="{{ $data->id }}">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="school_title">স্কুলের নাম</label>
                                        <input type="text" class="form-control" id="school_title" name="school_title" value="{{ $data->school_title }}" required>
                                    </div>
                                </div>
                        
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="phone1">ফোন-১</label>
                                        <input type="text" class="form-control" id="phone1" name="phone1" value="{{ $data->phone1 }}" required>
                                    </div>
                                </div>
                        
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="phone2">ফোন-২</label>
                                        <input type="text" class="form-control" id="phone2" name="phone2" value="{{ $data->phone2 }}">
                                    </div>
                                </div>
                        
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="fax">গুগল ম্যাপ</label>
                                        <input type="text" class="form-control" id="fax" name="fax" value="{{ $data->fax }}">
                                    </div>
                                </div>
                        
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="email">ইমেইল</label>
                                        <input type="email" class="form-control" id="email" name="email" value="{{ $data->email }}" required>
                                    </div>
                                </div>
                        
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address_one">ঠিকানা-১</label>
                                        <input type="text" class="form-control" id="address_one" name="address_one" value="{{ $data->address_one }}" required>
                                    </div>
                                </div>
                        
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="address_two">ঠিকানা-২</label>
                                        <input type="text" class="form-control" id="address_two" name="address_two" value="{{ $data->address_two }}">
                                    </div>
                                </div>
                        
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="eiin">ইআইআইএন</label>
                                        <input type="text" class="form-control" id="eiin" name="eiin" value="{{ $data->eiin }}">
                                    </div>
                                </div>
                        
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="facebook">ফেইসবুক</label>
                                        <input type="text" class="form-control" id="facebook" name="facebook" value="{{ $data->facebook }}">
                                    </div>
                                </div>
                        
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="twitter">টুইটার</label>
                                        <input type="text" class="form-control" id="twitter" name="twitter" value="{{ $data->twitter }}">
                                    </div>
                                </div>
                        
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="linkedin">লিঙ্কডইন</label>
                                        <input type="text" class="form-control" id="linkedin" name="linkedin" value="{{ $data->linkedin }}">
                                    </div>
                                </div>
                        
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="instagram">ইন্সটাগ্রাম</label>
                                        <input type="text" class="form-control" id="instagram" name="instagram" value="{{ $data->instagram }}">
                                    </div>
                                </div>
                        
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="logo">লোগো</label>
                                        <input type="file" class="form-control" id="logo" name="logo">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">আপডেট করুন</button>
                        </form>
                        
                        
                      </div>
                    
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

<script src="https://cdn.datatables.net/1.11.4/js/dataTables.bootstrap4.min.js"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.2.0/dist/sweetalert2.min.js"></script>

<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


@endpush

