<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Model\NewsPost;

class NewsPostController extends Controller
{

  public function index()
  {
    return redirect()->route('news');
  }
  public function viewUpload()
  {
    $view = view('panel.layout.adminDashboard.view_news');
    $view->with('ControllerName', "NewsPostController");
    return $view;
  }
  public function GetNewsPostById(){
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
  public function GetNewsPostAll(){
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
  public function DeleteNewsPostById($id){
    $uploadfile = FileUpload::find($id);
    unlink($uploadfile->file_path);
    $uploadfile->delete();
    return response()->json($uploadfile);
  }
}
