<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;

class AdminDashboardHomeController extends Controller
{

  public function index()
  {
    return redirect()->route('dashboard');
  }
  public function dashboard()
  {
    $view = view('panel.layout.adminDashboard.dashboard');
    $view->with('ControllerName', "EmployeeController");
    return $view;
  }

  public function viewProfile()
  {
    $view = view('panel.layout.adminDashboard.profile.view_profile');
    $view->with('ControllerName', 'AdminDashboardController');
    return $view;
  }
  public function viewUpload()
  {
    return view('panel.layout.adminDashboard.upload.view_upload');
  }

  public function GetUserById()
  {
    $user = Auth::user();
    return response()->json($user);
  }
  public function GetProfessionTypeCbo()
  {
    //Todo:: Get Profession will return all proffesion data;
    return [];
  }
  public function GetUserInstructionList()
  {
    //Todo:: Id will get from login session and data will retun along with this id
    return [];
  }
  public function GetUserMobileList()
  {
    //Todo:: Id will get from login session and data will retun along with this id
    return [];
  }
  public function GetUserFileModelById()
  {
    //Todo:: Id will get from login session and data will retun along with this id
    return [];
  }
  public function UpdateUser(Request $request)
  {
    $user = Auth::user();
    $user->full_name = $request->model['FullName'];
    $user->district_id = $request->model['DistrictId'];
    $user->thana_id = $request->model['ThanaId'];
    $user->police_station_id = $request->model['PoliceStationId'];
    $user->village_id = $request->model['VillageId'];
    $user->parmanent_address = $request->model['PermanentAddress'];
    $user->present_address = $request->model['PresentAddress'];
    $user->about_self = $request->model['AboutSelf'];
    $user->update();
    return response()->json('success');
  }
  public function UploadProfileImage()
  {
    return;
  }
  //   public function UpdateUser(UserProfile model, List<UserInstitutions> userInstructions, List<UserMobile> userMobile, List<EmailLink> emailLink, List<FamilyAndFriendPhone> familyAndFriendPhone, List<SocialLink> socialLink, List<UserLink> userLink)
  //   {
  //      return;
  //   }
}
