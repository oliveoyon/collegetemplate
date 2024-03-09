<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Admin\Events;
use App\Models\Admin\Menu;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class WebController extends Controller
{
    public function index()
    {
        $send['histories'] = DB::table('histories')->first();
        $send['messages'] = DB::table('messages')->orderByDesc('created_at')->first();
        $send['uploads'] = DB::table('uploads')->where(['status' => 1])
        ->orderByDesc('created_at')
        ->limit(6) // Replace '5' with your desired limit
        ->get();
        $send['sliders'] = DB::table('sliders')->where(['slider_status' => 1])
        ->limit(3) // Replace '5' with your desired limit
        ->get();

        $events = Events::where('event_status', 1)
        // ->whereDate('start_date', '>=', now())
        ->select('event_title', 'start_date', 'end_date', 'url')
        ->get()
        ->map(function ($event) {
            return [
                'title' => $event->event_title,
                'start' => Carbon::parse($event->start_date)->toDateTimeString(),
                'end' => Carbon::parse($event->end_date)->toDateTimeString(),
                'url' => 'notice/'.$event->url,
            ];
        });

        $send['eventsJson'] = $events->toJson();



        return view('web.webhome' , $send);
    }

    public function notice($slug=null)
    {
        $send['events'] = DB::table('events')->where(['event_status' => 1,  'url'=>$slug])->first();
        return view('web.notice_detail', $send);
    }

    public function menudesc($slug=null)
    {
        $send['menudesc'] = DB::table('sub_menus')
            ->select('submenu_name', 'submenu_slug', 'submenu_desc', 'upload')
            ->where(['submenu_status' => 1, 'submenu_slug' => $slug])
            ->first();
        return view('web.menudesc', $send);
    }

    public function allnotice($slug = Null)
    {
        if ($slug == 'all-notice') {
            $eventType = 1;
        } elseif ($slug == 'all-event') {
            $eventType = 2;
        } elseif ($slug == 'all-advertisement') {
            $eventType = 3;
        } else {
            $eventType = 4;
        }

        $send['notices'] = DB::table('events')
        ->where(['event_type' => $eventType])
        ->where(['event_status' => 1])
        ->orderByDesc('start_date')
        // ->limit(6) // Replace '5' with your desired limit
        ->get();
        return view('web.allnotice' , $send);
    }

    public function history_details()
    {
        $send['histories'] = DB::table('histories')->first();
        return view('web.historydetails', $send);
    }

    public function mujib_corner()
    {
        $send['mujibs'] = DB::table('mujib_corners')->where('status', 1)->get();
        return view('web.mujib-corner', $send);
    }

    public function mujib_detail($slug=null)
    {
        $send['mujibdet'] = DB::table('mujib_corners')->where(['status' => 1, 'url'=>$slug])->first();
        return view('web.mujibdets', $send);
    }

    public function message($slug=null)
    {
        $send['msgs'] = DB::table('messages')->where(['message_status' => 1, 'message_slug'=>$slug])->first();
        return view('web.msgs', $send);
    }

    public function alldownload()
    {
        $send['uploads'] = DB::table('uploads')->where(['status' => 1])
        ->orderByDesc('created_at')
        ->get();
        return view('web.alldownload' , $send);
    }

    public function download($slug=null)
    {
        $send['upload'] = DB::table('uploads')->where(['status' => 1, 'url'=>$slug])->first();
        return view('web.download', $send);
    }

    public function contact()
    {
        return view('web.contact');
    }


}
