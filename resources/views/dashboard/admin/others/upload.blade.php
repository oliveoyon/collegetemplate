@extends('dashboard.admin.layouts.admin-layout')
@section('title',  'আপলোড ম্যানেজমেন্ট')
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
            <h1 class="m-0">আপলোড ম্যানেজমেন্ট</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">আপলোড ম্যানেজমেন্ট</a></li>
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
                          আপলোড
                        </h3>
                        <div class="card-tools">
                          <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">

                              <button class="btn btn-flat btn-success" data-toggle="modal" data-target="#adduploads"><i class="fas fa-plus-square mr-1"></i> আপলোড করুন</button>
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
                                  <th>সংযুক্তি</th>
                                  <th>স্ট্যাটাস</th>
                                  <th>একশন <button class="btn btn-sm btn-danger d-none" id="deleteAllBtn">{{ __('language.deleteall') }}</button></th>
                              </thead>
                              <tbody>
                                @foreach ($uploads as $upload)
                                <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td>{{ $upload->faculty_department }}</td>
                                  <td class="font-weight-bold">{{ $upload->title }}</td>
                                  <td>{{ strip_tags(substr($upload->description, 0, 500)) }}</td>
                                  <td><img height="100" src="{{ asset('storage/img/mujib/'.$upload->upload) }}" alt=""></td>
                                  <td class="{{ $upload->status == 1 ? 'text-success' : 'text-danger' }} font-weight-bold">
                                    {{ $upload->status == 1 ? 'একটিভ' : 'একটিভ নয়' }}
                                  </td>
                                  <td>
                                    <span data-id="{{ $upload->id }}" id="editEventBtn"><i class="fas fa-edit text-warning"></i></span> &nbsp;
                                    <span data-id="{{ $upload->id }}" id="deleteEventBtn"><i class="fas fa-trash-alt text-danger"></span></i>
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
  <div class="modal fade" id="adduploads" tabindex="-1" aria-labelledby="addMenuLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title" id="addMenuLabel">আপলোড করুন</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('admin.addUpload') }}" enctype="multipart/form-data" files="true" method="post" autocomplete="off" id="add-upload-form">
            @csrf

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
                                                                    {{ $department->department_name }}</option>
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
                <label for="menu_name">শিরোনাম</label>
                <input type="text" class="form-control" name="title" required placeholder="শিরোনাম যোগ করুন">
                <span class="text-danger error-text title_error"></span>
            </div>

            <div class="form-group">
                <label for="menu_name">বর্ণনা</label>
                    <textarea name="description" class="summernote" id="description"></textarea>
                    <span class="text-danger error-text description_error"></span>
            </div>


            <div class="form-group">
                <label for="upload">ছবি আপলোড</label>
                <input type="file" class="form-control" name="upload" id="upload">
                <span class="text-danger error-text upload_error"></span>
            </div>

            <div class="form-group">
                <label for="status">স্ট্যাটাস</label>
                <select class="form-control" name="status" id="status">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
                <span class="text-danger error-text status_error"></span>
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
  <div class="modal fade editmujib" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">আপলোড সংশোধন করুন</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{-- {{ route('admin.updatecategoryDetails'); }} --}}
            <div class="modal-body">
              <form action="{{ route('admin.updateUploadDetails') }}" enctype="multipart/form-data" files="true" method="post" autocomplete="off" id="update-upload-form">
                @csrf
                <input type="hidden" name="nid">
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
                                                                    {{ $department->department_name }}</option>
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
                  <label for="menu_name">শিরোনাম</label>
                  <input type="text" class="form-control" name="title" required placeholder="শিরোনাম যোগ করুন">
                  <span class="text-danger error-text title_error"></span>
              </div>

              <div class="form-group">
                  <label for="menu_name">বর্ণনা</label>
                      <textarea name="description" class="summernote" id="description1"></textarea>
                      <span class="text-danger error-text description_error"></span>
              </div>


              <div class="form-group">
                  <label for="upload">ছবি আপলোড</label>
                  <input type="file" class="form-control" name="upload" id="upload">
                  <span class="text-danger error-text upload_error"></span>
              </div>

              <div class="form-group">
                  <label for="status">স্ট্যাটাস</label>
                  <select class="form-control" name="status" id="status">
                      <option value="1">Active</option>
                      <option value="0">Inactive</option>
                  </select>
                  <span class="text-danger error-text status_error"></span>
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
    headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
});


  $(document).ready(function () {
    // Image preview
    $("#upload").change(function () {
        readURL(this);
    });

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $("#image_preview").html('<img src="' + e.target.result + '" alt="Image Preview" style="max-width: 100px; max-height: 100px;">');
            };

            reader.readAsDataURL(input.files[0]);
        }
    }


      $('#add-upload-form').on('submit', function(e){
        e.preventDefault();
        var form = this;
        $.ajax({
            url:$(form).attr('action'),
            method:$(form).attr('method'),
            data:new FormData(form),
            processData:false,
            dataType:'json',
            contentType:false,
            beforeSend:function(){
                  $(form).find('span.error-text').text('');
            },
            success:function(data){
                  if(data.code == 0){
                        $.each(data.error, function(prefix, val){
                            $(form).find('span.'+prefix+'_error').text(val[0]);
                        });
                  }else{
                      var redirectUrl = data.redirect;
                      // $('#brand-table').DataTable().ajax.reload(null, false);
                      $('#adduploads').modal('hide');
                      $('#adduploads').find('form')[0].reset();
                      toastr.success(data.msg);

                      setTimeout(function() {
                          window.location.href = redirectUrl;
                      }, 2000); // Adjust the delay as needed (in milliseconds)
                  }
            }
        });
    });

    $(document).on('click','#editEventBtn', function(){
      var upload_id = $(this).data('id');

      $('.editmujib').find('form')[0].reset();
      $('.editmujib').find('span.error-text').text('');
      $.post("{{ route('admin.getUploadDetails') }}",{upload_id:upload_id}, function(data){
          //alert(data.details.version_name);
          var mujibModal = $('.editmujib');
          $('.editmujib').find('input[name="nid"]').val(data.details.id);
          $('.editmujib').find('input[name="title"]').val(data.details.title);
          $('#description1').summernote('code', data.details.description);
          $('.editmujib').find('select[name="dept_id"]').val(data.details.dept_id);
          $('.editmujib').find('select[name="status"]').val(data.details.status);
          $('.editmujib').modal('show');
      },'json');
    });

    $('#update-upload-form').on('submit', function(e){
      e.preventDefault();
      var form = this;
      $.ajax({
          url:$(form).attr('action'),
          method:$(form).attr('method'),
          data:new FormData(form),
          processData:false,
          dataType:'json',
          contentType:false,
          beforeSend: function(){
                $(form).find('span.error-text').text('');
          },
          success: function(data){
                if(data.code == 0){
                    $.each(data.error, function(prefix, val){
                        $(form).find('span.'+prefix+'_error').text(val[0]);
                    });
                }else{
                    // $('#category-table').DataTable().ajax.reload(null, false);
                    var redirectUrl = data.redirect;
                    $('.editmujib').modal('hide');
                    $('.editmujib').find('form')[0].reset();
                    toastr.success(data.msg);

                    setTimeout(function() {
                        window.location.href = redirectUrl;
                    }, 2000); // Adjust the delay as needed (in milliseconds)

                }
          }
      });
  });

  //DELETE Version RECORD
  $(document).on('click','#deleteEventBtn', function(){
      var upload_id = $(this).data('id');
      var url = '<?= route("admin.deleteUpload"); ?>';
      swal.fire({
            title:'Are you sure?',
            html:'You want to <b>delete</b> this upload',
            showCancelButton:true,
            showCloseButton:true,
            cancelButtonText:'Cancel',
            confirmButtonText:'Yes, Delete',
            cancelButtonColor:'#d33',
            confirmButtonColor:'#556ee6',
            width:300,
            allowOutsideClick:false
      }).then(function(result){
            if(result.value){
                $.post(url,{upload_id:upload_id}, function(data){
                      if(data.code == 1){
                          var redirectUrl = data.redirect;
                          toastr.success(data.msg);
                          setTimeout(function() {
                              window.location.href = redirectUrl;
                          }, 1000); // Adjust the delay as needed (in milliseconds)

                      }else{
                          toastr.error(data.msg);
                      }
                },'json');
            }
      });
  });

});

</script>



@endpush

