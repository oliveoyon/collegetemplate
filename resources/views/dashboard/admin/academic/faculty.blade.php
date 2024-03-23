@extends('dashboard.admin.layouts.admin-layout')
@section('title', 'Faculty')
@push('admincss')
    <!-- DataTables -->
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.2.0/dist/sweetalert2.min.css">

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
                        <h1 class="m-0">{{ __('language.faculty') }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('language.dashboard') }}</a></li>
                            <li class="breadcrumb-item">{{ __('language.faculty') }}</li>
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

                        <div class="card card-outline">
                            <div class="card-header bg-navy">
                                <h3 class="card-title">
                                    <i class="fas fa-chalkboard-teacher mr-1"></i>
                                    {{ __('language.faculty_list') }}
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">

                                            <button class="btn btn-success btn-sm" data-toggle="modal"
                                                data-target="#addfacultys"><i class="fas fa-plus-square mr-1"></i>
                                                {{ __('language.faculty_add') }}</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-bordered table-striped table-hover table-sm" id="datas-table">
                                    <thead style="border-top: 1px solid #b4b4b4">
                                        <th style="width: 15px">#</th>
                                        <th>{{ __('language.faculty_name') }}</th>
                                        <th>{{ __('language.status') }}</th>
                                        <th style="width: 40px">{{ __('language.action') }} <button
                                                class="btn btn-sm btn-danger d-none"
                                                id="deleteAllBtn">{{ __('language.deleteall') }}</button></th>
                                    </thead>
                                    <tbody>
                                        @foreach ($facultys as $faculty)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="font-weight-bold">{{ $faculty->faculty_name }}</td>
                                                <td
                                                    class="{{ $faculty->faculty_status == 1 ? 'text-success' : 'text-danger' }} font-weight-bold">
                                                    {{ $faculty->faculty_status == 1 ? __('language.active') : __('language.inactive') }}
                                                </td>

                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-warning btn-xs"
                                                            data-id="{{ $faculty->id }}" id="editFacultyBtn"><i
                                                                class="fas fa-edit"></i></button>
                                                        <button type="button" class="btn btn-danger btn-xs"
                                                            data-id="{{ $faculty->id }}" id="deleteFacultyBtn"><i
                                                                class="fas fa-trash-alt "></i></button>
                                                    </div>
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
                <div class="modal fade" id="addfacultys" tabindex="-1" aria-labelledby="addFacultyLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <h5 class="modal-title" id="addFacultyLabel">{{ __('language.faculty_add') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.addFaculty') }}" enctype="multipart/form-data" files="true"
                                    method="post" autocomplete="off" id="add-faculty-form">
                                    @csrf

                                    <div class="form-group">
                                        <label for="faculty_name">{{ __('language.faculty_name') }}</label>
                                        <input type="text" class="form-control form-control-sm" name="faculty_name"
                                            id="faculty_name" placeholder="{{ __('language.faculty_name') }}">
                                        <span class="text-danger error-text faculty_name_error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="status">{{ __('language.status') }}</label>
                                        <select class="form-control form-control-sm" name="faculty_status"
                                            id="faculty_status">
                                            <option value="1">{{ __('language.active') }}</option>
                                            <option value="0">{{ __('language.inactive') }}</option>
                                        </select>
                                        <span class="text-danger error-text faculty_status_error"></span>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit"
                                            class="btn btn-block btn-success">{{ __('language.save') }}</button>
                                    </div>
                                </form>


                            </div>

                        </div>
                    </div>
                </div>
                {{-- Modal End --}}


                {{-- Edit Modal --}}
                <div class="modal fade editFaculty" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true" data-keyboard="false" data-backdrop="static">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-purple">
                                <h5 class="modal-title" id="exampleModalLabel">{{ __('language.faculty_edit') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            {{-- {{ route('admin.updatecategoryDetails'); }} --}}
                            <div class="modal-body">
                                <form action="{{ route('admin.updateFacultyDetails') }}" enctype="multipart/form-data"
                                    files="true" method="post" autocomplete="off" id="update-faculty-form">
                                    @csrf
                                    <input type="hidden" name="vid">
                                    <div class="form-group">
                                        <label for="faculty_name">{{ __('language.faculty_name') }}</label>
                                        <input type="text" class="form-control form-control-sm" name="faculty_name"
                                            id="faculty_name" placeholder="{{ __('language.faculty_name') }}">
                                        <span class="text-danger error-text faculty_name_error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="status">{{ __('language.status') }}</label>
                                        <select class="form-control form-control-sm" name="faculty_status"
                                            id="faculty_status">
                                            <option value="1">{{ __('language.active') }}</option>
                                            <option value="0">{{ __('language.inactive') }}</option>
                                        </select>
                                        <span class="text-danger error-text faculty_status_error"></span>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit"
                                            class="btn btn-block bg-purple">{{ __('language.update') }}</button>
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

    <script>
        new DataTable('#data-table');
    </script>



    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(document).ready(function() {
            // Image preview
            $("#upload").change(function() {
                readURL(this);
            });

            // Add Faculty RECORD
            $('#add-faculty-form').on('submit', function(e) {
                e.preventDefault();
                var form = this;

                // Disable the submit button to prevent double-clicking
                $(form).find(':submit').prop('disabled', true);

                // Show the loader overlay
                $('#loader-overlay').show();

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
                            $.each(data.error, function(prefix, val) {
                                $(form).find('span.' + prefix + '_error').text(val[0]);
                            });
                        } else {
                            var redirectUrl = data.redirect;
                            $('#addfacultys').modal('hide');
                            $('#addfacultys').find('form')[0].reset();
                            toastr.success(data.msg);

                            setTimeout(function() {
                                window.location.href = redirectUrl;
                            }, 1000); // Adjust the delay as needed (in milliseconds)
                        }
                    },
                    complete: function() {
                        // Enable the submit button and hide the loader overlay
                        $(form).find(':submit').prop('disabled', false);
                        $('#loader-overlay').hide();
                    }
                });
            });

            $(document).on('click', '#editFacultyBtn', function() {
                var faculty_id = $(this).data('id');

                $('.editFaculty').find('form')[0].reset();
                $('.editFaculty').find('span.error-text').text('');
                $.post("{{ route('admin.getFacultyDetails') }}", {
                    faculty_id: faculty_id
                }, function(data) {
                    //alert(data.details.faculty_name);
                    var linkModal = $('.editFaculty');
                    $('.editFaculty').find('input[name="vid"]').val(data.details.id);
                    $('.editFaculty').find('input[name="faculty_name"]').val(data.details
                        .faculty_name);
                    $('.editFaculty').find('select[name="faculty_status"]').val(data.details
                        .faculty_status);
                    $('.editFaculty').modal('show');
                }, 'json');
            });

            // Update Faculty RECORD
            $('#update-faculty-form').on('submit', function(e) {
                e.preventDefault();
                var form = this;

                // Disable the submit button to prevent double-clicking
                $(form).find(':submit').prop('disabled', true);

                // Show the loader overlay
                $('#loader-overlay').show();

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
                            $.each(data.error, function(prefix, val) {
                                $(form).find('span.' + prefix + '_error').text(val[0]);
                            });
                        } else {
                            var redirectUrl = data.redirect;
                            $('.editFaculty').modal('hide');
                            $('.editFaculty').find('form')[0].reset();
                            toastr.success(data.msg);

                            setTimeout(function() {
                                window.location.href = redirectUrl;
                            }, 1000); // Adjust the delay as needed (in milliseconds)
                        }
                    },
                    complete: function() {
                        // Enable the submit button and hide the loader overlay
                        $(form).find(':submit').prop('disabled', false);
                        $('#loader-overlay').hide();
                    }
                });
            });

            // DELETE Faculty RECORD
            $(document).on('click', '#deleteFacultyBtn', function() {
                var faculty_id = $(this).data('id');
                var url = '<?= route('admin.deleteFaculty') ?>';

                swal.fire({
                    title: 'Are you sure?',
                    html: 'You want to <b>delete</b> this faculty name',
                    showCancelButton: true,
                    showCloseButton: true,
                    cancelButtonText: 'Cancel',
                    confirmButtonText: 'Yes, Delete',
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',

                    allowOutsideClick: false
                }).then(function(result) {
                    if (result.value) {
                        // Show the loader overlay
                        $('#loader-overlay').show();

                        $.post(url, {
                            faculty_id: faculty_id
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
                        }, 'json').always(function() {
                            // Hide the loader overlay regardless of the request result
                            $('#loader-overlay').hide();
                        });
                    }
                });
            });

        });
    </script>
@endpush
