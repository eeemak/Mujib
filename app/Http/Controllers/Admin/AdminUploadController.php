<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

class AdminUploadController extends Controller
{

  public function index()
  {
    return redirect()->route('upload');
  }
  public function viewUpload()
  {
    $view = view('panel.layout.adminDashboard.upload.view_upload');
    $view->with('ControllerName', "AdminUploadController");
    return $view;
  }

}
