<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

class HomeController extends Controller
{
    public function index(){
        return redirect()->route('dashboard');
    }
    public function dashboard(){
        return view('panel.layout.dashboard');
    }
    public function login(){
        return view('panel.layout.login');
    }
    public function attemptLogin(Request $request) {
        if (Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {
            return redirect()->route('dashboard');
        } else {
            Session::put('alert-danger', 'Invalid username or password');
            return redirect()->back();
        }
    }
    public function logout() {
        Auth::logout();
        return redirect()->route('login');
    }
    public function viewProfile(){
        return view('panel.profile.view_profile');
    }
    public function viewUpload(){
        return view('panel.upload.view_upload');
    }
}
