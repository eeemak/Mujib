<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Model\UserInstitutions;

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

    $user_institutions = [];
    foreach($request->userInstructions as $item){
      $user_institution = new UserInstitutions();
      $user_institution->InstituteName = $item['InstituteName'];
      $user_institution->Position = $item['Position'];
      $user_institution->JoiningDate =\Carbon\Carbon::parse($item['JoiningDate']);
      $user_institution->EndDate = \Carbon\Carbon::parse($item['EndDate']);
      $user_institution->user_id = Auth::id();
      $user_institution->ProfessionTypeId = $item['ProfessionTypeId'];
      $user_institution->Address = $item['Address'];
      $user_institutions[] = $user_institution;
    }
    $user->institution()->delete();
    $user->institution()->saveMany($user_institutions);
    
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
