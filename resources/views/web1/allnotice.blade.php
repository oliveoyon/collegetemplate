@extends('web.layouts.web-layouts')

@section('webcontent')

    <!-- Content Row for 8-4 column content -->
    <div class="mt-4">
      <div class="row">
          <!-- 8-column content -->
            <div class="col-md-9">
                <div class="notice-box">
                    <div class="notice-header">
                        <p>নোটিশ বোর্ড</p>
                    </div>
                    <div class="card-body" style="background-color: white">
                        <!-- Notice List -->
                        
                        <ul class="notice-list">
                          @foreach($notices as $notice)
                          <li class="notice-list-item">
                            <a href="{{ url('notice/'.$notice->url) }}" class="notice-link">
                                <i class="fa fa-caret-right"></i>&nbsp; {{ $notice->event_title }} 
                                <small class="notice-date text-right"><i class="far fa-calendar-alt calendar-icon"></i> {{ date('F j, Y', strtotime($notice->start_date)); }}</small> <!-- Date in Small Tag -->
                            </a>
                          </li>
                          @endforeach
                        </ul>

                        
                        
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



