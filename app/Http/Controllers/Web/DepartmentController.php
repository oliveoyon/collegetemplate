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
    protected $menus;
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
        dd($send['menus']);
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
