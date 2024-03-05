@extends('dashboard.admin.layouts.admin-layout')
@section('title',  'বাণী ম্যানেজমেন্ট')
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
                                
                              <button class="btn btn-flat btn-success" data-toggle="modal" data-target="#addmessages"><i class="fas fa-plus-square mr-1"></i> বাণী যোগ করুন</button>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <div class="card-body table-responsive">
                          <table class="table table-hover table-condensed" id="menu-table">
                              <thead class="font-weight-bold bg-info">
                                  <th>#</th>
                                  <th>বাণীর টাইপ</th>
                                  <th>নাম</th>
                                  <th>বর্ণনা</th>
                                  <th>আপলোড</th>
                                  <th>স্ট্যাটাস</th>
                                  <th>একশন <button class="btn btn-sm btn-danger d-none" id="deleteAllBtn">{{ __('language.deleteall') }}</button></th>
                              </thead>
                              <tbody>
                                @foreach ($messages as $message)
                                <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td class="font-weight-bold">{{ $message->message_type }}</td>
                                  <td class="font-weight-bold">{{ $message->name }}</td>
                                  <td>{{ strip_tags(substr($message->message_desc, 0, 500)) }}</td>
                                  <td>
                                    <img height="50" src="{{ asset('storage/img/message_img/'.$message->upload) }}" alt="">
                                  </td>
                                  <td class="{{ $message->message_status == 1 ? 'text-success' : 'text-danger' }} font-weight-bold">
                                    {{ $message->message_status == 1 ? 'একটিভ' : 'একটিভ নয়' }}
                                  </td>
                                  <td>
                                    <span data-id="{{ $message->id }}" id="editMessageBtn"><i class="fas fa-edit text-warning"></i></span> &nbsp;
                                    <span data-id="{{ $message->id }}" id="deleteMessageBtn"><i class="fas fa-trash-alt text-danger"></span></i>
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
  <div class="modal fade" id="addmessages" tabindex="-1" aria-labelledby="addMenuLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title" id="addMenuLabel">বাণী যোগ করুন</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('admin.addMessage') }}" enctype="multipart/form-data" files="true" method="post" autocomplete="off" id="add-message-form">
            @csrf
        
            <div class="form-group">
              <label for="message_type">পদবী</label>
              <input type="text" class="form-control" name="message_type" id="message_type" placeholder="পদবী">
              <span class="text-danger error-text message_type_error"></span>
            </div>

            <div class="form-group">
              <label for="name">নাম</label>
              <input type="text" class="form-control" name="name" id="name" placeholder="নাম">
              <span class="text-danger error-text name_error"></span>
            </div>

            <div class="form-group">
              <label for="message_type">বর্ণনা</label>
                  <textarea name="message_desc" class="summernote" id="message_desc"></textarea>
                  <span class="text-danger error-text message_desc_error"></span>
            </div>
        
            <div class="form-group">
                <label for="upload">আপলোড</label>
                <input type="file" class="form-control" name="upload" id="upload">
                <span class="text-danger error-text upload_error"></span>
            </div>
        
            <div class="form-group">
                <label for="status">স্ট্যাটাস</label>
                <select class="form-control" name="message_status" id="menu_status">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
                <span class="text-danger error-text message_status_error"></span>
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
  <div class="modal fade editMessage" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title" id="exampleModalLabel">বাণী সংশোধন করুন</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
              <form action="{{ route('admin.updateMessageDetails') }}" enctype="multipart/form-data" files="true" method="post" autocomplete="off" id="update-message-form">
                @csrf
                <input type="hidden" name="sid">
                
                <div class="form-group">
                  <label for="message_type">পদবী</label>
                  <input type="text" class="form-control" name="message_type" id="message_type" placeholder="পদবী">
                  <span class="text-danger error-text message_type_error"></span>
                </div>
    
                <div class="form-group">
                  <label for="name">নাম</label>
                  <input type="text" class="form-control" name="name" id="name" placeholder="নাম">
                  <span class="text-danger error-text name_error"></span>
                </div>
    
                <div class="form-group">
                  <label for="message_desc">বর্ণনা</label>
                      <textarea name="message_desc" class="summernote" id="summernote"></textarea>
                      <span class="text-danger error-text message_desc_error"></span>
                </div>
            
                <div class="form-group">
                    <label for="upload">আপলোড</label>
                    <input type="file" class="form-control" name="upload" id="upload">
                    <span class="text-danger error-text upload_error"></span>
                </div>
            
                <div class="form-group">
                    <label for="status">স্ট্যাটাস</label>
                    <select class="form-control" name="message_status" id="menu_status">
                        <option value="1">Active</option>
                        <option value="0">Inactive</option>
                    </select>
                    <span class="text-danger error-text message_status_error"></span>
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
            
      $('#add-message-form').on('submit', function(e){
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
                      $('#addmessages').modal('hide');
                      $('#addmessages').find('form')[0].reset();
                      toastr.success(data.msg);

                      setTimeout(function() {
                          window.location.href = redirectUrl;
                      }, 2000); // Adjust the delay as needed (in milliseconds)
                  }
            }
        });
    });

    $(document).on('click','#editMessageBtn', function(){
      var message_id = $(this).data('id');
      
      $('.editMessage').find('form')[0].reset();
      $('.editMessage').find('span.error-text').text('');
      $.post("{{ route('admin.getMessageDetails') }}",{message_id:message_id}, function(data){
          //alert(data.details.version_name);
          var messageModal = $('.editMessage');
          $('.editMessage').find('input[name="sid"]').val(data.details.id);
          $('.editMessage').find('input[name="message_type"]').val(data.details.message_type);
          $('.editMessage').find('input[name="name"]').val(data.details.name);
          $('.editMessage').find('select[name="message_status"]').val(data.details.message_status);
          $('#summernote').summernote('code', data.details.message_desc);
          $('.editMessage').modal('show');
      },'json');
    });

    $('#update-message-form').on('submit', function(e){
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
                    $('.editMessage').modal('hide');
                    $('.editMessage').find('form')[0].reset();
                    toastr.success(data.msg);
                    
                    setTimeout(function() {
                        window.location.href = redirectUrl;
                    }, 2000); // Adjust the delay as needed (in milliseconds)
                    
                }
          }
      });
  });

  //DELETE Version RECORD
  $(document).on('click','#deleteMessageBtn', function(){
      var message_id = $(this).data('id');
      var url = '<?= route("admin.deleteMessage"); ?>';
      swal.fire({
            title:'Are you sure?',
            html:'You want to <b>delete</b> this Sub Menu',
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
                $.post(url,{message_id:message_id}, function(data){
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

