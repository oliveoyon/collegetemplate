@extends('dashboard.admin.layouts.admin-layout')
@section('title', 'বাণী ম্যানেজমেন্ট')
@push('admincss')
<!-- DataTables -->
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
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
                    <h1 class="m-0">বাণী ম্যানেজমেন্ট</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">বাণী ম্যানেজমেন্ট</a></li>
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
                                বাণী সমূহ
                            </h3>
                            <div class="card-tools">
                                <ul class="nav nav-pills ml-auto">
                                    <li class="nav-item">

                                        <button class="btn btn-flat btn-success" data-toggle="modal" data-target="#addabouts"><i class="fas fa-plus-square mr-1"></i> বাণী যোগ
                                            করুন</button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="card-body table-responsive">
                            <table class="table table-hover table-condensed" id="menu-table">
                                <thead class="font-weight-bold bg-info">
                                    <th>#</th>
                                    <th>ডিপার্টমেন্ট</th>
                                    <th>নাম</th>
                                    <th>বর্ণনা</th>
                                    <th>আপলোড</th>
                                    <th>স্ট্যাটাস</th>
                                    <th>একশন <button class="btn btn-sm btn-danger d-none" id="deleteAllBtn">{{ __('language.deleteall') }}</button></th>
                                </thead>
                                <tbody>
                                    @foreach ($abouts as $about)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $about->faculty_department }}</td>
                                        <td class="font-weight-bold">{{ $about->name }}</td>
                                        <td>{{ strip_tags(substr($about->about_desc, 0, 500)) }}</td>
                                        <td>
                                            <img height="50" src="{{ asset('storage/img/about_img/' . $about->upload) }}" alt="">
                                        </td>
                                        <td class="{{ $about->about_status == 1 ? 'text-success' : 'text-danger' }} font-weight-bold">
                                            {{ $about->about_status == 1 ? 'একটিভ' : 'একটিভ নয়' }}
                                        </td>
                                        <td>
                                            <span data-id="{{ $about->id }}" id="editaboutBtn"><i class="fas fa-edit text-warning"></i></span> &nbsp;
                                            <span data-id="{{ $about->id }}" id="deleteaboutBtn"><i class="fas fa-trash-alt text-danger"></span></i>
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </div>


            <!--Add Menu Modal -->
            <div class="modal fade" id="addabouts" tabindex="-1" aria-labelledby="addMenuLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-xl">
                    <div class="modal-content">
                        <div class="modal-header bg-success">
                            <h5 class="modal-title" id="addMenuLabel">বাণী যোগ করুন</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.addAbout') }}" enctype="multipart/form-data" files="true" method="post" autocomplete="off" id="add-about-form">
                                @csrf

                                @if (auth()->user()->dept_id == 0 and count($faculties) > 0)
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="menu_name">ডিপার্টমেন্ট</label>
                                        <select class="form-control" name="dept_id" id="dept_id">
                                            @foreach ($faculties as $faculty)
                                            <option value="0">Main Website</option>
                                            @foreach ($faculty->departments as $department)
                                            <option value="{{ $department->id }}">
                                                {{ $faculty->faculty_name }} -
                                                {{ $department->department_name }}
                                            </option>
                                            @endforeach
                                            @endforeach
                                        </select>
                                        <span class="text-danger error-text dept_id_error"></span>
                                    </div>
                                </div>
                                @else
                                <input type="hidden" name="dept_id" value="{{ auth()->user()->dept_id }}">
                                @endif



                                <div class="form-group">
                                    <label for="name">নাম</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="নাম">
                                    <span class="text-danger error-text name_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="about_type">বর্ণনা</label>
                                    <textarea name="about_desc" class="summernote" id="about_desc"></textarea>
                                    <span class="text-danger error-text about_desc_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="upload">আপলোড</label>
                                    <input type="file" class="form-control" name="upload" id="upload">
                                    <span class="text-danger error-text upload_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="status">স্ট্যাটাস</label>
                                    <select class="form-control" name="about_status" id="menu_status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    <span class="text-danger error-text about_status_error"></span>
                                </div>


                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-success">যোগ করুন</button>
                                </div>
                            </form>


                        </div>

                    </div>
                </div>
            </div>
            {{-- Modal End --}}


            {{-- Edit Modal --}}
            <div class="modal fade editabout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
                <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-info">
                            <h5 class="modal-title" id="exampleModalLabel">বাণী সংশোধন করুন</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.updateAboutDetails') }}" enctype="multipart/form-data" files="true" method="post" autocomplete="off" id="update-about-form">
                                @csrf
                                <input type="hidden" name="sid">

                                @if (auth()->user()->dept_id == 0 AND (count($faculties) > 0))
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="menu_name">ডিপার্টমেন্ট</label>
                                        <select class="form-control" name="dept_id" id="dept_id">
                                            @foreach ($faculties as $faculty)
                                            <option value="0">Main Website</option>
                                            @foreach ($faculty->departments as $department)
                                            <option value="{{ $department->id }}">
                                                {{ $faculty->faculty_name }} -
                                                {{ $department->department_name }}
                                            </option>
                                            @endforeach
                                            @endforeach
                                        </select>
                                        <span class="text-danger error-text dept_id_error"></span>
                                    </div>
                                </div>
                                @else
                                <input type="hidden" name="dept_id" value="{{ auth()->user()->dept_id }}">
                                @endif



                                <div class="form-group">
                                    <label for="name">নাম</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="নাম">
                                    <span class="text-danger error-text name_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="about_desc">বর্ণনা</label>
                                    <textarea name="about_desc" class="summernote" id="summernote"></textarea>
                                    <span class="text-danger error-text about_desc_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="upload">আপলোড</label>
                                    <input type="file" class="form-control" name="upload" id="upload">
                                    <span class="text-danger error-text upload_error"></span>
                                </div>

                                <div class="form-group">
                                    <label for="status">স্ট্যাটাস</label>
                                    <select class="form-control" name="about_status" id="menu_status">
                                        <option value="1">Active</option>
                                        <option value="0">Inactive</option>
                                    </select>
                                    <span class="text-danger error-text about_status_error"></span>
                                </div>


                                <div class="form-group">
                                    <button type="submit" class="btn btn-block btn-success">আপডেট</button>
                                </div>
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
<script src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script>
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.2.0/dist/sweetalert2.min.js"></script>

<!-- Toastr -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.js"></script>


<script>
    new DataTable('#menu-table');
</script>



<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(document).ready(function() {

        $('#add-about-form').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(form).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.code == 0) {
                        toastr.error(data.msg); // Show toastr error about
                    } else {
                        var redirectUrl = data.redirect;
                        $('#addabouts').modal('hide');
                        $('#addabouts').find('form')[0].reset();
                        toastr.success(data.msg);
                        setTimeout(function() {
                            window.location.href = redirectUrl;
                        }, 2000);
                    }
                }
            });
        });


        $(document).on('click', '#editaboutBtn', function() {
            var about_id = $(this).data('id');

            $('.editabout').find('form')[0].reset();
            $('.editabout').find('span.error-text').text('');
            $.post("{{ route('admin.getAboutDetails') }}", {
                about_id: about_id
            }, function(data) {
                //alert(data.details.version_name);
                var aboutModal = $('.editabout');
                $('.editabout').find('input[name="sid"]').val(data.details.id);
                $('.editabout').find('input[name="name"]').val(data.details.name);
                $('.editabout').find('select[name="about_status"]').val(data.details
                    .about_status);
                $('.editabout').find('select[name="dept_id"]').val(data.details.dept_id);
                $('#summernote').summernote('code', data.details.about_desc);
                $('.editabout').modal('show');
            }, 'json');
        });

        $('#update-about-form').on('submit', function(e) {
            e.preventDefault();
            var form = this;
            $.ajax({
                url: $(form).attr('action'),
                method: $(form).attr('method'),
                data: new FormData(form),
                processData: false,
                dataType: 'json',
                contentType: false,
                beforeSend: function() {
                    $(form).find('span.error-text').text('');
                },
                success: function(data) {
                    if (data.code == 0) {
                        // Display toastr error about if validation fails
                        toastr.error(data.msg);
                        // Optionally, you can also display individual field errors
                        $.each(data.error, function(prefix, val) {
                            $(form).find('span.' + prefix + '_error').text(val[0]);
                        });
                    } else {
                        // Redirect and display success toastr about if update is successful
                        var redirectUrl = data.redirect;
                        $('.editabout').modal('hide');
                        $('.editabout').find('form')[0].reset();
                        toastr.success(data.msg);
                        setTimeout(function() {
                            window.location.href = redirectUrl;
                        }, 2000); // Adjust the delay as needed (in milliseconds)
                    }
                }
            });
        });


        //DELETE Version RECORD
        $(document).on('click', '#deleteaboutBtn', function() {
            var about_id = $(this).data('id');
            var url = '<?= route('admin.deleteAbout') ?>';
            swal.fire({
                title: 'Are you sure?',
                html: 'You want to <b>delete</b> this Sub Menu',
                showCancelButton: true,
                showCloseButton: true,
                cancelButtonText: 'Cancel',
                confirmButtonText: 'Yes, Delete',
                cancelButtonColor: '#d33',
                confirmButtonColor: '#556ee6',
                width: 300,
                allowOutsideClick: false
            }).then(function(result) {
                if (result.value) {
                    $.post(url, {
                        about_id: about_id
                    }, function(data) {
                        if (data.code == 1) {
                            var redirectUrl = data.redirect;
                            toastr.success(data.msg);
                            setTimeout(function() {
                                window.location.href = redirectUrl;
                            }, 1000); // Adjust the delay as needed (in milliseconds)

                        } else {
                            toastr.error(data.msg);
                        }
                    }, 'json');
                }
            });
        });

    });
</script>
@endpush