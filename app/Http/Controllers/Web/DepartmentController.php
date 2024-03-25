<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\Admin\Department;
use App\Models\Admin\Menu;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepartmentController extends Controller
{
    public function index(Request $request, $faculty = null, $dept = null)
    {
        if ($faculty && $dept) {

            $departmentId = Department::where('department_slug', $request->route('dept'))->value('id');
            $send['menuss'] = Menu::with([
                'subMenus' => function ($query) {
                    $query->where('submenu_status', 1); // Filter submenus by submenu_status
                },
                'subMenus.childMenus' => function ($query) {
                    $query->where('child_menu_status', 1); // Filter child_menus by child_menu_status
                },
            ])->where(['menu_status' => 1, 'dept_id' => $departmentId])->get();
            
            return view('department.depthome', $send);
            // return view('department.layouts.test', $send);
        } elseif ($faculty) {
            // return response()->json(['error' => '404 Not Found'], 404);
            return "Data for faculty:". $faculty;
        } else {
            return view('default-view');
        }
    }

    public function deptmenudesc($faculty = null, $dept = null, $menu=null, $submenu=null, $childmenu=null)
    {

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
