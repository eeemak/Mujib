<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Model\District;
use App\Model\Thana;

class HomeController extends Controller
{
    
    public function index(){
        return redirect()->route('dashboard');
    }
    public function dashboard(){
        $view = view('panel.layout.dashboard');
        $view->with('controller', "EmployeeController");
        return $view;
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
    public function GetDistrict()
    {
        $districts = District::all();
        return response()->json($districts);
    }
    public function GetThana(Request $request)
    {
        $thanas = Thana::where('district_id', $request->districtId)->get();
        return response()->json($thanas);
    }
    public function GetPoliceStation(Request $request)
    {
        $policestations = Thana::where('thana_id', $request->thanaId)->get();
        return response()->json($policestations);
    }

    public function GetVillage($policeStationId, $thanaId, $districtId)
    {
        return [];
    }
}
