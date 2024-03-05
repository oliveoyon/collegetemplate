@extends('web.layouts.web-layouts')

@section('webcontent')

    <!-- Content Row for 8-4 column content -->
    <div class="mt-4">
      <div class="row">
          <!-- 8-column content -->
            <div class="col-md-9">
                <div class="message-box">
                    <div class="msg-header">
                        <p>{{ $menudesc->submenu_name }}</p>
                    </div>
                    <div class="card-body" style="background-color: white;">
                        <!-- Notice List -->
                        
                        <p>{!! $menudesc->submenu_desc !!}</p>
                        
                        @if ($menudesc->upload)
                            @if (pathinfo($menudesc->upload, PATHINFO_EXTENSION) === 'pdf')
                                <object data="{{ asset('storage/img/submenu_img/' . $menudesc->upload) }}" type="application/pdf" width="100%" height="800">
                                    <p>Unable to display PDF file. <a href="{{ asset('storage/img/submenu_img/' . $menudesc->upload) }}">Download</a> instead.</p>
                                </object>
                            @else
                                <img class="img-thumbnail mt-4" src="{{ asset('storage/img/submenu_img/' . $menudesc->upload) }}" alt="Image" style="max-width: 100%; height: auto;">
                            @endif
                        @endif

                        
                    </div>
                </div>
            </div>
            <!-- Right Side Bar -->
            <div class="col-md-3">
                @include('web.layouts.rightbar')
            </div>
            
            {{-- End Right Side bar --}}
          
          
          
    </div>


      
  </div>
  
@endsection



