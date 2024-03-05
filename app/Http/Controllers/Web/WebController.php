<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Admin\Menu;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\DB;

class WebController extends Controller
{
    public function index()
    {


        $send['histories'] = DB::table('histories')->first();
        $send['uploads'] = DB::table('uploads')->where(['status' => 1])
        ->orderByDesc('created_at')
        ->limit(6) // Replace '5' with your desired limit
        ->get();
        return view('web.webhome' , $send);
    }

    public function notice($slug=null)
    {
        $send['events'] = DB::table('events')->where(['event_status' => 1, 'event_type' => 2, 'url'=>$slug])->first();
        return view('web.notice', $send);
    }

    public function menudesc($slug=null)
    {
        $send['menudesc'] = DB::table('sub_menus')
            ->select('submenu_name', 'submenu_slug', 'submenu_desc', 'upload')
            ->where(['submenu_status' => 1, 'submenu_slug' => $slug])
            ->first();
        return view('web.menudesc', $send);
    }

    public function allnotice()
    {
        $send['notices'] = DB::table('events')
        ->select('event_title', 'url', 'start_date')
        ->where(['event_status' => 1])
        ->orderByDesc('start_date')
        ->limit(6) // Replace '5' with your desired limit
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


}
