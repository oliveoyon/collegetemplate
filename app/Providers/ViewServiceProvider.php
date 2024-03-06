<?php

namespace App\Providers;

use App\Models\Admin\Menu;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        if (request()->routeIs('guest.*') OR request()->routeIs('admin.*')) {

        }else{
            $send['provider_menusWithSubMenus'] = Menu::with(['subMenus' => function ($query) {
                $query->where('submenu_status', 1); // Filter submenus by submenu_status
            }])->where('menu_status', 1)->get();

            // $send['important_links'] = DB::table('important_links')->select('link_name', 'link')->get();

            // $send['sliders'] = DB::table('sliders')->where('slider_status', 1)->get();

            // $send['webs'] = DB::table('web_settings')->first();

            // $send['webmessages'] = DB::table('messages')->where('message_status', 1)->get();

            $send['provider_ntcs'] = DB::table('events')
            ->select('event_title', 'url', 'start_date', 'event_type', 'created_at')
            ->where(['event_status' => 1])
            ->where('end_date', '>', now()) // Adding the condition for end_date
            ->orderByDesc('start_date')
            // ->limit(6)
            ->get();
            View::share($send);
        }
    }
}
