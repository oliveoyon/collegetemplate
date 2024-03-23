<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\child_menu;
use App\Models\Admin\Department;
use App\Models\Admin\Menu;
use App\Models\Admin\SubMenu;
use App\Models\Admin\Events;
use App\Models\Admin\EventType;
use App\Models\Admin\Faculty;
use App\Models\Admin\History;
use App\Models\Admin\ImportantLink;
use App\Models\Admin\Messages;
use App\Models\Admin\MujibCorners;
use App\Models\Admin\Slider;
use App\Models\Admin\Uploads;
use App\Models\Admin\WebSetting;
use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Validator;

class MenuController extends Controller
{
    public function menulist()
    {
        $send['menus'] = Menu::get();
        return view('dashboard.admin.MenuManagement.menus', $send);
    }

    public function addMenu(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menu_name' => 'required|string|max:255',
            'upload' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the allowed file types and size as needed
            'menu_status' => 'required',
            'is_home' => 'nullable|boolean',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $file_name = '';
            if ($request->file('upload')) {
                $path = 'img/menu_img/';
                $file = $request->file('upload');
                $file_name = time() . '.' . $request->file('upload')->getClientOriginalExtension();
                //$upload = $file->storeAs($path, $file_name);
                $file->storeAs($path, $file_name, 'public');
            }

            $menu = new Menu();
            $menu->menu_name = $request->input('menu_name');
            $menu->menu_desc = $request->input('menu_desc');
            $menu->menu_slug = Str::slug($request->input('menu_name'));
            $menu->menu_status = $request->input('menu_status');
            $menu->is_home = $request->input('is_home') ? 1 : 0;
            $menu->upload = $file_name;
            $query = $menu->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Menu has been successfully saved', 'redirect' => 'admin/menu-list']);
            }
        }
    }

    public function getMenuDetails(Request $request)
    {
        $menu_id = $request->menu_id;
        $menuDetails = Menu::find($menu_id);
        return response()->json(['details' => $menuDetails]);
    }

    //UPDATE Category DETAILS
    public function updateMenuDetails(Request $request)
    {
        $menu_id = $request->mid;
        $menu = Menu::find($menu_id);
        $path = 'img/menu_img/';
        $file_name = $menu->upload;

        $validator = Validator::make($request->all(), [
            'menu_name' => 'required|string|max:255|unique:menus,menu_name,' . $menu_id,
            'upload' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust the allowed file types and size as needed
            'menu_status' => 'required',
            'is_home' => 'nullable|boolean',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            if ($request->hasFile('upload')) {
                $file_path = $path . $menu->upload;
                if ($menu->upload != null && \Storage::disk('public')->exists($file_path)) {
                    \Storage::disk('public')->delete($file_path);
                }
                $file = $request->file('upload');
                $file_name = time() . '.' . $request->file('upload')->getClientOriginalExtension();
                //$upload = $file->storeAs($path, $file_name);
                $upload = $file->storeAs($path, $file_name, 'public');
            }


            $menu->menu_name = $request->input('menu_name');
            $menu->menu_slug = Str::slug($request->input('menu_name'));
            $menu->menu_desc = $request->input('menu_desc');
            $menu->menu_status = $request->input('menu_status');
            $menu->is_home = $request->input('is_home') ? 1 : 0;
            $menu->upload = $file_name;
            $query = $menu->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Menu has been successfully saved', 'redirect' => 'admin/menu-list']);
            }
        }
    }

    public function deleteMenu(Request $request)
    {
        $menu_id = $request->menu_id;
        $query = Menu::find($menu_id);

        $path = 'img/menu_img/';
        $img_path = $path . $query->upload;
        if ($query->upload != null && \Storage::disk('public')->exists($img_path)) {
            \Storage::disk('public')->delete($img_path);
        }
        $query1 = $query->delete();

        // ->delete()

        if ($query1) {
            return response()->json(['code' => 1, 'msg' => 'Menu has been deleted from database', 'redirect' => 'admin/menu-list']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }

    // Sub Menu Management

    public function submenulist()
    {
        $send['menus'] = Menu::get();
        $send['submenus'] =  DB::table('sub_menus')
            ->join('menus', 'sub_menus.menu_id', '=', 'menus.id')
            ->select('sub_menus.*', 'menus.menu_name')
            ->get();
        return view('dashboard.admin.MenuManagement.submenus', $send);
    }

    public function addSubMenu(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menu_id' => 'required',
            'submenu_name' => 'required|string|max:255',
            // 'submenu_desc' => 'string',
            'upload' => 'file|mimes:pdf,jpeg,png,jpg,gif|max:5120', // Adjust the allowed file types and size as needed
            'submenu_status' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $file_name = '';
            if ($request->file('upload')) {
                $path = 'img/submenu_img/';
                $file = $request->file('upload');
                $file_name = time() . '.' . $request->file('upload')->getClientOriginalExtension();
                //$upload = $file->storeAs($path, $file_name);
                $file->storeAs($path, $file_name, 'public');
            }

            $submenu = new SubMenu();
            $submenu->menu_id = $request->input('menu_id');
            $submenu->submenu_name = $request->input('submenu_name');
            $submenu->submenu_slug = Str::slug($request->input('submenu_name'));
            $submenu->submenu_status = $request->input('submenu_status');
            $submenu->submenu_desc = $request->input('submenu_desc');
            $submenu->upload = $file_name;
            $query = $submenu->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Menu has been successfully saved', 'redirect' => 'admin/submenu-list']);
            }
        }
    }

    public function getSubMenuDetails(Request $request)
    {
        $submenu_id = $request->submenu_id;
        $submenuDetails = chil::find($submenu_id);
        return response()->json(['details' => $submenuDetails]);
    }

    public function updateSubMenuDetails(Request $request)
    {
        $submenu_id = $request->sid;
        $submenu = SubMenu::find($submenu_id);
        $path = 'img/submenu_img/';
        $file_name = $submenu->upload;

        $validator = Validator::make($request->all(), [
            'menu_id' => 'required',
            'submenu_name' => 'required|string|max:255|unique:sub_menus,submenu_name,' . $submenu_id,
            // 'submenu_desc' => 'string',
            'upload' => 'file|mimes:pdf,jpeg,png,jpg,gif|max:5120', // Adjust the allowed file types and size as needed
            'submenu_status' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            if ($request->hasFile('upload')) {
                $file_path = $path . $submenu->upload;
                if ($submenu->upload != null && \Storage::disk('public')->exists($file_path)) {
                    \Storage::disk('public')->delete($file_path);
                }
                $file = $request->file('upload');
                $file_name = time() . '.' . $request->file('upload')->getClientOriginalExtension();
                //$upload = $file->storeAs($path, $file_name);
                $upload = $file->storeAs($path, $file_name, 'public');
            }


            $submenu->submenu_name = $request->input('submenu_name');
            $submenu->submenu_slug = Str::slug($request->input('submenu_name'));
            $submenu->submenu_desc = $request->input('submenu_desc');
            $submenu->submenu_status = $request->input('submenu_status');
            $submenu->upload = $file_name;
            $query = $submenu->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Sub Menu has been successfully saved', 'redirect' => 'admin/submenu-list']);
            }
        }
    }

    public function deleteSubMenu(Request $request)
    {
        $submenu_id = $request->submenu_id;
        $query = SubMenu::find($submenu_id);

        $path = 'img/submenu_img/';
        $img_path = $path . $query->upload;
        if ($query->upload != null && \Storage::disk('public')->exists($img_path)) {
            \Storage::disk('public')->delete($img_path);
        }
        $query1 = $query->delete();

        // ->delete()

        if ($query1) {
            return response()->json(['code' => 1, 'msg' => 'Sub Menu has been deleted from database', 'redirect' => 'admin/submenu-list']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }

    public function childmenulist()
    {
        $send['menus'] = Menu::get();
        $send['submenus'] = SubMenu::get();
        $send['childmenus'] =  DB::table('child_menus')
            ->join('menus', 'child_menus.menu_id', '=', 'menus.id')
            ->join('sub_menus', 'child_menus.submenu_id', '=', 'sub_menus.id')
            ->select('child_menus.*', 'menus.menu_name', 'sub_menus.submenu_name')
            ->get();

        // dd($send['childmenus']);
        return view('dashboard.admin.MenuManagement.childmenu', $send);
    }

    public function getSubmenuByMenu(Request $request)
    {
        $menuId = $request->input('menu_id');

        $menus = Submenu::where(['menu_id' => $menuId])->get();
        return response()->json(['submenus' => $menus]);
    }

    public function addChildMenu(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menu_id' => 'required',
            'submenu_id' => 'required',
            'childmenu_name' => 'required|string|max:255',
            'childmenu_desc' => 'string',
            'upload' => 'file|mimes:pdf,jpeg,png,jpg,gif|max:5120', // Adjust the allowed file types and size as needed
            'child_menu_status' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $file_name = '';
            if ($request->file('upload')) {
                $path = 'img/childmenu_img/';
                $file = $request->file('upload');
                $file_name = time() . '.' . $request->file('upload')->getClientOriginalExtension();
                //$upload = $file->storeAs($path, $file_name);
                $file->storeAs($path, $file_name, 'public');
            }

            $childmenu = new child_menu();
            $childmenu->menu_id = $request->input('menu_id');
            $childmenu->submenu_id = $request->input('submenu_id');
            $childmenu->childmenu_name = $request->input('childmenu_name');
            $childmenu->child_menu_slug = Str::slug($request->input('childmenu_name'));
            $childmenu->child_menu_status = $request->input('child_menu_status');
            $childmenu->child_menu_desc = $request->input('child_menu_desc');
            $childmenu->upload = $file_name;
            $query = $childmenu->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Menu has been successfully saved', 'redirect' => 'admin/child-menu-list']);
            }
        }
    }

    public function getChildMenuDetails(Request $request)
    {
        $childmenu_id = $request->childmenu_id;
        $childmenuDetails = child_menu::find($childmenu_id);
        return response()->json(['details' => $childmenuDetails]);
    }

    public function updateChildMenuDetails(Request $request)
    {
        $childmenu_id = $request->sid;
        $childmenu = child_menu::find($childmenu_id);
        $path = 'img/childmenu_img/';
        $file_name = $childmenu->upload;

        $validator = Validator::make($request->all(), [
            'menu_id' => 'required',
            'childmenu_name' => 'required|string|max:255|unique:child_menus,childmenu_name,' . $childmenu_id,
            'submenu_id' => 'required',
            'child_menu_desc' => 'string',
            'upload' => 'file|mimes:pdf,jpeg,png,jpg,gif|max:5120', // Adjust the allowed file types and size as needed
            'child_menu_status' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            if ($request->hasFile('upload')) {
                $file_path = $path . $childmenu->upload;
                if ($childmenu->upload != null && \Storage::disk('public')->exists($file_path)) {
                    \Storage::disk('public')->delete($file_path);
                }
                $file = $request->file('upload');
                $file_name = time() . '.' . $request->file('upload')->getClientOriginalExtension();
                //$upload = $file->storeAs($path, $file_name);
                $upload = $file->storeAs($path, $file_name, 'public');
            }


            $childmenu->childmenu_name = $request->input('childmenu_name');
            $childmenu->childmenu_slug = Str::slug($request->input('childmenu_name'));
            $childmenu->child_menu_desc = $request->input('child_menu_desc');
            $childmenu->child_menu_status = $request->input('child_menu_status');
            $childmenu->upload = $file_name;
            $query = $childmenu->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Child Menu has been successfully saved', 'redirect' => 'admin/child-menu-list']);
            }
        }
    }

    public function deleteChildMenu(Request $request)
    {
        $childmenu_id = $request->childmenu_id;
        $query = child_menu::find($childmenu_id);

        $path = 'img/childmenu_img/';
        $img_path = $path . $query->upload;
        if ($query->upload != null && \Storage::disk('public')->exists($img_path)) {
            \Storage::disk('public')->delete($img_path);
        }
        $query1 = $query->delete();

        // ->delete()

        if ($query1) {
            return response()->json(['code' => 1, 'msg' => 'Child Menu has been deleted from database', 'redirect' => 'admin/child-menu-list']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }

    // Notice Management

    public function noticelist()
    {
        // $send['notices'] = Events::get();
        $send['eventTypes'] = EventType::where('status', 1)->get();
        $send['notices'] = DB::table('events')
            ->join('event_types', 'events.event_type_id', '=', 'event_types.id')
            ->select('events.*', 'event_types.type_name')
            // ->where(['events.event_status' => 1])
            // ->where('events.end_date', '>', now())
            ->orderByDesc('events.end_date')
            ->get();
        return view('dashboard.admin.NoticeManagement.notice', $send);
    }

    public function addNotice(Request $request)
    {
        // Validation rules
        $validator = Validator::make($request->all(), [
            'event_title' => 'required|string|max:200',
            'event_description' => 'required|string',
            'event_type_id' => 'required|exists:event_types,id',
            'upload' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'event_status' => 'required|integer',
        ]);

        // Check validation results
        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        }

        // Process file upload
        $file_name = '';
        if ($request->file('upload')) {
            $path = 'img/events/';
            $file = $request->file('upload');
            $file_name = time() . '.' . $request->file('upload')->getClientOriginalExtension();
            $file->storeAs($path, $file_name, 'public');
        }

        // Retrieve color from EventType model
        $color = EventType::where('id', $request->input('event_type_id'))->first();

        // Create new Events instance
        $notice = new Events();
        $notice->event_hash_id = md5(uniqid(rand(), true));
        $notice->event_title = $request->input('event_title');
        $notice->url = Str::slug($request->input('event_title'));
        $notice->event_description = $request->input('event_description');
        $notice->event_type_id = $request->input('event_type_id');
        $notice->start_date = date('Y-m-d', strtotime($request->input('start_date')));
        $notice->end_date = date('Y-m-d', strtotime($request->input('end_date')));
        $notice->color = $color->color;
        $notice->dept_id = auth()->user()->dept_id;
        $notice->event_status = $request->input('event_status');
        $notice->upload = $file_name;

        // Save the notice
        $query = $notice->save();

        // Return response based on query result
        if (!$query) {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        } else {
            return response()->json(['code' => 1, 'msg' => 'Notice has been successfully saved', 'redirect' => 'admin/notice-list']);
        }
    }

    public function getNoticeDetails(Request $request)
    {
        $event_id = $request->event_id;
        $noticeDetails = Events::find($event_id);
        return response()->json(['details' => $noticeDetails]);
    }

    //UPDATE Category DETAILS
    public function updateNoticeDetails(Request $request)
    {
        $event_id = $request->nid;
        $notice = Events::find($event_id);
        $path = 'img/events/';
        $file_name = $notice->upload;
        $color = EventType::where('id', $request->input('event_type_id'))->first();

        $validator = Validator::make($request->all(), [
            'event_title' => 'required|string|max:255|unique:events,event_title,' . $event_id,
            'event_description' => 'required|string',
            'event_type_id' => 'required|exists:event_types,id',
            'upload' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'event_status' => 'required|integer',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            if ($request->hasFile('upload')) {
                $file_path = $path . $notice->upload;
                if ($notice->upload != null && \Storage::disk('public')->exists($file_path)) {
                    \Storage::disk('public')->delete($file_path);
                }
                $file = $request->file('upload');
                $file_name = time() . '.' . $request->file('upload')->getClientOriginalExtension();
                //$upload = $file->storeAs($path, $file_name);
                $upload = $file->storeAs($path, $file_name, 'public');
            }


            $notice->event_title = $request->input('event_title');
            $notice->url = Str::slug($request->input('event_title'));
            $notice->event_description = $request->input('event_description');
            $notice->event_type_id = $request->input('event_type_id');
            $notice->start_date = $request->input('start_date');
            $notice->end_date = $request->input('end_date');
            $notice->color = $color->color;
            $notice->dept_id = auth()->user()->dept_id;




            if ($request->input('start_date')) {
                $startDate = $request->input('start_date'); // Assuming it's in some format like "d/m/Y" or "m/d/Y"
                $formattedStartDate = date('Y-m-d', strtotime($startDate));
                $notice->start_date = $formattedStartDate;
            } else {
                $notice->start_date = date('Y-m-d');
            }
            if ($request->input('end_date')) {
                $endDate = $request->input('end_date'); // Assuming it's in some format like "d/m/Y" or "m/d/Y"
                $formattedEndDate = date('Y-m-d', strtotime($endDate));
                $notice->end_date = $formattedEndDate;
            } else {
                $notice->end_date = '';
            }

            $notice->event_status = $request->input('event_status');
            $notice->upload = $file_name;

            $query = $notice->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Notice has been successfully saved', 'redirect' => 'admin/notice-list']);
            }
        }
    }

    public function deleteNotice(Request $request)
    {
        $event_id = $request->event_id;
        $query = Events::find($event_id);

        $path = 'img/events/';
        $img_path = $path . $query->upload;
        if ($query->upload != null && \Storage::disk('public')->exists($img_path)) {
            \Storage::disk('public')->delete($img_path);
        }
        $query1 = $query->delete();

        // ->delete()

        if ($query1) {
            return response()->json(['code' => 1, 'msg' => 'Menu has been deleted from database', 'redirect' => 'admin/notice-list']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }


    public function linklist()
    {
        $send['links'] = ImportantLink::get();
        return view('dashboard.admin.others.links', $send);
    }

    public function addLink(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'link_name' => 'required|string|max:255',
            'link' => 'required|string|max:255',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $link = new ImportantLink();
            $link->link_name = $request->input('link_name');
            $link->link = $request->input('link');
            $query = $link->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Link has been successfully saved', 'redirect' => 'admin/link-list']);
            }
        }
    }

    public function getLinkDetails(Request $request)
    {
        $link_id = $request->link_id;
        $linkDetails = ImportantLink::find($link_id);
        return response()->json(['details' => $linkDetails]);
    }

    //UPDATE Category DETAILS
    public function updateLinkDetails(Request $request)
    {
        $link_id = $request->lid;
        $link = ImportantLink::find($link_id);

        $validator = Validator::make($request->all(), [
            'link_name' => 'required|string|max:255|unique:important_links,link_name,' . $link_id,
            'link' => 'required|string|max:255|unique:important_links,link,' . $link_id,

        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $link->link_name = $request->input('link_name');
            $link->link = $request->input('link');
            $query = $link->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Link has been successfully saved', 'redirect' => 'admin/link-list']);
            }
        }
    }

    public function deleteLink(Request $request)
    {
        $link_id = $request->link_id;
        $query = ImportantLink::find($link_id);
        $query = $query->delete();


        if ($query) {
            return response()->json(['code' => 1, 'msg' => 'Link has been deleted from database', 'redirect' => 'admin/link-list']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }

    public function sliderlist()
    {
        $send['sliders'] = Slider::get();
        return view('dashboard.admin.others.sliders', $send);
    }

    public function addSlider(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:min_width=1000,min_height=200,max_width=2000,max_height=1500',
            'slider_status' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $file_name = '';
            if ($request->file('upload')) {
                $path = 'img/slider/';
                $file = $request->file('upload');
                $file_name = time() . '.' . $request->file('upload')->getClientOriginalExtension();
                //$upload = $file->storeAs($path, $file_name);
                $file->storeAs($path, $file_name, 'public');
            }

            $slider = new Slider();
            $slider->upload = $file_name;
            $slider->title = $request->input('title');
            $slider->desc = $request->input('desc');
            $slider->slider_status = $request->input('slider_status');
            $query = $slider->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Slider has been successfully saved', 'redirect' => 'admin/slider-list']);
            }
        }
    }



    public function deleteSlider(Request $request)
    {
        $slider_id = $request->slider_id;
        $query = Slider::find($slider_id);

        $path = 'img/slider/';
        $img_path = $path . $query->upload;
        if ($query->upload != null && \Storage::disk('public')->exists($img_path)) {
            \Storage::disk('public')->delete($img_path);
        }
        $query1 = $query->delete();

        // ->delete()

        if ($query1) {
            return response()->json(['code' => 1, 'msg' => 'Slider has been deleted from database', 'redirect' => 'admin/slider-list']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }


    public function history()
    {
        $send['history'] = History::first();
        return view('dashboard.admin.others.history', $send);
    }

    public function updatehistory(Request $request)
    {
        $history_id = $request->input('history_id');
        $history = History::find($history_id);
        $history->history = $request->input('history');
        $history->save();
        return redirect('admin/institute-history');
    }

    public function web_settings()
    {
        $send['data'] = WebSetting::first();
        return view('dashboard.admin.others.websettings', $send);
    }



    public function updatewebsettings(Request $request)
    {
        $wsid = $request->input('wsid');
        $ws = WebSetting::find($wsid);
        $path = 'img/logo/';
        $file_name = $ws->logo;

        $validator = Validator::make($request->all(), [
            'school_title' => 'required|string|max:255|unique:web_settings,school_title,' . $wsid,
            'logo' => 'image|mimes:jpeg,png,jpg,gif|max:1024', // Adjust the allowed file types and size as needed
            'phone1' => 'required',
            'email' => 'required',
            'address_one' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            if ($request->hasFile('logo')) {
                $file_path = $path . $ws->logo;
                if ($ws->upload != null && \Storage::disk('public')->exists($file_path)) {
                    \Storage::disk('public')->delete($file_path);
                }
                $file = $request->file('logo');
                $file_name = time() . '.' . $request->file('logo')->getClientOriginalExtension();
                $file->storeAs($path, $file_name, 'public');
            }

            $ws->school_title = $request->input('school_title');
            $ws->phone1 = $request->input('phone1');
            $ws->phone2 = $request->input('phone2');
            $ws->fax = $request->input('fax');
            $ws->map = $request->input('map');
            $ws->email = $request->input('email');
            $ws->address_one = $request->input('address_one');
            $ws->address_two = $request->input('address_two');
            $ws->eiin = $request->input('eiin');
            $ws->facebook = $request->input('facebook');
            $ws->twitter = $request->input('twitter');
            $ws->linkedin = $request->input('linkedin');
            $ws->instagram = $request->input('instagram');
            $ws->logo = $file_name;

            $query = $ws->save();

            // if (!$query) {
            //     return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            // } else {
            //     return response()->json(['code' => 1, 'msg' => 'Notice has been successfully saved', 'redirect'=> 'admin/notice-list']);
            // }
            return redirect('admin/web-settings');
        }
    }


    // Upload Section

    public function uploadlist()
    {
        $send['uploads'] = Uploads::get();
        return view('dashboard.admin.others.upload', $send);
    }

    public function addUpload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'upload' => 'image|mimes:pdf,jpeg,png,jpg,gif|max:5012', // Adjust the allowed file types and size as needed
            'status' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $file_name = '';
            if ($request->file('upload')) {
                $path = 'img/upload/';
                $file = $request->file('upload');
                $file_name = time() . '.' . $request->file('upload')->getClientOriginalExtension();
                //$upload = $file->storeAs($path, $file_name);
                $file->storeAs($path, $file_name, 'public');
            }

            $upload = new Uploads();
            $upload->title = $request->input('title');
            $upload->url = Str::slug($request->input('title'));
            $upload->description = $request->input('description');
            $upload->status = $request->input('status');
            $upload->upload = $file_name;
            $query = $upload->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Upload has been successfully saved', 'redirect' => 'admin/upload-list']);
            }
        }
    }

    public function getUploadDetails(Request $request)
    {
        $upload_id = $request->upload_id;
        $uploadDetails = Uploads::find($upload_id);
        return response()->json(['details' => $uploadDetails]);
    }

    //UPDATE Category DETAILS
    public function updateUploadDetails(Request $request)
    {
        $upload_id = $request->nid;
        $upload = Uploads::find($upload_id);
        $path = 'img/upload/';
        $file_name = $upload->upload;

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:uploads,title,' . $upload_id,
            'upload' => 'file|mimes:pdf,jpeg,png,jpg,gif|max:5012', // Adjust the allowed file types and size as needed
            'status' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            if ($request->hasFile('upload')) {
                $file_path = $path . $upload->upload;
                if ($upload->upload != null && \Storage::disk('public')->exists($file_path)) {
                    \Storage::disk('public')->delete($file_path);
                }
                $file = $request->file('upload');
                $file_name = time() . '.' . $request->file('upload')->getClientOriginalExtension();
                //$upload = $file->storeAs($path, $file_name);
                $upload = $file->storeAs($path, $file_name, 'public');
            }


            $upload->title = $request->input('title');
            $upload->url = Str::slug($request->input('title'));
            $upload->description = $request->input('description');
            $upload->status = $request->input('status');
            $upload->upload = $file_name;

            $query = $upload->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Upload has been successfully saved', 'redirect' => 'admin/upload-list']);
            }
        }
    }

    public function deleteUpload(Request $request)
    {
        $upload_id = $request->upload_id;
        $query = Uploads::find($upload_id);

        $path = 'img/upload/';
        $img_path = $path . $query->upload;
        if ($query->upload != null && \Storage::disk('public')->exists($img_path)) {
            \Storage::disk('public')->delete($img_path);
        }
        $query1 = $query->delete();

        // ->delete()

        if ($query1) {
            return response()->json(['code' => 1, 'msg' => 'Upload has been deleted from database', 'redirect' => 'admin/upload-list']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }

    // Mujib Corner

    public function mujiblist()
    {
        $send['mujibs'] = MujibCorners::get();
        return view('dashboard.admin.NoticeManagement.mujib', $send);
    }

    public function addMujibeCorner(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'upload' => 'image|mimes:jpeg,png,jpg,gif|max:5012', // Adjust the allowed file types and size as needed
            'status' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $file_name = '';
            if ($request->file('upload')) {
                $path = 'img/mujib/';
                $file = $request->file('upload');
                $file_name = time() . '.' . $request->file('upload')->getClientOriginalExtension();
                //$upload = $file->storeAs($path, $file_name);
                $file->storeAs($path, $file_name, 'public');
            }

            $mujib = new MujibCorners();
            $mujib->title = $request->input('title');
            $mujib->url = Str::slug($request->input('title'));
            $mujib->description = $request->input('description');
            $mujib->status = $request->input('status');
            $mujib->upload = $file_name;
            $query = $mujib->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Item has been successfully saved', 'redirect' => 'admin/upload-list']);
            }
        }
    }

    public function getMujibCornerDetails(Request $request)
    {
        $mujib_id = $request->mujib_id;
        $mujibDetails = MujibCorners::find($mujib_id);
        return response()->json(['details' => $mujibDetails]);
    }

    //UPDATE Category DETAILS
    public function updateMujibCornerDetails(Request $request)
    {
        $mujib_id = $request->nid;
        $mujib = MujibCorners::find($mujib_id);
        $path = 'img/mujib/';
        $file_name = $mujib->upload;

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255|unique:mujib_corners,title,' . $mujib_id,
            'upload' => 'image|mimes:jpeg,png,jpg,gif|max:5012', // Adjust the allowed file types and size as needed
            'status' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            if ($request->hasFile('upload')) {
                $file_path = $path . $mujib->upload;
                if ($mujib->upload != null && \Storage::disk('public')->exists($file_path)) {
                    \Storage::disk('public')->delete($file_path);
                }
                $file = $request->file('upload');
                $file_name = time() . '.' . $request->file('upload')->getClientOriginalExtension();
                //$upload = $file->storeAs($path, $file_name);
                $upload = $file->storeAs($path, $file_name, 'public');
            }


            $mujib->title = $request->input('title');
            $mujib->url = Str::slug($request->input('title'));
            $mujib->description = $request->input('description');
            $mujib->status = $request->input('status');
            $mujib->upload = $file_name;

            $query = $mujib->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Item has been successfully saved', 'redirect' => 'admin/upload-list']);
            }
        }
    }

    public function deleteMujibCorner(Request $request)
    {
        $mujib_id = $request->mujib_id;
        $query = MujibCorners::find($mujib_id);

        $path = 'img/mujib/';
        $img_path = $path . $query->upload;
        if ($query->upload != null && \Storage::disk('public')->exists($img_path)) {
            \Storage::disk('public')->delete($img_path);
        }
        $query1 = $query->delete();

        // ->delete()

        if ($query1) {
            return response()->json(['code' => 1, 'msg' => 'Item has been deleted from database', 'redirect' => 'admin/upload-list']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }

    // Message

    public function messagelist()
    {
        $send['messages'] = Messages::get();
        return view('dashboard.admin.others.message', $send);
    }

    public function addMessage(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'message_type' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'upload' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // Adjust the allowed file types and size as needed
            'message_status' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $file_name = '';
            if ($request->file('upload')) {
                $path = 'img/message_img/';
                $file = $request->file('upload');
                $file_name = time() . '.' . $request->file('upload')->getClientOriginalExtension();
                //$upload = $file->storeAs($path, $file_name);
                $file->storeAs($path, $file_name, 'public');
            }

            $message = new Messages();
            $message->message_type = $request->input('message_type');
            $message->name = $request->input('name');
            $message->message_slug = Str::slug($request->input('message_type'));
            $message->message_status = $request->input('message_status');
            $message->message_desc = $request->input('message_desc');
            $message->upload = $file_name;
            $query = $message->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Message has been successfully saved', 'redirect' => 'admin/message-list']);
            }
        }
    }

    public function getMessageDetails(Request $request)
    {
        $message_id = $request->message_id;
        $messageDetails = Messages::find($message_id);
        return response()->json(['details' => $messageDetails]);
    }

    public function updateMessageDetails(Request $request)
    {
        $message_id = $request->sid;
        $message = Messages::find($message_id);
        $path = 'img/message_img/';
        $file_name = $message->upload;

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'message_type' => 'required|string|max:255|unique:messages,message_type,' . $message_id,
            // 'message_desc' => 'string',
            'upload' => 'image|mimes:jpeg,png,jpg,gif|max:5120', // Adjust the allowed file types and size as needed
            'message_status' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            if ($request->hasFile('upload')) {
                $file_path = $path . $message->upload;
                if ($message->upload != null && \Storage::disk('public')->exists($file_path)) {
                    \Storage::disk('public')->delete($file_path);
                }
                $file = $request->file('upload');
                $file_name = time() . '.' . $request->file('upload')->getClientOriginalExtension();
                //$upload = $file->storeAs($path, $file_name);
                $upload = $file->storeAs($path, $file_name, 'public');
            }


            $message->message_type = $request->input('message_type');
            $message->name = $request->input('name');
            $message->message_slug = Str::slug($request->input('message_slug'));
            $message->message_status = $request->input('message_status');
            $message->message_desc = $request->input('message_desc');
            $message->upload = $file_name;
            $query = $message->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => 'Sub Menu has been successfully saved', 'redirect' => 'admin/message-list']);
            }
        }
    }

    public function deleteMessage(Request $request)
    {
        $message_id = $request->message_id;
        $query = Messages::find($message_id);

        $path = 'img/message_img/';
        $img_path = $path . $query->upload;
        if ($query->upload != null && \Storage::disk('public')->exists($img_path)) {
            \Storage::disk('public')->delete($img_path);
        }
        $query1 = $query->delete();

        // ->delete()

        if ($query1) {
            return response()->json(['code' => 1, 'msg' => 'Message has been deleted from database', 'redirect' => 'admin/message-list']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }

    public function facultylist()
    {
        $send['facultys'] = Faculty::get();
        return view('dashboard.admin.academic.faculty', $send);
    }

    public function addFaculty(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'faculty_name' => 'required|string|max:255',
            'faculty_status' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $faculty = new Faculty();
            $faculty->faculty_hash_id = md5(uniqid(rand(), true));
            $faculty->faculty_name = $request->input('faculty_name');
            $faculty->faculty_slug = Str::slug($request->input('faculty_name'));
            $faculty->faculty_status = $request->input('faculty_status');
            $query = $faculty->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => __('language.faculty_add_msg') , 'redirect'=> 'admin/faculty-list']);
            }
        }
    }

    public function getFacultyDetails(Request $request)
    {
        $faculty_id = $request->faculty_id;
        $facultyDetails = Faculty::find($faculty_id);
        return response()->json(['details' => $facultyDetails]);
    }

    //UPDATE Category DETAILS
    public function updateFacultyDetails(Request $request)
    {
        $faculty_id = $request->vid;
        $faculty = Faculty::find($faculty_id);

        $validator = Validator::make($request->all(), [
            'faculty_name' => 'required|string|max:255|unique:faculties,faculty_name,' . $faculty_id,
            'faculty_status' => 'required',
        ]);

        if (!$validator->passes()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        } else {

            $faculty->faculty_name = $request->input('faculty_name');
            $faculty->faculty_slug = Str::slug($request->input('faculty_name'));
            $faculty->faculty_status = $request->input('faculty_status');
            $query = $faculty->save();

            if (!$query) {
                return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
            } else {
                return response()->json(['code' => 1, 'msg' => __('language.faculty_edit_msg') , 'redirect'=> 'admin/faculty-list']);
            }
        }
    }

    public function deleteFaculty(Request $request)
    {
        $faculty_id = $request->faculty_id;
        $query = Faculty::find($faculty_id);
        $query = $query->delete();


        if ($query) {
            return response()->json(['code' => 1, 'msg' => __('language.faculty_del_msg') , 'redirect' => 'admin/faculty-list']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }

    public function departmentlist()
    {
        $send['departments'] = Department::get();
        $send['faculties'] = Faculty::get()->where('faculty_status', 1);
        return view('dashboard.admin.academic.department', $send);
    }

    public function addDepartment(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'department_name' => 'required|string|max:50|unique:departments,department_name,NULL,id,faculty_id,' . $request->input('faculty_id'),
            'department_status' => 'required',
            'faculty_id' => 'required|exists:faculties,id', // Make sure the faculty exists
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $department = new Department();
        $department->department_hash_id = md5(uniqid(rand(), true));
        $department->department_name = $request->input('department_name');
        $department->department_slug = Str::slug($request->input('department_name'));
        $department->department_status = $request->input('department_status');
        $department->faculty_id = $request->input('faculty_id'); // Assign the faculty_id
        $query = $department->save();

        if ($query) {
            return response()->json(['code' => 1, 'msg' => __('language.department_add_msg'), 'redirect' => 'admin/department-list']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }

    public function getDepartmentDetails(Request $request)
    {
        $department_id = $request->department_id;
        $departmentDetails = Department::find($department_id);
        return response()->json(['details' => $departmentDetails]);
    }

    public function updateDepartmentDetails(Request $request)
    {
        // dd($request);
        $department_id = $request->cid;
        $department = Department::find($department_id);



        $validator = Validator::make($request->all(), [
            'department_name' => 'required|string|max:255|unique:departments,department_name,' . $department_id,
            'department_status' => 'required',
            'faculty_id' => 'required|exists:faculties,id', // Make sure the faculty exists
        ]);

        if ($validator->fails()) {
            return response()->json(['code' => 0, 'error' => $validator->errors()->toArray()]);
        }

        $department->department_name = $request->input('department_name');
        $department->department_slug = Str::slug($request->input('department_name', '-'));
        $department->department_status = $request->input('department_status');
        $department->faculty_id = $request->input('faculty_id'); // Update the faculty_id
        $query = $department->save();

        if ($query) {
            return response()->json(['code' => 1, 'msg' => __('language.department_edit_msg'), 'redirect' => 'admin/department-list']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }

    public function deleteDepartment(Request $request)
    {
        $department_id = $request->department_id;
        $query = Department::find($department_id);
        $query = $query->delete();

        if ($query) {
            return response()->json(['code' => 1, 'msg' => __('language.department_del_msg'), 'redirect' => 'admin/department-list']);
        } else {
            return response()->json(['code' => 0, 'msg' => 'Something went wrong']);
        }
    }
}
