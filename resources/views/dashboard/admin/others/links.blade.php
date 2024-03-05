@extends('dashboard.admin.layouts.admin-layout')
@section('title',  'গুরুত্বপূর্ণ লিঙ্ক')
@push('admincss')
<!-- DataTables -->
<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
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
            <h1 class="m-0">গুরুত্বপূর্ণ লিঙ্ক</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">গুরুত্বপূর্ণ লিঙ্ক</a></li>
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
                          লিঙ্কের তালিকা
                        </h3>
                        <div class="card-tools">
                          <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                                
                              <button class="btn btn-flat btn-success" data-toggle="modal" data-target="#addlinks"><i class="fas fa-plus-square mr-1"></i> লিঙ্ক যোগ করুন</button>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <div class="card-body table-responsive">
                          <table class="table table-hover table-condensed" id="menu-table">
                              <thead class="font-weight-bold bg-info">
                                  <th>#</th>
                                  <th>লিঙ্কের নাম</th>
                                  <th>লিঙ্ক</th>
                                  <th>একশন <button class="btn btn-sm btn-danger d-none" id="deleteAllBtn">{{ __('language.deleteall') }}</button></th>
                              </thead>
                              <tbody>
                                @foreach ($links as $link)
                                <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td class="font-weight-bold">{{ $link->link_name }}</td>
                                  <td class="font-weight-bold">{{ $link->link }}</td>
                                  <td>
                                    <span data-id="{{ $link->id }}" id="editLinkBtn"><i class="fas fa-edit text-warning"></i></span> &nbsp;
                                    <span data-id="{{ $link->id }}" id="deleteLinkBtn"><i class="fas fa-trash-alt text-danger"></span></i>
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
  <div class="modal fade" id="addlinks" tabindex="-1" aria-labelledby="addLinkLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title" id="addLinkLabel">লিঙ্ক যোগ করুন</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('admin.addLink') }}" enctype="multipart/form-data" files="true" method="post" autocomplete="off" id="add-link-form">
            @csrf
        
            <div class="form-group">
                <label for="link_name">লিঙ্কের নাম</label>
                <input type="text" class="form-control" name="link_name" id="link_name" placeholder="লিঙ্কের নাম লিখুন">
                <span class="text-danger error-text link_name_error"></span>
            </div>
        
            <div class="form-group">
                <label for="link">লিঙ্ক</label>
                <input type="text" class="form-control" name="link" id="link" placeholder="লিঙ্কটি প্রদান করুন">
                <span class="text-danger error-text link_error"></span>
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
  <div class="modal fade editLink" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-keyboard="false" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">মেনু সংশোধন করুন</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            {{-- {{ route('admin.updatecategoryDetails'); }} --}}
            <div class="modal-body">
              <form action="{{ route('admin.updateLinkDetails') }}" enctype="multipart/form-data" files="true" method="post" autocomplete="off" id="update-link-form">
                @csrf
                <input type="hidden" name="lid">
                <div class="form-group">
                  <label for="link_name">লিঙ্কের নাম</label>
                  <input type="text" class="form-control" name="link_name" id="link_name" placeholder="লিঙ্কের নাম লিখুন">
                  <span class="text-danger error-text link_name_error"></span>
              </div>
          
              <div class="form-group">
                  <label for="link">লিঙ্ক</label>
                  <input type="text" class="form-control" name="link" id="link" placeholder="লিঙ্কটি প্রদান করুন">
                  <span class="text-danger error-text link_error"></span>
              </div>
            
                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-success">যোগ করুন</button>
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

    
    
      $('#add-link-form').on('submit', function(e){
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
                      $('#addlinks').modal('hide');
                      $('#addlinks').find('form')[0].reset();
                      toastr.success(data.msg);

                      setTimeout(function() {
                          window.location.href = redirectUrl;
                      }, 2000); // Adjust the delay as needed (in milliseconds)
                  }
            }
        });
    });

    $(document).on('click','#editLinkBtn', function(){
      var link_id = $(this).data('id');
      
      $('.editLink').find('form')[0].reset();
      $('.editLink').find('span.error-text').text('');
      $.post("{{ route('admin.getLinkDetails') }}",{link_id:link_id}, function(data){
          //alert(data.details.version_name);
          var linkModal = $('.editLink');
          $('.editLink').find('input[name="lid"]').val(data.details.id);
          $('.editLink').find('input[name="link_name"]').val(data.details.link_name);
          $('.editLink').find('input[name="link"]').val(data.details.link);
          
          $('.editLink').modal('show');
      },'json');
    });

    $('#update-link-form').on('submit', function(e){
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
                    $('.editLink').modal('hide');
                    $('.editLink').find('form')[0].reset();
                    toastr.success(data.msg);
                    
                    setTimeout(function() {
                        window.location.href = redirectUrl;
                    }, 2000); // Adjust the delay as needed (in milliseconds)
                    
                }
          }
      });
  });

  //DELETE Version RECORD
  $(document).on('click','#deleteLinkBtn', function(){
      var link_id = $(this).data('id');
      var url = '<?= route("admin.deleteLink"); ?>';
      swal.fire({
            title:'Are you sure?',
            html:'You want to <b>delete</b> this Link',
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
                $.post(url,{link_id:link_id}, function(data){
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

