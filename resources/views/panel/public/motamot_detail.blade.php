@extends('panel.public.master')
@section('content')
<div class="row" data-ng-init="getPostDetailList({{$detailId}})">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body posts">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="post-item">
                                <div class="post-title" ng-mouseover="showEditButton=true" ng-mouseleave="showEditButton=false">
                                    @{{ motamotPostOb.Title }} <a ng-show="showEditButton" href="/motamot-edit/@{{motamotPostOb.id}}" class="btn btn-default btn-rounded  pull-right"><i class="fa fa-edit"></i></a>
                                </div>
                                <div class="post-date"><span class="fa fa-calendar"></span>  @{{ motamotPostOb.CreatedAt|haDateFilter|date }} / @{{motamotPostOb.CategoryName}} / <a href="pages-profile.html">by @{{motamotPostOb.UserFullName}}</a></div>
                                <div class="post-text">
                                    <img ng-if="motamotPostOb.FilePath" src="/@{{motamotPostOb.FilePath}}" class="img-responsive img-text" style="height:225px" alt="no image" />
                                    <p compile="motamotPostOb.PostDetail"></p>
                                </div>
                                <div class="post-row">
                                    <div class="post-info">
                                        <span class="fa fa-thumbs-up"></span> 15 - <span class="fa fa-eye"></span> 15,332 - <span class="fa fa-star"></span> 322
                                    </div>
                                </div>
                            </div>
                            <h3 class="push-down-20">Comments</h3>
                            <ul class="media-list" ng-repeat="x in commentList">
                                <li class="media">
                                    <a class="pull-left" href="#">
                                        <img class="media-object img-text" width="64" ng-if="x.commented_user.photo_path==''" src="{{ asset('img/no-image.jpg') }}" />
                                        <img class="media-object img-text" width="64" ng-if="x.commented_user.photo_path !=''" src="/@{{ x.commented_user.photo_path }}" alt="John Doe" />
                                    </a>
                                    <div class="media-body">
                                        <h4 class="media-heading">@{{ x.commented_user.full_name }} </h4><span>@{{x.created_at | date}}</span>
                                        <p>@{{ x.comment }}</p>
                                        <a ng-click="showCommentBox(x.id,$index)">Reply</a>
    
                                        <div class="media" ng-repeat="y in x.ChildCommentList">
                                            <a class="pull-left" href="#">
                                                <img class="media-object img-text" width="64" ng-if="x.commented_user.photo_path==''" src="{{ asset('img/no-image.jpg') }}" />
                                                <img class="media-object img-text" width="64" ng-if="x.commented_user.photo_path !=''" src="/@{{ x.commented_user.photo_path }}" alt="John Doe" />
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading">@{{ y.commented_user.full_name }}</h4><span> @{{y.created_at| date}}</span>
                                                <p>@{{y.comment}}</p>
                                                <a ng-click="showCommentBox(x.Id,$index)">Reply</a>
                                            </div>
                                            <div class="form-horizontal col-sm-12" ng-show="y.ShowNewCommentBox">
                                                @if (Auth::check())
                                                <div class="form-group">
                                                    <div class="col-md-10">
                                                        <textarea class="form-control" rows="5" ng-model="commentOb.CommentText"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-12">
                                                        <button type="submit" ng-click="SaveComment()" class="btn btn-danger">Comment</button>
                                                    </div>
                                                </div>
                                                @else
                                                <p>Please <a href="{{ route('login', ['redirect_url'=>Request::url()]) }}">Login</a> to comment</p>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-horizontal col-sm-12" ng-show="x.ShowNewCommentBox">
                                            @if (Auth::check())
                                            <div class="form-group">
                                                <div class="col-md-10">
                                                    <textarea class="form-control" rows="5" ng-model="commentOb.CommentText"></textarea>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-md-12">
                                                    <button type="submit" ng-click="SaveComment()" class="btn btn-danger">Comment</button>
                                                </div>
                                            </div>
                                            @else
                                            <p>Please <a href="{{ route('login', ['redirect_url'=>Request::url()]) }}">Login</a> to reply</p>
                                            @endif
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <h3 class="btn btn-default" ng-hide="IsShowCommentBox" ng-click="showMainCommentBox()">Add New Comment</h3>
                            <div class="form-horizontal col-sm-12" ng-show="IsShowCommentBox">
                                @if (Auth::check())
                                <div class="form-group">
                                    <div class="col-md-10">
                                        <textarea class="form-control" rows="5" ng-model="commentOb.CommentText"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <button type="submit" ng-click="SaveComment()" class="btn btn-danger">Comment</button>
                                    </div>
                                </div>
                                @else
                                <p>Please <a href="{{ route('login', ['redirect_url'=>Request::url()]) }}">Login</a> to comment</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- MODALS -->
<div class="modal" id="modal_basic" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="defModalHead">Post Detail</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-horizontal">
                        <div class="col-md-12">
                            <div class="post-item">
                                <div class="post-title">
                                    @{{postDetailOb.Title}}
                                </div>
                                <div class="post-date"><a href="#">by @{{postDetailOb.AuthorName}}</a></div>
                                <div class="post-text">
                                    <img src="@{{postDetailOb.TempSrc}}" class="img-responsive img-text" style="height:225px" />
                                    <p compile="postDetailOb.PostText"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script>
    $(function(){
        $("#filetree").fileTree({
            root: '/',
            script: 'assets/filetree/jqueryFileTree.php',
            expandSpeed: 100,
            collapseSpeed: 100,
            multiFolder: false                    
        }, function(file) {
            alert(file);
        }, function(dir){
            setTimeout(function(){
                page_content_onresize();
            },200);                    
        });                
    });  
    <!-- Initialize the plugin: -->
    $(document).ready(function() {
        $('#example-getting-started').multiselect();
    });
</script>
@endsection