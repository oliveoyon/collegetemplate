<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Admin\Department;
use App\Models\Admin\Events;
use App\Models\Admin\Menu;
use Carbon\Carbon;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    protected $menus;
    protected $deptId;

    public function __construct(Request $request)
    {
        $this->deptId = Department::where('department_slug', $request->route('dept'))->value('id');
    }
    public function getMenus(Request $request)
    {
        // Retrieve department ID
        $departmentId = Department::where('department_slug', $request->route('dept'))->value('id');

        $this->menus = Menu::with([
            'subMenus' => function ($query) {
                $query->where('submenu_status', 1);
            },
            'subMenus.childMenus' => function ($query) {
                $query->where('child_menu_status', 1);
            },
        ])->where(['menu_status' => 1, 'dept_id' => $departmentId])->get();
    }

    public function index(Request $request)
    {
        $this->getMenus($request);
        $send['menus'] = $this->menus;
        $send['messages'] = DB::table('messages')->where(['message_status' => 1, 'dept_id' => $this->deptId])->orderByDesc('created_at')->first();
        $send['uploads'] = DB::table('uploads')->where(['status' => 1, 'dept_id' => $this->deptId])->orderByDesc('created_at')->limit(6)->get();
        $send['teachers'] = DB::table('teachers')->where(['teacher_status' => 1, 'dept_id' => $this->deptId])->get();
        $send['sliders'] = DB::table('sliders')->where(['slider_status' => 1, 'dept_id' => $this->deptId])->limit(3)->get();
        $events = Events::where(['event_status' => 1, 'dept_id' => $this->deptId])
        // ->whereDate('start_date', '>=', now())
        ->select('event_title', 'start_date', 'end_date', 'url', 'color')
        ->get()
        ->map(function ($event) {
            return [
                'title' => $event->event_title,
                'start' => Carbon::parse($event->start_date)->toDateTimeString(),
                'end' => Carbon::parse($event->end_date)->toDateTimeString(),
                'url' => 'notice/'.$event->url,
                'color' => $event->color,
            ];
        });

        $send['eventsJson'] = $events->toJson();
        return view('department.depthome', $send);
    }

    public function indexs($faculty = null, $dept = null)
    {
        if ($faculty && $dept) {
            return view('department.depthome', $send);
        } elseif ($faculty) {
            return "Data for faculty:". $faculty;
        } else {
            return view('default-view');
        }
    }

    public function deptmenudesc(Request $request,$faculty = null, $dept = null, $menu=null, $submenu=null, $childmenu=null)
    {
        $this->getMenus($request);
        $send['menus'] = $this->menus;
        if ($faculty && $dept && $menu && $submenu && $childmenu) {

            $send['childmenudesc'] = DB::table('child_menus')
            ->select('childmenu_name', 'child_menu_slug', 'child_menu_desc', 'upload')
            ->where(['child_menu_status' => 1, 'child_menu_slug' => $childmenu])
            ->first();
            return view('department.childmenudesc', $send);

        } elseif ($faculty && $dept && $menu && $submenu) {

            $send['submenudesc'] = DB::table('sub_menus')
            ->select('submenu_name', 'submenu_slug', 'submenu_desc', 'upload')
            ->where(['submenu_status' => 1, 'submenu_slug' => $submenu])
            ->first();

            return view('department.submenudesc', $send);

        } elseif ($faculty && $dept && $menu) {

            $send['menudesc'] = DB::table('menus')
            ->select('menu_name', 'menu_slug', 'menu_desc', 'upload')
            ->where(['menu_status' => 1, 'menu_slug' => $menu])
            ->first();

            return view('department.menudesc', $send);

        } else {
            // No parameters provided
            return abort(404); // or redirect to a default view
        }

    }
}
