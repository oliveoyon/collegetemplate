@extends('dashboard.admin.layouts.admin-layout')
@section('title',  'স্লাইডার ম্যানেজমেন্ট')
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
            <h1 class="m-0">স্লাইডার ম্যানেজমেন্ট</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">স্লাইডার ম্যানেজমেন্ট</a></li>
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
                          স্লাইডার তালিকা
                        </h3>
                        <div class="card-tools">
                          <ul class="nav nav-pills ml-auto">
                            <li class="nav-item">
                                
                              <button class="btn btn-flat btn-success" data-toggle="modal" data-target="#addsliders"><i class="fas fa-plus-square mr-1"></i> স্লাইডার যোগ করুন</button>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <div class="card-body table-responsive">
                          <table class="table table-hover table-condensed" id="menu-table">
                              <thead class="font-weight-bold bg-info">
                                  <th>#</th>
                                  <th>স্লাইডারের ছবি</th>
                                  <th>স্ট্যাটাস</th>
                                  <th>একশন <button class="btn btn-sm btn-danger d-none" id="deleteAllBtn">{{ __('language.deleteall') }}</button></th>
                              </thead>
                              <tbody>
                                @foreach ($sliders as $slider)
                                <tr>
                                  <td>{{ $loop->iteration }}</td>
                                  <td><img height="50" src="{{ asset('storage/img/slider/'.$slider->upload) }}" alt=""></td>
                                  
                                  <td class="{{ $slider->slider_status == 1 ? 'text-success' : 'text-danger' }} font-weight-bold">
                                    {{ $slider->slider_status == 1 ? 'একটিভ' : 'একটিভ নয়' }}
                                  </td>
                                  <td>
                                    <span data-id="{{ $slider->id }}" id="deleteSliderBtn"><i class="fas fa-trash-alt text-danger"></span></i>
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
  <div class="modal fade" id="addsliders" tabindex="-1" aria-labelledby="addMenuLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header bg-success">
          <h5 class="modal-title" id="addMenuLabel">স্লাইডার যোগ করুন</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form action="{{ route('admin.addSlider') }}" enctype="multipart/form-data" files="true" method="post" autocomplete="off" id="add-slider-form">
            @csrf
        
        
            <div class="form-group">
                <label for="upload">ছবি আপলোড</label>
                <input type="file" class="form-control" name="upload" id="upload">
                <span class="text-danger error-text upload_error"></span>
            </div>
        
            <div class="form-group">
                <label for="status">স্ট্যাটাস</label>
                <select class="form-control" name="slider_status" id="slider_status">
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
                <span class="text-danger error-text slider_status_error"></span>
            </div>
        
                    
            <div class="form-group">
                <label for="image_preview">Image Preview</label>
                <div class="img-holder" id="image_preview"></div>
            </div>
        
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-success">স্লাইডার যোগ করুন</button>
            </div>
        </form>

        
        </div>
        
      </div>
    </div>
  </div>
  {{-- Modal End --}}

  









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

    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $("#image_preview").html('<img src="' + e.target.result + '" alt="Image Preview" style="max-width: 100px; max-height: 100px;">');
            };

            reader.readAsDataURL(input.files[0]);
        }
    }

    
      $('#add-slider-form').on('submit', function(e){
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
                      $('#addsliders').modal('hide');
                      $('#addsliders').find('form')[0].reset();
                      toastr.success(data.msg);

                      setTimeout(function() {
                          window.location.href = redirectUrl;
                      }, 2000); // Adjust the delay as needed (in milliseconds)
                  }
            }
        });
    });

    
   
  //DELETE Version RECORD
  $(document).on('click','#deleteSliderBtn', function(){
      var slider_id = $(this).data('id');
      var url = '<?= route("admin.deleteSlider"); ?>';
      swal.fire({
            title:'Are you sure?',
            html:'You want to <b>delete</b> this Slider',
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
                $.post(url,{slider_id:slider_id}, function(data){
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

