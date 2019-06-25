<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Model\FileType;
use App\Model\FileUpload;

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
  public function GetFileType(){
    $fileTypes = FileType::select('id as value','fileTypeName as text')->orderBy('fileTypeName')->get();
        return response()->json($fileTypes);
  }
  public function GetUserFileById(){
    $adminFile=FileUpload::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
    return response()->json($adminFile);
  }
  public function UploadFile(Request $request) {
    if ($request->file) {
      $file = $request->file;
      $uploadob= $data = json_decode($request->title,true);
      $photo_directory = 'upload/file/';
      $photo_path = $photo_directory . time() . "-" . $file->getClientOriginalName();
      $file->move($photo_directory, $photo_path);
      // $photo_path = Storage::putFile('upload/gallary', $request->file('file'));
      $uploadfile = new FileUpload();
      $uploadfile->file_title = $uploadob['file_title'];
      $uploadfile->file_path = $photo_path;
      $uploadfile->user_id = Auth::id();
      $uploadfile->fileTypeId =$uploadob['fileTypeId'];
      $uploadfile->save();
      return true;
    }
    return false;
  }
}
