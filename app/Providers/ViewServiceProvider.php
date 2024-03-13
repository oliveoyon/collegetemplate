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
        if (request()->routeIs('guest.*') or request()->routeIs('admin.*')) {
        } else {
            $send['provider_menusWithSubMenus'] = Menu::with([
                'subMenus' => function ($query) {
                    $query->where('submenu_status', 1); // Filter submenus by submenu_status
                },
                'subMenus.childMenus' => function ($query) {
                    $query->where('child_menu_status', 1); // Filter child_menus by child_menu_status
                },
            ])->where('menu_status', 1)->get();
            
            

            $send['important_links'] = DB::table('important_links')->select('link_name', 'link')->get();

            // $send['sliders'] = DB::table('sliders')->where('slider_status', 1)->get();

            $send['webs'] = DB::table('web_settings')->first();

            // $send['webmessages'] = DB::table('messages')->where('message_status', 1)->get();

            $send['provider_ntcs'] = DB::table('events')
                ->join('event_types', 'events.event_type_id', '=', 'event_types.id')
                ->select('events.event_title','events.event_type_id', 'events.url', 'events.start_date', 'event_types.type_name', 'events.created_at', 'events.upload')
                ->where(['events.event_status' => 1])
                // ->where('events.end_date', '>=', now())
                ->orderByDesc('events.end_date')
                ->get();


            View::share($send);
        }
    }
}
