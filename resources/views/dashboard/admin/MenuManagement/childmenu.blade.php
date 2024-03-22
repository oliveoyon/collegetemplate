@extends('dashboard.admin.layouts.admin-layout')
@section('title',  'সাবমেনু ম্যানেজমেন্ট')
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
            <h1 class="m-0">চাইল্ডমেনু ম্যানেজমেন্ট</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">চাইল্ডমেনু ম্যানেজমেন্ট</a></li>
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
                          চাইল্ডমেনু তালিকা
                        </h3>
                        <div class="card-tools">
                          <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">

                              <button class="btn btn-flat btn-success" data-toggle="modal" data-target="#addchildmenus"><i class="fas fa-plus-square mr-1"></i> চাইল্ডমেনু যোগ করুন</button>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <div class="card-body table-responsive">
                          <table class="table table-hover table-condensed" id="menu-table">
                              <thead class="font-weight-bold bg-info">
                                  <th>#</th>
                                  <th>মেনুর নাম</th>
                                  <th>সাবমেনুর নাম</th>
                                  <th>চাইল্ড মেনুর নাম</th>
                                  <th>বর্ণনা</th>
                                  <th>আপলোড</th>
                                  <th>স্ট্যাটাস</th>
                                  <th>একশন <button class="btn btn-sm btn-danger d-none" id="deleteAllBtn">{{ __('language.deleteall') }}</button></th>
                              </thead>
                              <tbody>
                                @foreach ($childmenus as $childmenu)
                                <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td class="font-weight-bold">{{ $childmenu->menu_name }}</td>
                                  <td class="font-weight-bold">{{ $childmenu->submenu_name }}</td>
                                  <td class="font-weight-bold">{{ $childmenu->childmenu_name }}</td>
                                  <td>{{ strip_tags(substr($childmenu->child_menu_desc, 0, 500)) }}</td>
                                  <td>
                                    @if($childmenu->upload)
                                    <a style="font-weight:bold; color: green" href="{{ asset('storage/img/childmenu_img/' . $childmenu->upload) }}" target="_blank">
                                      <i class="fas fa-file-pdf"></i> PDF Document
                                    </a>
                                    @else
                                    <span style="font-weight:bold; color: red">সংযুক্ত নেই</span>
                                    @endif
                                  </td>
                                  <td class="{{ $childmenu->child_menu_status == 1 ? 'text-success' : 'text-danger' }} font-weight-bold">
                                    {{ $childmenu->child_menu_status == 1 ? 'একটিভ' : 'একটিভ নয়' }}
                                  </td>
                                  <td>
                                    <span data-id="{{ $childmenu->id }}" id="editChildMenuBtn"><i class="fas fa-edit text-warning"></i></span> &nbsp;
                                    <span data-id="{{ $childmenu->id }}" id="deleteChildMenuBtn"><i class="fas fa-trash-alt text-danger"></span></i>
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
  <div class="modal fade" id="addchildmenus" tabindex="-1" aria-labelledby="addMenuLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title" id="addMenuLabel">সাবমেনু যোগ করুন</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('admin.addChildMenu') }}" enctype="multipart/form-data" files="true" method="post" autocomplete="off" id="add-childmenu-form">
            @csrf

            <div class="form-group">
                <label for="menu_name">মেনুর নাম</label>
                <select name="menu_id" id="menu_id" class="form-control menu_id">
                    <option value="">dfdf</option>
                  @foreach ($menus as $m)
                      <option value="{{ $m->id }}">{{ $m->menu_name }}</option>
                  @endforeach
                </select>
                <span class="text-danger error-text menu_id_error"></span>
            </div>

            <div class="form-group">
                <label for="menu_name">সাবমেনুর নাম</label>
                <select class="form-control form-control-sm submenu_id" name="submenu_id" id="submenu_id" disabled>
                    <option value="">Select One</option>
                </select>
                <span class="text-danger error-text submenu_id_error"></span>
            </div>



            <div class="form-group">
              <label for="menu_name">চাইল্ড মেনুর নাম</label>
              <input type="text" class="form-control" name="childmenu_name" id="childmenu_name" placeholder="সাব মেনুর নাম লিখুন">
              <span class="text-danger error-text childmenu_name_error"></span>
            </div>

            <div class="form-group">
              <label for="menu_name">বর্ণনা</label>
                  <textarea name="child_menu_desc" class="summernote" id="child_menu_desc"></textarea>
                  <span class="text-danger error-text child_menu_desc_error"></span>
            </div>

            <div class="form-group">
                <label for="upload">আপলোড</label>
                <input type="file" class="form-control" name="upload" id="upload">
                <span class="text-danger error-text upload_error"></span>
            </div>

            <div class="form-group">
                <label for="status">স্ট্যাটাস</label>
                <select class="form-control" name="child_menu_status" id="menu_status">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
                <span class="text-danger error-text child_menu_status_error"></span>
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
<div class="modal fade editChildMenu" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
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
              <form action="{{ route('admin.updateChildMenuDetails') }}" enctype="multipart/form-data" files="true" method="post" autocomplete="off" id="update-childmenu-form">
                @csrf
                <input type="hidden" name="sid">

                <div class="form-group">
                <label for="menu_name">মেনুর নাম</label>
                <select name="menu_id" id="menu_id" class="form-control menu_id">
                  @foreach ($menus as $m)
                      <option value="{{ $m->id }}">{{ $m->menu_name }}</option>
                  @endforeach
                </select>
                <span class="text-danger error-text menu_id_error"></span>
            </div>

            <div class="form-group">
                <label for="menu_name">সাবমেনুর নাম</label>
                <select class="form-control form-control-sm submenu_id" name="submenu_id" id="submenu_id">
                    @foreach($submenus as $subm)
                    <option value="{{$subm->id}}">{{$subm->submenu_name}}</option>
                    @endforeach
                </select>
                <span class="text-danger error-text submenu_id_error"></span>
            </div>



            <div class="form-group">
              <label for="menu_name">চাইল্ড মেনুর নাম</label>
              <input type="text" class="form-control" name="childmenu_name" id="childmenu_name" placeholder="সাব মেনুর নাম লিখুন">
              <span class="text-danger error-text childmenu_name_error"></span>
            </div>

            <div class="form-group">
              <label for="menu_name">বর্ণনা</label>
                  <textarea name="child_menu_desc" class="summernote" id="child_menu_desc1"></textarea>
                  <span class="text-danger error-text child_menu_desc_error"></span>
            </div>

            <div class="form-group">
                <label for="upload">আপলোড</label>
                <input type="file" class="form-control" name="upload" id="upload">
                <span class="text-danger error-text upload_error"></span>
            </div>

            <div class="form-group">
                <label for="status">স্ট্যাটাস</label>
                <select class="form-control" name="child_menu_status" id="menu_status">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
                <span class="text-danger error-text child_menu_status_error"></span>
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
    headers:{
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
});


  $(document).ready(function () {

    $('.menu_id').on('change', function() {
        var menuId = $(this).val();

        // Enable the "Class" dropdown
        $('.submenu_id').prop('disabled', false).data('version-id', menuId);

        // Add the extra option to the "Class" dropdown
        $('.submenu_id').html('<option value="">-- Please select a class --</option>');

        // Make an AJAX request to fetch classes based on the selected version
        $.ajax({
            url: '{{ route('admin.getSubmenuByMenu') }}',
            method: 'POST',
            data: {
                menu_id: menuId,
                _token: '{{ csrf_token() }}'
            },
            success: function(data) {
                var classDropdown = $('.submenu_id');

                // Populate the "Class" dropdown with the fetched data
                $.each(data.submenus, function(key, value) {
                    classDropdown.append($('<option>', {
                        value: value.id,
                        text: value.submenu_name
                    }));
                });
            }
        });
    });

      $('#add-childmenu-form').on('submit', function(e){
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
                      $('#addchildmenus').modal('hide');
                      $('#addchildmenus').find('form')[0].reset();
                      toastr.success(data.msg);

                      setTimeout(function() {
                          window.location.href = redirectUrl;
                      }, 2000); // Adjust the delay as needed (in milliseconds)
                  }
            }
        });
    });

    $(document).on('click','#editChildMenuBtn', function(){
      var childmenu_id = $(this).data('id');

      $('.editChildMenu').find('form')[0].reset();
      $('.editChildMenu').find('span.error-text').text('');
      $.post("{{ route('admin.getChildMenuDetails') }}",{childmenu_id:childmenu_id}, function(data){
          //alert(data.details.version_name);
          var childmenuModal = $('.editChildMenu');
          $('.editChildMenu').find('input[name="sid"]').val(data.details.id);
          $('.editChildMenu').find('select[name="menu_id"]').val(data.details.menu_id);
          $('.editChildMenu').find('select[name="submenu_id"]').val(data.details.submenu_id);
          $('.editChildMenu').find('input[name="childmenu_name"]').val(data.details.childmenu_name);


          // $('.editChildMenu').find('textarea[name="childmenu_desc"]').val(data.details.childmenu_desc);
          $('.editChildMenu').find('select[name="child_menu_status"]').val(data.details.child_menu_status);
          $('#child_menu_desc1').summernote('code', data.details.child_menu_desc);
          $('.editChildMenu').modal('show');
      },'json');
    });

    $('#update-childmenu-form').on('submit', function(e){
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
                    $('.editChildMenu').modal('hide');
                    $('.editChildMenu').find('form')[0].reset();
                    toastr.success(data.msg);

                    setTimeout(function() {
                        window.location.href = redirectUrl;
                    }, 2000); // Adjust the delay as needed (in milliseconds)

                }
          }
      });
  });

  //DELETE Version RECORD
  $(document).on('click','#deleteChildMenuBtn', function(){
        var childmenu_id = $(this).data('id');
        var url = '<?= route("admin.deleteChildMenu"); ?>';
        swal.fire({
              title:'Are you sure?',
              html:'You want to <b>delete</b> this Child Menu',
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
                  $.post(url,{childmenu_id:childmenu_id}, function(data){
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

