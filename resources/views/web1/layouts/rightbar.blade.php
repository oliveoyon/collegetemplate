@if ($webmessages)
    @foreach ($webmessages as $webmsg)
    <div class="message-box">
        <div class="msg-header">
            <p>{{ $webmsg->message_type }}</p>
        </div>
        <div class="img-msgbox"> 
            <center>
                <img src="{{ asset('storage/img/message_img/'.$webmsg->upload) }}" class="message-img image-fluid img-thumbnail" alt="Principal's Image">
                <p>{{ $webmsg->name }}</p>
                <a href="{{ url('message/'.$webmsg->message_slug) }}" class="btn btn-block btn-success"><span style="color:white;">বিস্তারিত</span></a>
            </center>
        </div>
    </div>
    @endforeach
@endif



<div class="message-box">
    <div class="msg-header">
        <p>গুরুত্বপূর্ণ লিঙ্ক</p>
    </div>
    <div class="feature">
        @foreach($important_links as $link)
        <a href="{{ $link->link }}" target="_blank"><li><i class="fa fa-caret-right"></i>&nbsp;&nbsp;{{ $link->link_name }}</li></a>
        @endforeach
    </div>
</div>