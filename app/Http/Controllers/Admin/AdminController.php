<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Log;
use Illuminate\Http\Request;

use App\Models\User;
use App\Models\Logs;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    public function index()
    {
        $store_id = \Auth::guard('admin')->user()->store_id;
        
        return view('dashboard.admin.home');
    }

   

    public function check(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:admins,email',
            'password' => 'required|min:4|max:16'
        ], [
            'email.exists' => 'This email is not in db'
        ]);

        $creds = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($creds)) {
            return redirect()->route('admin.home');
        } else {
            return redirect()->route('admin.login')->with('fail', 'Credential fails');
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'cur_pass' => 'required|min:4|max:16',
            'new_pass' => 'required|min:4|max:16',
            'cnew_pass' => 'required|min:4|max:16|same:new_pass',
        ], [
            'cnew_pass.same' => 'Hello',
        ]);


        $data = Admin::where('email', Auth::guard('admin')->user()->email)->first();
        if (\Hash::check($request->cur_pass, $data->password)) {
            $user = Admin::find($data->id);
            $user->password = \Hash::make($request->new_pass);
            $user->pin = '';
            $user->verify = 1;
            $user->update();
            return redirect()->back()->with('success', 'পাসওয়ার্ড সফলভাবে পরিবর্তন হয়েছে');
        } else {
            return redirect()->back()->with('fail', 'Fails');
        }
    }

    function logout()
    {
        //Auth::logout(); it will also work, or we can specify like bellow line as guard name
        Auth::guard('admin')->logout();
        return redirect('/');
    }
}
