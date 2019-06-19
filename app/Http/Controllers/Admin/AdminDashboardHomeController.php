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
        $view = view('panel.layout.adminDashboard.dashboard');
        $view->with('ControllerName', "EmployeeController");
        return $view;
    }

    public function viewProfile(){
        $view = view('panel.layout.adminDashboard.profile.view_profile');
        $view->with('ControllerName','AdminDashboardController');
        return $view;
    }
    public function viewUpload(){
        return view('panel.layout.adminDashboard.upload.view_upload');
    }
}
