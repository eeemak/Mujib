<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Model\FileType;
use App\Model\FileUpload;

class AdvertiseController extends Controller
{

  public function index()
  {
    return redirect()->route('advertise');
  }
  public function viewAdvertise()
  {
    $view = view('panel.layout.adminDashboard.view_advertise');
    $view->with('ControllerName', "AdvertiseController");
    return $view;
  }
  public function GetFileType(){
    $fileTypes = FileType::select('id as value','fileTypeName as text')->orderBy('fileTypeName')->get();
    return response()->json($fileTypes);
  }
  public function GetUserFileById(){
    $adminFile=FileUpload::where('user_id', Auth::id())->orderBy('id', 'desc')->get();
    $data = [];
    foreach($adminFile as $item){
      $data[] =[
        'id' => $item->id,
        'FileName' => $item->file_title,
        'FileNo' => $item->file_title,
        'FileExtension' => $item->file_extension,
        'FilePath' => $item->file_path,
      ];
    }
    return response()->json($data);
  }
  public function GetUserFileAll(){
    $adminFile=FileUpload::orderBy('id', 'desc')->get();
    $data = [];
    foreach($adminFile as $item){
      $data[] =[
        'id' => $item->id,
        'FileName' => $item->file_title,
        'FileNo' => $item->file_title,
        'FileExtension' => $item->file_extension,
        'FilePath' => $item->file_path,
      ];
    }
    return response()->json($data);
  }
  public function UploadFile(Request $request) {
    if ($request->file) {
      $file = $request->file;
      $allow_extensions = ['jpg', 'jpeg', 'png', 'pdf'];
      $file_extension = $file->getClientOriginalExtension();
      if(!in_array($file_extension, $allow_extensions)){
        return response()->json(['error'=>true]);
      }
      $file_directory = 'upload/files/';
      $file_path = $file_directory . time() . "-" . $file->getClientOriginalName();
      $file->move($file_directory, $file_path);
      $uploadfile = new FileUpload();
      $uploadfile->file_title = $request->title;
      $uploadfile->file_path = $file_path;
      $uploadfile->user_id = Auth::id();
      $uploadfile->file_extension = $file_extension;
      $uploadfile->save();
      return response()->json($uploadfile);
    }
  }
  public function DeleteUserFileById($id){
    $uploadfile = FileUpload::find($id);
    unlink($uploadfile->file_path);
    $uploadfile->delete();
    return response()->json($uploadfile);
  }
}
