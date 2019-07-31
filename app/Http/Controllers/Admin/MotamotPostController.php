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

class MotamotPostController extends Controller
{

  public function index()
  {
    return redirect()->route('motamot-panel');
  }
  public function viewMotamot()
  {
    $view = view('panel.layout.adminDashboard.view_motamot');
    $view->with('ControllerName', "MotamotPostController");
    return $view;
  }
    public function viewDetailmotamot($id)
  {
    $view = view('panel.layout.adminDashboard.view_motamot_detail');
    $view->with('ControllerName', "DetailMotamotPostController");
    $view->with('detailId', $id);
    return $view;
  }
  public function viewEditMotamot($id)
  {
    $view = view('panel.layout.adminDashboard.view_motamot_edit');
    $view->with('ControllerName', "EditMotamotPostController");
    $view->with('detailId', $id);
    return $view;
  }
  public function GetMotamotPostById($id){
    return new PostResource(Post::find($id));
  }
  public function GetAllMotamotPosts($take){
    return PostResource::collection(Post::where('post_type_id', 2)->where('user_id', Auth::id())->orderBy('title')->paginate($take));
  }
  public function GetAllPublicMotamotPosts($take){
    return PostResource::collection(Post::where('post_type_id', 2)->orderBy('title')->paginate($take));
  }
  public function GetMotamotPostByCategoryId($id, $take){
    return PostResource::collection(PostCategory::find($id)->posts()->where('post_type_id', 2)->paginate($take));
  }
  public function SaveMotamot(Request $request) {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
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

    $motamotPostOb = json_decode($request->motamotPostOb, true);
    $postCategory=json_decode($request->motamotPostCategory, true);
    $post->title = $motamotPostOb['Title'];
    $post->post_detail = $motamotPostOb['PostDetail'];
    $post->short_post = $motamotPostOb['ShortPost'];
    $post->post_type_id = 2;
    $post->file_path = $file_path;
    $post->user_id = Auth::id();
    $post->file_extension = $file_extension;
    $post->save();
    $post->post_categories()->sync($postCategory);
    return response()->json($post);
  }
  public function UpdateMotamot(Request $request) {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                     
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

    $motamotPostOb = json_decode($request->motamotPostOb, true);
    $postCategory=json_decode($request->motamotPostCategory, true);
    $post->title = $motamotPostOb['Title'];
    $post->post_detail = $motamotPostOb['PostDetail'];
    $post->short_post = $motamotPostOb['ShortPost'];
    if($file_path !=null){
      $post->file_path = $file_path;
      $post->file_extension = $file_extension;
    }
    $post->update();
    $post->post_categories()->sync($postCategory);
    return response()->json($post);
  }
  public function DeleteMotamotPostById($id){
    $uploadfile = FileUpload::find($id);
    unlink($uploadfile->file_path);
    $uploadfile->delete();
    return response()->json($uploadfile);
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
