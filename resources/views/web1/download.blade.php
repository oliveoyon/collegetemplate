@extends('web.layouts.web-layouts')

@section('webcontent')

    <!-- Content Row for 8-4 column content -->
    <div class="mt-4">
      <div class="row">
          <!-- 8-column content -->
            <div class="col-md-9">
                <div class="message-box">
                    <div class="msg-header">
                        <p>ডাউনলোড</p>
                    </div>
                    <div class="card-body" style="background-color: white;">
                        <!-- Notice List -->
                        <h2 class="notice_title">{{ $upload->title }}</h2>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <small class="notice-date">
                                    <i class="far fa-calendar-alt calendar-icon"></i> {{ date('F j, Y', strtotime($upload->created_at)) }}
                                </small>
                            </div>
                            <div>
                                <a href="{{ asset('storage/img/upload/' . $upload->upload) }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-download"></i> Download
                                </a>
                            </div>
                        </div>
                        
                        
                        <p class="mt-4 mb-4">{!! $upload->description !!}</p>
                        
                        @if ($upload->upload)
                            @if (pathinfo($upload->upload, PATHINFO_EXTENSION) === 'pdf')
                                <object data="{{ asset('storage/img/upload/' . $upload->upload) }}" type="application/pdf" width="100%" height="800">
                                    <p>Unable to display PDF file. <a href="{{ asset('storage/img/upload/' . $upload->upload) }}">Download</a> instead.</p>
                                </object>
                            @else
                                <img class="img-thumbnail mt-2" src="{{ asset('storage/img/upload/' . $upload->upload) }}" alt="Image" style="max-width: 100%; height: auto;">
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



