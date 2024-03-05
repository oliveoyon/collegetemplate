@extends('web.layouts.web-layouts')

@section('webcontent')

    <!-- Content Row for 8-4 column content -->
    <div class="mt-4">
      <div class="row">
          <!-- 8-column content -->
            <div class="col-md-9">
                <div class="message-box">
                    <div class="msg-header">
                        <p>মুজিব কর্ণার</p>
                    </div>
                    <div class="card-body" style="background-color: white;">
                        <!-- Notice List -->
                        <img src="{{ asset('storage/img/mujib/'.$mujibdet->upload) }}" alt="{{ $mujibdet->title }}" class="img-fluid">
                        <h2 class="notice_title mt-4">{{ $mujibdet->title }}</h2>
                        <p class="mt-4 mb-4">{!! $mujibdet->description !!}</p>
                        
                        
                        
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



