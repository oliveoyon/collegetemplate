@extends('web.layouts.web-layouts')

@section('webcontent')

    <!-- Content Row for 8-4 column content -->
    <div class="mt-4">
      <div class="row">
          <!-- 8-column content -->
            <div class="col-md-9">
                <div class="message-box">
                    <div class="msg-header">
                        <p>{{ $msgs->message_type }}</p>
                    </div>
                    <div class="card-body" style="background-color: white;">
                        <!-- Notice List -->
                        <center>
                            <img class="img-thumbnail mt-2" src="{{ asset('storage/img/message_img/' . $msgs->upload) }}" alt="Image" style="max-width: 100%; height: auto;">
                            <h2 class="notice_title pt-4">{{ $msgs->name }}</h2>
                        </center>
                        
                        <p class="mt-4 mb-4">{!! $msgs->message_desc !!}</p>
                       
                        
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



