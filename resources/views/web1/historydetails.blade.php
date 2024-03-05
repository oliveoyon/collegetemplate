@extends('web.layouts.web-layouts')

@section('webcontent')

    <!-- Content Row for 8-4 column content -->
    <div class="mt-4">
      <div class="row">
          <!-- 8-column content -->
            <div class="col-md-9">
                <div class="message-box">
                    <div class="msg-header">
                        <p>প্রতিষ্ঠানের ইতিহাস</p>
                    </div>
                    <div class="card-body" style="background-color: white;">
                        <!-- Notice List -->
                        
                        {!! $histories->history !!}
                        
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



