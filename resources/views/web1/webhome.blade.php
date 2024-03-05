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
                  <div class="card-body">
                      <!-- Notice List -->
                      
                      <ul class="notice-list">
                        @foreach($ntcs as $ntc)
                        <li class="notice-list-item">
                          <a href="{{ url('notice/'.$ntc->url) }}" class="notice-link">
                              <i class="fa fa-caret-right"></i>&nbsp; {{ $ntc->event_title }} 
                              <small class="notice-date text-right"><i class="far fa-calendar-alt calendar-icon"></i> {{ date('F j, Y', strtotime($ntc->start_date)); }}</small> <!-- Date in Small Tag -->
                          </a>
                        </li>
                        @endforeach
                      </ul>
                      <div class="show-all-notices">
                          <a href="{{ route('allnotice') }}" class="btn btn-success show-all-button">সকল নোটিশ</a>
                      </div>
                      
                  </div>
              </div>

              <div class="message-box">
                  <div class="msg-header">
                      <p>প্রতিষ্ঠানের ইতিহাস</p>
                  </div>
                  <div class="card-body" style="background-color: white;">
                      {!! Str::substr($histories->history, 0, 600) !!}
                      <div class="show-all-notices mt-4">
                          <a href="{{ route('history-details') }}" class="btn btn-success show-all-button">বিস্তারিত পড়ুন</a>
                      </div>
                      
                  </div>
              </div>

              <div class="message-box">
                <a href="{{ route('mujib-corner') }}"><img class="image-responsive img-fluid" src="{{ asset('web/img/mujib-corner.jpg') }}" alt="মুজিব কর্ণার"></a>
              </div>

              <div class="notice-box">
                <div class="notice-header">
                    <p>ডাউনলোড</p>
                </div>
                <div class="card-body">
                    <!-- Notice List -->
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
                    
                    </ul>
                    <div class="show-all-notices">
                        <a href="{{ route('alldownload') }}" class="btn btn-success show-all-button">সকল ডাউনলোড</a>
                    </div>
                    
                </div>
            </div>

                <div class="row">
                  @foreach($menusWithSubMenus as $menu)
                  @if($menu->is_home == 1)
                    <div class="col-sm-6 col-12 ">
                      <div class="col-sm-12 col-12 pt-3 pb-2" id="cart" data-aos="fade-in" data-aos-duration="1000" >
                        <p class="session" style="font-weight: bold">&nbsp;&nbsp;{{ $menu->menu_name }}</p>
                        <div class="row">
                          <div class="col-sm-3 col-3"> 
                            <img width="200" src="{{ asset('storage/img/menu_img/'.$menu->upload) }}" class="img-fluid" >         
                          </div>
                  
                          <div class="col-sm-9 col-9 p-0">
                            <ul class="menus">
                              @foreach($menu->subMenus as $subMenu)
                                  <li><i class="fa fa-caret-right"></i><a href="{{ $subMenu->submenu_slug }}">{{ $subMenu->submenu_name }}</a></li>
                              @endforeach
                            </ul>              
                          </div>            
                        </div>        
                      </div>  
                    </div>
                  @endif    
                  @endforeach
                </div>
          


              

              <div class="message-box mt-4">
                <div class="msg-header">
                    <p>প্রতিষ্ঠানের ম্যাপ</p>
                </div>
                <div class="card-body" style="background-color: white;">
                  {!! $webs->fax !!}
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



