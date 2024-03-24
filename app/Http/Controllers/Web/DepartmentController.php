<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index($faculty = null, $dept = null)
    {
        if ($faculty && $dept) {
            return view('department.depthome');
        } elseif ($faculty) {
            // return response()->json(['error' => '404 Not Found'], 404);
            return "Data for faculty:". $faculty;
        } else {
            return view('default-view');
        }
    }
}
