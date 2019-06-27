<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Model\UserInstitutions;
use Illuminate\Support\Facades\Storage;
use App\Model\Gallary;

class AdminDashboardHomeController extends Controller
{

  public function index()
  {
    return redirect()->route('profile');
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
  public function Gallary()
  {
    $view = view('panel.layout.adminDashboard.gallary');
    $view->with('ControllerName', 'GallaryController');
    return $view;
  }
  public function GetGallaryByUser(){
    $gallaries = Gallary::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
        return response()->json($gallaries);
  }
  public function UploadGallary(Request $request) {
    if ($request->file) {
      $file = $request->file;
      $photo_directory = 'upload/gallary/';
      $photo_path = $photo_directory . time() . "-" . $file->getClientOriginalName();
      $file->move($photo_directory, $photo_path);
      // $photo_path = Storage::putFile('upload/gallary', $request->file('file'));
      $gallary = new Gallary();
      $gallary->title = $request->title;
      $gallary->photo_path = $photo_path;
      $gallary->user_id = Auth::id();
      $gallary->save();
      return $photo_path;
    }
    return false;
  }
public function DeleteGallary(Request $request){
    $gallary = Gallary::find($request->gallaryId);
    // Storage::delete($gallary->photo_path);
    if($gallary->photo_path){
      unlink($gallary->photo_path);
    }
    $gallary->delete();
    return response()->json($gallary);
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
    return $request->input();
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
  public function UploadProfileImage(Request $request)
  {
    if($request->file){
      $file = $request->file;
      $photo_directory = 'upload/profileImg/';
      $photo_path = $photo_directory . time() . "-" . $file->getClientOriginalName();
      $file->move($photo_directory, $photo_path);
      // $photo_path = Storage::putFile('upload/profileImg', $request->file('file'));
      $user = Auth::user();
      // Storage::delete($user->photo_path);
      if($user->photo_path){
        unlink($user->photo_path);
      }
      $user->photo_path = $photo_path;
      $user->update();
      return $photo_path;
    }
    return false;
    
  }
  
  //   public function UpdateUser(UserProfile model, List<UserInstitutions> userInstructions, List<UserMobile> userMobile, List<EmailLink> emailLink, List<FamilyAndFriendPhone> familyAndFriendPhone, List<SocialLink> socialLink, List<UserLink> userLink)
  //   {
  //      return;
  //   }
}
