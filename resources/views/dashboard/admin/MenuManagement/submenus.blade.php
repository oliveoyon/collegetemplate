@extends('dashboard.admin.layouts.admin-layout')
@section('title', 'সাবমেনু ম্যানেজমেন্ট')
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
          <h1 class="m-0">সাবমেনু ম্যানেজমেন্ট</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">সাবমেনু ম্যানেজমেন্ট</a></li>
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
                সাবমেনুর তালিকা
              </h3>
              <div class="card-tools">
                <ul class="nav nav-pills ml-auto">
                  <li class="nav-item">

                    <button class="btn btn-flat btn-success" data-toggle="modal" data-target="#addsubmenus"><i class="fas fa-plus-square mr-1"></i> সাবমেনু যোগ করুন</button>
                  </li>
                </ul>
              </div>
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover table-condensed" id="menu-table">
                <thead class="font-weight-bold bg-info">
                  <th>#</th>
                  <th>ডিপার্টমেন্ট</th>
                  <th>মেনুর নাম</th>
                  <th>সাবমেনুর নাম</th>
                  <th>বর্ণনা</th>
                  <th>আপলোড</th>
                  <th>স্ট্যাটাস</th>
                  <th>একশন <button class="btn btn-sm btn-danger d-none" id="deleteAllBtn">{{ __('language.deleteall') }}</button></th>
                </thead>
                <tbody>
                  @foreach ($submenus as $submenu)
                  <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $submenu->faculty_department }}</td>
                    <td class="font-weight-bold">{{ $submenu->menu_name }}</td>
                    <td class="font-weight-bold">{{ $submenu->submenu_name }}</td>
                    <td>{{ strip_tags(substr($submenu->submenu_desc, 0, 500)) }}</td>
                    <td>
                      @if($submenu->upload)
                      <a style="font-weight:bold; color: green" href="{{ asset('storage/img/submenu_img/' . $submenu->upload) }}" target="_blank">
                        <i class="fas fa-file-pdf"></i> PDF Document
                      </a>
                      @else
                      <span style="font-weight:bold; color: red">সংযুক্ত নেই</span>
                      @endif
                    </td>
                    <td class="{{ $submenu->submenu_status == 1 ? 'text-success' : 'text-danger' }} font-weight-bold">
                      {{ $submenu->submenu_status == 1 ? 'একটিভ' : 'একটিভ নয়' }}
                    </td>
                    <td>
                      <span data-id="{{ $submenu->id }}" id="editSubMenuBtn"><i class="fas fa-edit text-warning"></i></span> &nbsp;
                      <span data-id="{{ $submenu->id }}" id="deleteSubMenuBtn"><i class="fas fa-trash-alt text-danger"></span></i>
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
      <div class="modal fade" id="addsubmenus" tabindex="-1" aria-labelledby="addMenuLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
          <div class="modal-content">
            <div class="modal-header bg-success">
              <h5 class="modal-title" id="addMenuLabel">সাবমেনু যোগ করুন</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{ route('admin.addSubMenu') }}" enctype="multipart/form-data" files="true" method="post" autocomplete="off" id="add-submenu-form">
                @csrf

                <div class="row">

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

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="menu_name">মেনুর নাম</label>
                      <select name="menu_id" id="menu_id" class="form-control">
                        @foreach ($menus as $m)
                        <option value="{{ $m->id }}">{{ $m->menu_name }}</option>
                        @endforeach
                      </select>
                      <span class="text-danger error-text menu_id_error"></span>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="submenu_name">সাবমেনুর নাম</label>
                      <input type="text" class="form-control" name="submenu_name" id="submenu_name" placeholder="সাব মেনুর নাম লিখুন">
                      <span class="text-danger error-text submenu_name_error"></span>
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="submenu_desc">বর্ণনা</label>
                      <textarea name="submenu_desc" class="summernote form-control" id="submenu_desc"></textarea>
                      <span class="text-danger error-text submenu_desc_error"></span>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="upload">আপলোড</label>
                      <input type="file" class="form-control" name="upload" id="upload">
                      <span class="text-danger error-text upload_error"></span>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="submenu_status">স্ট্যাটাস</label>
                      <select class="form-control" name="submenu_status" id="menu_status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                      </select>
                      <span class="text-danger error-text submenu_status_error"></span>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <button type="submit" class="btn btn-block btn-success">যোগ করুন</button>
                    </div>
                  </div>
                </div>
              </form>
            </div>


          </div>
        </div>
      </div>
      {{-- Modal End --}}


      {{-- Edit Modal --}}
      <div class="modal fade editSubMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
          <div class="modal-content">
            <div class="modal-header bg-info">
              <h5 class="modal-title" id="exampleModalLabel">মেনু সংশোধন করুন</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            {{-- {{ route('admin.updatecategoryDetails'); }} --}}
            <div class="modal-body">
            <form action="{{ route('admin.updateSubMenuDetails') }}" enctype="multipart/form-data" files="true" method="post" autocomplete="off" id="update-submenu-form">
                @csrf

                <input type="hidden" name="sid">
                <div class="row">

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

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="menu_name">মেনুর নাম</label>
                      <select name="menu_id" id="menu_id" class="form-control">
                        @foreach ($menus as $m)
                        <option value="{{ $m->id }}">{{ $m->menu_name }}</option>
                        @endforeach
                      </select>
                      <span class="text-danger error-text menu_id_error"></span>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="submenu_name">সাবমেনুর নাম</label>
                      <input type="text" class="form-control" name="submenu_name" id="submenu_name" placeholder="সাব মেনুর নাম লিখুন">
                      <span class="text-danger error-text submenu_name_error"></span>
                    </div>
                  </div>
                </div>


                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="submenu_desc">বর্ণনা</label>
                      <textarea name="submenu_desc" class="summernote form-control" id="submenu_desc"></textarea>
                      <span class="text-danger error-text submenu_desc_error"></span>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="upload">আপলোড</label>
                      <input type="file" class="form-control" name="upload" id="upload">
                      <span class="text-danger error-text upload_error"></span>
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="submenu_status">স্ট্যাটাস</label>
                      <select class="form-control" name="submenu_status" id="menu_status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                      </select>
                      <span class="text-danger error-text submenu_status_error"></span>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <button type="submit" class="btn btn-block btn-success">আপডেট করুন</button>
                    </div>
                  </div>
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

    $('#add-submenu-form').on('submit', function(e) {
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
            $('#addsubmenus').modal('hide');
            $('#addsubmenus').find('form')[0].reset();
            toastr.success(data.msg);

            setTimeout(function() {
              window.location.href = redirectUrl;
            }, 2000); // Adjust the delay as needed (in milliseconds)
          }
        }
      });
    });

    $(document).on('click', '#editSubMenuBtn', function() {
      var submenu_id = $(this).data('id');

      alert(submenu_id);

      $('.editSubMenu').find('form')[0].reset();
      $('.editSubMenu').find('span.error-text').text('');
      $.post("{{ route('admin.getSubMenuDetails') }}", {
        submenu_id: submenu_id
      }, function(data) {
        //alert(data.details.version_name);
        var submenuModal = $('.editSubMenu');
        $('.editSubMenu').find('input[name="sid"]').val(data.details.id);
        $('.editSubMenu').find('select[name="menu_id"]').val(data.details.menu_id);
        $('.editSubMenu').find('input[name="submenu_name"]').val(data.details.submenu_name);
        $('.editSubMenu').find('select[name="dept_id"]').val(data.details.dept_id);
        $('.editSubMenu').find('select[name="submenu_status"]').val(data.details.submenu_status);
        $('#summernote').summernote('code', data.details.submenu_desc);
        $('.editSubMenu').modal('show');
      }, 'json');
    });

    $('#update-submenu-form').on('submit', function(e) {
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
            $('.editSubMenu').modal('hide');
            $('.editSubMenu').find('form')[0].reset();
            toastr.success(data.msg);

            setTimeout(function() {
              window.location.href = redirectUrl;
            }, 2000); // Adjust the delay as needed (in milliseconds)

          }
        }
      });
    });

    //DELETE Version RECORD
    $(document).on('click', '#deleteSubMenuBtn', function() {
      var submenu_id = $(this).data('id');
      var url = '<?= route("admin.deleteSubMenu"); ?>';
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
            submenu_id: submenu_id
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