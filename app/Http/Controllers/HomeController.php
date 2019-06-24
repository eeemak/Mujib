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
use App\Model\Gallary;
use App\Model\UserInstitutions;

class HomeController extends Controller
{
    
    public function index(){
        $view = view('panel.public.index');
        $view->with('ControllerName', "HomeController");
        return $view;
    }
    public function publicGallery(){
        $view = view('panel.public.gallery');
        $view->with('ControllerName', "GallaryController");
        return $view;
    }
    public function dashboard(){
        $view = view('panel.layout.dashboard');
        $view->with('ControllerName', "EmployeeController");
        return $view;
    }
    public function login(){
        $view = view('panel.layout.login');
        $view->with('ControllerName', "AccountController");
        return $view;
    }
    public function register(){
        $view = view('panel.layout.register');
        $view->with('hasSlider', false);
        $view->with('ControllerName', "AccountController");
        return $view;
    }
    public function attemptLogin(Request $request) {
        if (Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')])) {
            return redirect()->route('dashboard');
        }else if (Auth::attempt(['phone' => $request->input('username'), 'password' => $request->input('password')])) {
            return redirect()->route('dashboard');
        } else {
            Session::put('alert-danger', 'Invalid username or password');
            return redirect()->back();
        }
    }
    public function attemptRegister(Request $request) {
        $this->validate($request, [
            'full_name' => 'required|min:4',
            'phone' => 'required|unique:users',
            'password' => 'required|confirmed|min:4',
        ]);
        $user = new User();
        $user->fill($request->input());
        $user->password = bcrypt($request->password);
        $user->save();
        $user->assignRole('user');
        $user_institution = new UserInstitutions();
        $user_institution->ProfessionTypeId = $request->ProfessionTypeId;
        $user->institution()->save($user_institution);
        Session::put('alert-success', 'Registration successfull! Please login.');
        return redirect()->route('login');
    }
    public function logout() {
        Auth::logout();
        return redirect()->route('home');
    }
    public function GetDistrict()
    {
        $districts = District::orderBy('name')->get();
        return response()->json($districts);
    }
    public function GetThana(Request $request)
    {
        $thanas = Thana::where('district_id', $request->districtId)->orderBy('name')->get();
        return response()->json($thanas);
    }
    public function GetPoliceStation(Request $request)
    {
        $policestations = PoliceStation::where('thana_id', $request->thanaId)->orderBy('name')->get();
        return response()->json($policestations);
    }

    public function GetVillage(Request $request)
    {
        $villages = Village::where('police_stations_id', $request->policeStationId)->orderBy('name')->get();
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
    public function GetPublicGallary(){
        $gallaries = Gallary::orderBy('id', 'desc')->get();
        return response()->json($gallaries);
    }
    public function CheckUserExist(Request $request){
        $user_exist = User::where('phone', $request->phone)->exists();
        $data['message'] = '';
        $data['isExist'] = $user_exist;
        if($user_exist){
            $data['message'] = 'User already exist';
        }
        return $data;
    }
    public function AdvanceSearchUsers(Request $request){
        if($request->districtId){
            $obj_user = User::where('district_id', $request->districtId);
            if($request->thanaId != 'null'){
                $obj_user->where('thana_id', $request->thanaId);
                if($request->policeStationId != 'null'){
                    $obj_user->where('police_station_id', $request->policeStationId);
                    if($request->villageId != 'null'){
                        $obj_user->where('village_id', $request->villageId);
                    }
                }
            }
            $users = $obj_user->get();
            $data['user_count'] = $obj_user->count();
            $data['users'] = [];
            foreach($users as $key => $user){
                $data['users'][] =[
                    'FullName' => $user->full_name,
                    'VillageName' => $user->village ? $user->village->name : null,
                    'PoliceStationName' => $user->police_station ? $user->police_station->name : null,
                    'ThanaName' => $user->thana ? $user->thana->name : null,
                    'DistrictName' => $user->district ? $user->district->name : null,
                    'PhotoPath' => $user->photo_path,
                ];
            }
            return response()->json($data);
        } 
        return false;
    }
}
