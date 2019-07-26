<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Model\Post;
use App\Model\PostWithCategory;
use App\Http\Resources\PostResource;
use App\Model\PostCategory;

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
    public function viewDetailNews($id)
  {
    $view = view('panel.layout.adminDashboard.view_news_detail');
    $view->with('ControllerName', "DetailNewsPostController");
    return $view;
  }
  public function GetNewsPostById($id){
    return new PostResource(Post::find($id));
  }
  public function GetAllNewsPosts($take){
    return PostResource::collection(Post::where('post_type_id', 1)->where('user_id', Auth::id())->orderBy('title')->paginate($take));
  }
  public function GetNewsPostByCategoryId($id, $take){
    return PostResource::collection(PostCategory::find($id)->posts()->where('post_type_id', 1)->paginate($take));
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
    $post->post_type_id = 1;
    $post->file_path = $file_path;
    $post->user_id = Auth::id();
    $post->file_extension = $file_extension;
    $post->save();
    $post->post_categories()->sync($postCategory);
    return response()->json($post);
  }
  public function DeleteNewsPostById($id){
    $uploadfile = FileUpload::find($id);
    unlink($uploadfile->file_path);
    $uploadfile->delete();
    return response()->json($uploadfile);
  }

}
