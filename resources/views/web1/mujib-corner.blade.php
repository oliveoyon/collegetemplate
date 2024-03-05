@extends('web.layouts.web-layouts')

@section('webcontent')

    <!-- Content Row for 8-4 column content -->
    <div class="mt-4">
      <div class="row">
          <!-- 8-column content -->
            <div class="col-md-9">
                <div class="row">
                    @foreach ($mujibs as $mujib)
                    <div class="col-md-4">
                        <div class="image-box">
                            <img class="hover-zoom" src="{{ asset('storage/img/mujib/'.$mujib->upload) }}" alt="{{ $mujib->title }}">
                            <h4><a href="{{ url('mujib-corner-detail/'.$mujib->url) }}" class="title-link">{{ $mujib->title }}</a></h4>
                        </div>
                    </div>
                    @endforeach
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



