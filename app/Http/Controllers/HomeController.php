<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Model\District;
use App\Model\Thana;
use App\Model\Village;
use App\Model\PoliceStation;
use App\User;
use App\Model\ProfessionType;

class HomeController extends Controller
{
    
    public function index(){
        $view = view('panel.public.index');
        $view->with('ControllerName', "HomeController");
        return $view;
    }
    public function dashboard(){
        $view = view('panel.layout.dashboard');
        $view->with('controller', "EmployeeController");
        return $view;
    }
    public function login(){
        return view('panel.layout.login');
    }
    public function register(){
        return view('panel.layout.register');
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
        $policestations = PoliceStation::where('thana_id', $request->thanaId)->get();
        return response()->json($policestations);
    }

    public function GetVillage(Request $request)
    {
        $villages = Village::where('police_stations_id', $request->policeStationId)->get();
        return response()->json($villages);
    }
    public function GetProfessionTypeCbo()
    {
        $professions = ProfessionType::all();
        return response()->json($professions);
    }
    public function GetUserInstructionList()
    {
        $user = Auth::user();
        return response()->json($user->institution);
    }
    // public function UpdateUser(Request $request){
    //     return response()->json($request->model['full_name']);
    // }
}
