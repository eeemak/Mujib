<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Model\Post;
use App\Model\PostWithCategory;
use App\Http\Resources\PostResource;
use App\Model\PostCategory;
use App\Http\Resources\CommentResource;

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
    $view->with('detailId', $id);
    return $view;
  }
  public function viewEditNews($id)
  {
    $view = view('panel.layout.adminDashboard.view_news_edit');
    $view->with('ControllerName', "EditNewsPostController");
    $view->with('detailId', $id);
    return $view;
  }
  public function GetNewsPostById($id){
    return new PostResource(Post::find($id));
  }
  public function GetAllNewsPosts($take){
    return PostResource::collection(Post::where('post_type_id', 1)->where('user_id', Auth::id())->orderBy('title')->paginate($take));
  }
  public function GetAllPublicNewsPosts($take){
    return PostResource::collection(Post::where('post_type_id', 1)->orderBy('title')->paginate($take));
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
  public function UpdateNews($id, Request $request) {   
    $post = Post::find($id);                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                  
    if ($request->file != 'null') {
      $file = $request->file;
      $allow_extensions = ['jpg', 'jpeg', 'png', 'pdf'];
      $file_extension = $file->getClientOriginalExtension();
      if(!in_array($file_extension, $allow_extensions)){
        return response()->json(['error'=>true]);
      }
      $file_directory = 'upload/files/';
      $file_path = $file_directory . time() . "-" . $file->getClientOriginalName();
      $post->file_path ? unlink($post->file_path) : null;
      $file->move($file_directory, $file_path);
      $post->file_path = $file_path;
      $post->file_extension = $file_extension;
    }
    $newsPostOb = json_decode($request->newsPostOb, true);
    $postCategory=json_decode($request->newsPostCategory, true);
    $post->title = $newsPostOb['Title'];
    $post->post_detail = $newsPostOb['PostDetail'];
    $post->short_post = $newsPostOb['ShortPost'];
    $post->update();
    $post->post_categories()->sync($postCategory);
    return response()->json($post);
  }
  public function DeletePost($id){
    $news_post = Post::find($id);
    $news_post->file_path ? unlink($news_post->file_path) : null;
    $news_post->delete();
    return response()->json($news_post);
  }
  public function GetCommentListWithPostId(Request $request){
    $post = Post::find($request->postId);
    // return response()->json($post->comments);
    return CommentResource::collection($post->comments);
  }
  public function CommentInsert(Request $request){
    $post = Post::find($request->PostId);
    $comment = Auth::user()->comment($post, $request->CommentText, 0, $request->ParentId);
    return $comment;
  }

}
