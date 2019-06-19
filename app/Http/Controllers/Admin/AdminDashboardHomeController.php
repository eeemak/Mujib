<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

class AdminDashboardHomeController extends Controller
{
    
    public function index(){
        return redirect()->route('dashboard');
    }
    public function dashboard(){
        $view = view('panel.layout.dashboard');
        $view->with('ControllerName', "EmployeeController");
        return $view;
    }

    public function viewProfile(){
        return view('panel.profile.view_profile');
    }
    public function viewUpload(){
        return view('panel.upload.view_upload');
    }
}
