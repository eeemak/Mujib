<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Model\Post;
use App\Model\PostWithCategory;

class NewsPostController extends Controller
{

  public function index()
  {
    return redirect()->route('news-panel');
  }
  public function viewNews()
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
  public function SaveNews(Request $request) {
    //return $request->all();
    if ($request->file != 'null') {
      $file = $request->file;
      $allow_extensions = ['jpg', 'jpeg', 'png', 'pdf'];
      $file_extension = $file->getClientOriginalExtension();
      if(!in_array($file_extension, $allow_extensions)){
        return response()->json(['error'=>true]);
      }
      $file_directory = 'upload/files/';
      $file_path = $file_directory . time() . "-" . $file->getClientOriginalName();
      $file->move($file_directory, $file_path);
    }else{
      $file_extension = null;
      $file_path = null;
    }
    $post = new Post();

    $newsPostOb = json_decode($request->newsPostOb, true);
    $postCategory=json_decode($request->newsPostCategory, true);
    $post->title = $newsPostOb['Title'];
    $post->post_detail = $newsPostOb['PostDetail'];
    $post->short_post = $newsPostOb['ShortPost'];
    $post->post_types_id = 1;
    $post->file_path = $file_path;
    $post->user_id = Auth::id();
    $post->file_extension = $file_extension;
    $post->save();
    $post->post_categories()->sync($postCategory);
    // $postWithCategoryList = [];
    // foreach ($postCategory as $item) {
    //   $postWithCat = new PostWithCategory();
    //   $postWithCat->post_category_id = $item;
    //   $postWithCat->post_id=  $post->id;
    //   $postWithCategoryList[]=$postWithCat;
    // }
    // $post->post_categories()->saveMany($postWithCategoryList);
    return response()->json($post);
  }
  public function DeleteNewsPostById($id){
    $uploadfile = FileUpload::find($id);
    unlink($uploadfile->file_path);
    $uploadfile->delete();
    return response()->json($uploadfile);
  }
}
