@extends('dashboard.admin.layouts.admin-layout')
@section('title', 'নোটিশ ম্যানেজমেন্ট')
@push('admincss')
<!-- DataTables -->
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.18/summernote-bs4.min.css">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@7.28.11/dist/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
@endpush

@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">নোটিশ ম্যানেজমেন্ট</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">নোটিশ ম্যানেজমেন্ট</a></li>
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
                নোটিশ/ইভেন্টের তালিকা
              </h3>
              <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                  <li class="nav-item">

                    <button class="btn btn-flat btn-success" data-toggle="modal" data-target="#addnotices"><i class="fas fa-plus-square mr-1"></i> নোটিশ/ইভেন্ট যোগ করুন</button>
                  </li>
                </ul>
              </div>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover table-condensed" id="menu-table">
                <thead class="font-weight-bold bg-info">
                  <th>#</th>
                  <th>ডিপার্টমেন্ট</th>
                  <th>শিরোনাম</th>
                  <th>বর্ণনা</th>
                  <th>টাইপ</th>
                  <th>সংযুক্তি</th>
                  <th>শুরুর তারিখ</th>
                  <th>শেষ তারিখ</th>
                  <th>স্ট্যাটাস</th>
                  <th>একশন <button class="btn btn-sm btn-danger d-none" id="deleteAllBtn">{{ __('language.deleteall') }}</button></th>
                </thead>
                <tbody>
                  @foreach ($notices as $notice)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $notice->faculty_department }}</td>
                    <td class="font-weight-bold">{{ $notice->event_title }}</td>
                    <td>{{ strip_tags(substr($notice->event_description, 0, 500)) }}</td>
                    <td class="font-weight-bold">
                      {{$notice->type_name}}
                    </td>
                    <td class="{{ $notice->upload  ? 'text-success' : 'text-danger' }} font-weight-bold">
                      {{ $notice->upload ? 'সংযুক্ত' : 'সংযুক্ত নয়' }}
                    </td>
                    <td class="font-weight-bold">{{ $notice->start_date }}</td>
                    <td class="font-weight-bold">{{ $notice->end_date }}</td>
                    <td class="{{ $notice->event_status == 1 ? 'text-success' : 'text-danger' }} font-weight-bold">
                      {{ $notice->event_status == 1 ? 'একটিভ' : 'একটিভ নয়' }}
                    </td>
                    <td>
                      <span data-id="{{ $notice->id }}" id="editEventBtn"><i class="fas fa-edit text-warning"></i></span> &nbsp;
                      <span data-id="{{ $notice->id }}" id="deleteEventBtn"><i class="fas fa-trash-alt text-danger"></span></i>
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
      <div class="modal fade" id="addnotices" tabindex="-1" aria-labelledby="addMenuLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header bg-success">
              <h5 class="modal-title" id="addMenuLabel">মেনু যোগ করুন</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{ route('admin.addNotice') }}" enctype="multipart/form-data" files="true" method="post" autocomplete="off" id="add-notice-form">
                @csrf

                <div class="form-group">
                  <label for="menu_name">শিরোনাম</label>
                  <input type="text" class="form-control" name="event_title" required placeholder="নোটিশ/ইভেন্ট যোগ করুন">
                  <span class="text-danger error-text event_title_error"></span>
                </div>

                @if (auth()->user()->dept_id == 0 AND (count($faculties) > 0))
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
                @else
                <input type="hidden" name="dept_id" value="{{ auth()->user()->dept_id }}">
                @endif

                <div class="form-group">
                  <label for="menu_name">বর্ণনা</label>
                  <textarea name="event_description" class="summernote" id="event_description"></textarea>
                  <span class="text-danger error-text event_description_error"></span>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="event_type">টাইপ</label>
                      <select class="form-control" name="event_type_id" id="event_type_id">
                        @foreach ($eventTypes as $eventType)
                        <option value="{{ $eventType->id }}">{{ $eventType->type_name }}</option>
                        @endforeach
                      </select>
                      <span class="text-danger error-text event_type_error"></span>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="start_date">শুরুর তারিখ</label>
                      <input type="datetime-local" class="form-control" name="start_date" id="start_date">
                      <span class="text-danger error-text start_date_error"></span>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="end_date">শেষের তারিখ</label>
                      <input type="datetime-local" class="form-control" name="end_date" id="end_date">
                      <span class="text-danger error-text end_date_error"></span>
                    </div>
                  </div>
                </div>



                <div class="form-group">
                  <label for="upload">আপলোড</label>
                  <input type="file" class="form-control" name="upload" id="upload">
                  <span class="text-danger error-text upload_error"></span>
                </div>

                <div class="form-group">
                  <label for="status">স্ট্যাটাস</label>
                  <select class="form-control" name="event_status" id="event_status">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                  </select>
                  <span class="text-danger error-text event_status_error"></span>
                </div>

                <div class="form-group">
                  <label for="image_preview">Image Preview</label>
                  <div class="img-holder" id="image_preview"></div>
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
      <div class="modal fade editNotice" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">মেনু সংশোধন করুন</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            {{-- {{ route('admin.updatecategoryDetails'); }} --}}
            <div class="modal-body">
              <form action="{{ route('admin.updateNoticeDetails') }}" enctype="multipart/form-data" files="true" method="post" autocomplete="off" id="update-notice-form">
                @csrf
                <input type="hidden" name="nid">
                <div class="form-group">
                  <label for="menu_name">শিরোনাম</label>
                  <input type="text" class="form-control" name="event_title" required placeholder="নোটিশ/ইভেন্ট যোগ করুন">
                  <span class="text-danger error-text event_title_error"></span>
                </div>

                @if (auth()->user()->dept_id == 0 AND (count($faculties) > 0))
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
                @else
                <input type="hidden" name="dept_id" value="{{ auth()->user()->dept_id }}">
                @endif

                <div class="form-group">
                  <label for="menu_name">বর্ণনা</label>
                  <textarea name="event_description" class="summernote" id="event_description"></textarea>
                  <span class="text-danger error-text event_description_error"></span>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="event_type">টাইপ</label>
                      <select class="form-control" name="event_type_id" id="event_type_id">
                        @foreach ($eventTypes as $eventType)
                        <option value="{{ $eventType->id }}">{{ $eventType->type_name }}</option>
                        @endforeach
                      </select>
                      <span class="text-danger error-text event_type_error"></span>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="start_date">শুরুর তারিখ</label>
                      <input type="datetime-local" class="form-control" name="start_date" id="start_date">
                      <span class="text-danger error-text start_date_error"></span>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="end_date">শেষের তারিখ</label>
                      <input type="datetime-local" class="form-control" name="end_date" id="end_date">
                      <span class="text-danger error-text end_date_error"></span>
                    </div>
                  </div>
                </div>



                <div class="form-group">
                  <label for="upload">আপলোড</label>
                  <input type="file" class="form-control" name="upload" id="upload">
                  <span class="text-danger error-text upload_error"></span>
                </div>

                <div class="form-group">
                  <label for="status">স্ট্যাটাস</label>
                  <select class="form-control" name="event_status" id="event_status">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                  </select>
                  <span class="text-danger error-text event_status_error"></span>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-block btn-success">আপডেট করুন</button>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

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
    // Image preview
    $("#upload").change(function() {
      readURL(this);
    });

    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $("#image_preview").html('<img src="' + e.target.result + '" alt="Image Preview" style="max-width: 100px; max-height: 100px;">');
        };

        reader.readAsDataURL(input.files[0]);
      }
    }


    $('#add-notice-form').on('submit', function(e) {
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
            $.each(data.error, function(prefix, val) {
              $(form).find('span.' + prefix + '_error').text(val[0]);
            });
          } else {
            var redirectUrl = data.redirect;
            // $('#brand-table').DataTable().ajax.reload(null, false);
            $('#addnotices').modal('hide');
            $('#addnotices').find('form')[0].reset();
            toastr.success(data.msg);

            setTimeout(function() {
              window.location.href = redirectUrl;
            }, 2000); // Adjust the delay as needed (in milliseconds)
          }
        }
      });
    });

    $(document).on('click', '#editEventBtn', function() {
      var event_id = $(this).data('id');

      $('.editNotice').find('form')[0].reset();
      $('.editNotice').find('span.error-text').text('');
      $.post("{{ route('admin.getNoticeDetails') }}", {
        event_id: event_id
      }, function(data) {
        //alert(data.details.version_name);
        var noticeModal = $('.editNotice');
        $('.editNotice').find('input[name="nid"]').val(data.details.id);
        $('.editNotice').find('input[name="event_title"]').val(data.details.event_title);
        $('.editNotice').find('select[name="dept_id"]').val(data.details.dept_id);
        $('#event_description1').summernote('code', data.details.event_description);
        $('.editNotice').find('select[name="event_type"]').val(data.details.event_type);
        $('.editNotice').find('input[name="start_date"]').val(data.details.start_date);
        $('.editNotice').find('input[name="end_date"]').val(data.details.end_date);
        $('.editNotice').find('select[name="event_status"]').val(data.details.event_status);


        $('.editNotice').modal('show');
      }, 'json');
    });

    $('#update-notice-form').on('submit', function(e) {
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
            $.each(data.error, function(prefix, val) {
              $(form).find('span.' + prefix + '_error').text(val[0]);
            });
          } else {
            // $('#category-table').DataTable().ajax.reload(null, false);
            var redirectUrl = data.redirect;
            $('.editNotice').modal('hide');
            $('.editNotice').find('form')[0].reset();
            toastr.success(data.msg);

            setTimeout(function() {
              window.location.href = redirectUrl;
            }, 2000); // Adjust the delay as needed (in milliseconds)

          }
        }
      });
    });

    //DELETE Version RECORD
    $(document).on('click', '#deleteEventBtn', function() {
      var event_id = $(this).data('id');
      var url = '<?= route("admin.deleteNotice"); ?>';
      swal.fire({
        title: 'Are you sure?',
        html: 'You want to <b>delete</b> this Notice',
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
            event_id: event_id
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