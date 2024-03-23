@extends('dashboard.admin.layouts.admin-layout')
@section('title', 'Department Management')

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
                        <h1 class="m-0">{{ __('language.department_mgmt') }}</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">

                        </ol>
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">{{ __('language.dashboard') }}</a></li>
                            <li class="breadcrumb-item">{{ __('language.department_mgmt') }}</li>
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
                                    {{ __('language.department_list') }}
                                </h3>
                                <div class="card-tools">
                                    <ul class="nav nav-pills ml-auto">
                                        <li class="nav-item">

                                            <button class="btn btn-success btn-sm" data-toggle="modal"
                                                data-target="#addDepartmentModal"><i class="fas fa-plus-square mr-1"></i>
                                                {{ __('language.department_add') }}</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="card-body table-responsive">
                                <div class="alert alert-danger" id="errorAlert" style="display: none;">
                                    <ul id="errorList">
                                        <!-- Error messages will be inserted here dynamically -->
                                    </ul>
                                </div>

                                <table class="table table-bordered table-striped table-hover table-sm" id="department-table">
                                    <thead style="border-top: 1px solid #b4b4b4">
                                        <th style="width: 10px">#</th>
                                        <th>{{ __('language.department_name') }}</th>
                                        <th>{{ __('language.faculty') }}</th>
                                        <th>{{ __('language.status') }}</th>
                                        <th style="width: 40px">{{ __('language.action') }}</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($departments as $department)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td class="font-weight-bold">{{ $department->department_name }}</td>
                                                <td>{{ $department->faculty->faculty_name }}</td>
                                                <td
                                                    class="{{ $department->department_status == 1 ? 'text-success' : 'text-danger' }} font-weight-bold">
                                                    {{ $department->department_status == 1 ? __('language.active') : __('language.inactive') }}
                                                </td>

                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-warning btn-xs"
                                                            data-id="{{ $department->id }}" id="editDepartmentBtn"><i
                                                                class="fas fa-edit"></i></button>
                                                        <button type="button" class="btn btn-danger btn-xs"
                                                            data-id="{{ $department->id }}" id="deleteDepartmentBtn"><i
                                                                class="fas fa-trash-alt"></i></button>
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

                <!-- Add Department Modal -->
                <div class="modal fade" id="addDepartmentModal" tabindex="-1" aria-labelledby="addDepartmentModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header bg-success">
                                <h5 class="modal-title" id="addDepartmentModalLabel">{{ __('language.department_add') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.addDepartment') }}" method="POST" autocomplete="off"
                                    id="add-department-form">
                                    @csrf
                                    <div class="form-group">
                                        <label for="department_name">{{ __('language.department_name') }}</label>
                                        <input type="text" class="form-control" name="department_name" id="department_name"
                                            placeholder="{{ __('language.department_name') }}">
                                        <span class="text-danger error-text department_name_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="faculty_id">{{ __('language.faculty') }}</label>
                                        <select class="form-control" name="faculty_id" id="faculty_id">
                                            @foreach ($faculties as $faculty)
                                                <option value="{{ $faculty->id }}">{{ $faculty->faculty_name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error-text faculty_id_error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="department_status">{{ __('language.status') }}</label>
                                        <select class="form-control" name="department_status" id="department_status">
                                            <option value="1">{{ __('language.active') }}</option>
                                            <option value="0">{{ __('language.inactive') }}</option>
                                        </select>
                                        <span class="text-danger error-text department_status_error"></span>
                                    </div>
                                    <button type="submit" class="btn btn-success">{{ __('language.save') }}</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <!-- Edit Department Modal -->
                <div class="modal fade editDepartment" tabindex="-1" role="dialog" aria-labelledby="editDepartmentLabel"
                    aria-hidden="true" data-keyboard="false" data-backdrop="static">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-purple">
                                <h5 class="modal-title" id="editDepartmentLabel">{{ __('language.department_edit') }}</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('admin.updateDepartmentDetails') }}" method="post" autocomplete="off"
                                    id="update-department-form">
                                    @csrf
                                    <input type="hidden" name="cid">
                                    <div class="form-group">
                                        <label for="department_name">{{ __('language.department_name') }}</label>
                                        <input type="text" class="form-control" name="department_name" id="department_name"
                                            placeholder="{{ __('language.department_name') }}">
                                        <span class="text-danger error-text department_name_error"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="faculty_id">{{ __('language.faculty') }}</label>
                                        <select class="form-control" name="faculty_id" id="faculty_id">
                                            @foreach ($faculties as $faculty)
                                                <option value="{{ $faculty->id }}">{{ $faculty->faculty_name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="text-danger error-text faculty_id_error"></span>
                                    </div>

                                    <div class="form-group">
                                        <label for="department_status">{{ __('language.status') }}</label>
                                        <select class="form-control" name="department_status" id="department_status">
                                            <option value="1">{{ __('language.active') }}</option>
                                            <option value="0">{{ __('language.inactive') }}</option>
                                        </select>
                                        <span class="text-danger error-text department_status_error"></span>
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

                <!-- Edit Section Modal -->



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

            $('#add-department-form').on('submit', function(e) {
                e.preventDefault();

                // Disable the submit button to prevent double-clicking
                $(this).find(':submit').prop('disabled', true);

                // Show the loader overlay
                $('#loader-overlay').show();

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
                            $.each(data.error, function(prefix, val) {
                                $(form).find('span.' + prefix + '_error').text(val[0]);
                            });
                        } else {
                            var redirectUrl = data.redirect;
                            $('#addDepartmentModal').modal('hide');
                            $('#addDepartmentModal').find('form')[0].reset();
                            toastr.success(data.msg);

                            setTimeout(function() {
                                window.location.href = redirectUrl;
                            }, 1000);
                        }
                    },
                    complete: function() {
                        // Enable the submit button and hide the loader overlay
                        $(form).find(':submit').prop('disabled', false);
                        $('#loader-overlay').hide();
                    }
                });
            });


            $(document).on('click', '#editDepartmentBtn', function() {
                var department_id = $(this).data('id');
                $('.editDepartment').find('form')[0].reset();
                $('.editDepartment').find('span.error-text').text('');
                $.post("{{ route('admin.getDepartmentDetails') }}", {
                    department_id: department_id
                }, function(data) {
                    $('.editDepartment').find('input[name="cid"]').val(data.details.id);
                    $('.editDepartment').find('input[name="department_name"]').val(data.details.department_name);
                    $('.editDepartment').find('select[name="faculty_id"]').val(data.details.faculty_id);

                    $('.editDepartment').find('select[name="department_status"]').val(data.details
                        .department_status);
                    $('.editDepartment').modal('show');
                }, 'json');
            });

            // Update Department RECORD
            $('#update-department-form').on('submit', function(e) {
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
                            // $('#category-table').DataTable().ajax.reload(null, false);
                            var redirectUrl = data.redirect;
                            $('.editDepartment').modal('hide');
                            $('.editDepartment').find('form')[0].reset();
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

            // DELETE Department RECORD
            $(document).on('click', '#deleteDepartmentBtn', function() {
                var department_id = $(this).data('id');
                var url = '<?= route('admin.deleteDepartment') ?>';

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'You want to delete this department',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Yes, delete it',
                    cancelButtonText: 'Cancel',
                    showLoaderOnConfirm: true,
                    preConfirm: function() {
                        // Show the loader overlay
                        $('#loader-overlay').show();

                        return $.post(url, {
                            department_id: department_id
                        }, function(data) {
                            if (data.code == 1) {
                                var redirectUrl = data.redirect;
                                toastr.success(data.msg);
                                setTimeout(function() {
                                    window.location.href = redirectUrl;
                                }, 1000);
                            } else {
                                toastr.error(data.msg);
                            }
                        }, 'json');
                    },
                    allowOutsideClick: function() {
                        // Hide the loader overlay on outside click
                        $('#loader-overlay').hide();
                        return true;
                    }
                });
            });

        });
    </script>

@endpush
