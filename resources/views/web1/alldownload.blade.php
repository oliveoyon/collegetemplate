@extends('web.layouts.web-layouts')

@section('webcontent')

    <!-- Content Row for 8-4 column content -->
    <div class="mt-4">
      <div class="row">
          <!-- 8-column content -->
            <div class="col-md-9">
                <div class="notice-box">
                    <div class="notice-header">
                        <p>সকল ডাউনলোড</p>
                    </div>
                    <div class="card-body" style="background-color: white">
                        <table class="table table-striped">
                            <tr>
                              <th>নং</th>
                              <th>শিরোনাম</th>
                              <th>বর্ণনা</th>
                              <th>তারিখ</th>
                              <th>একশন</th>
                            </tr>
                            @foreach ($uploads as $upload)
                            <tr>
                              <td>{{ $loop->iteration }}</td>
                              <td>{{ $upload->title }}</td>
                              <td>{!! Str::substr($upload->description, 0, 100) !!}</td>
                              <td>{{ date('M j, Y', strtotime($upload->created_at)); }}</td>
                              <td><a href="{{ url('download/'.$upload->url) }}" class="btn btn-sm btn-success">বিস্তারিত</a></td>
                            </tr>
                            @endforeach
                          </table>
                        
                        
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



