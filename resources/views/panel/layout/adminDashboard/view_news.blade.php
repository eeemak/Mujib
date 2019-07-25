@extends('panel.layout.adminDashboard.master')
@section('content')
<div class="row">
    <!-- START TABS -->
    <div class="panel panel-default tabs">
        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#tab-first" role="tab" data-toggle="tab">News Post</a></li>
            <li><a href="#tab-second" role="tab" data-toggle="tab">All PostList</a></li>
        </ul>
        <div class="panel-body tab-content">
            <div class="tab-pane active" id="tab-first">
                <div class="col-md-12">
                    <!-- START PANEL WITH CONTROL CLASSES -->
                    <div class="panel panel-warning">
                        <div class="panel-heading">
                            <h3 class="panel-title">Add new news</h3>
                            <ul class="panel-controls">
                                <li><a href="#" class="panel-fullscreen"><span class="fa fa-expand"></span></a></li>
                                <li><a href="#" class="panel-collapse"><span class="fa fa-angle-down"></span></a></li>
                                <li><a href="#" class="panel-refresh"><span class="fa fa-refresh"></span></a></li>
                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                            </ul>
                        </div>
                        <div class="panel-body">
                            <div class="panel-body">
                                <form class="form-horizontal" role="form">
                                    <div class="form-group">
                                            <label for="title">News Title:</label>
                                        <div class="col-md-12">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input class="form-control" name="title" placeholder="Write something" ng-model="newsPostOb.Title" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-6">
                                            <div>
                                                <img ng-if="imageSrc===null" src="{{ asset('img/default.jpg') }}" class="profileImage" />
                                                <img ng-if="imageSrc !=null" id="uploadImageSrc" ng-src="@{{imageSrc}}" style=" border: 1px solid; height: 200px; width: 200px;" />
                                            </div>
                                            <input type="file" id="uploadImage" title="Upload Image" ng-file-select="onFileSelect($files)" class="upload fileinput btn-primary" file-upload multiple />
                                        </div>
                                        <div class="col-md-6">
<div>
<div ng-repeat="x in postCategoryList">
        <div class="checkbox">
                <label><input type="checkbox" ng-model="x.value">{{x.text}}</label>
              </div>
</div>
</div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <div class="">
                                                <summernote config="options" ng-model="newsPostDetail.PostDetail"></summernote>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                            <label for="shortdescription">News Short Description:</label>
                                            <div class="col-md-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon text-area-input-group-addon"><span class="fa fa-pencil"></span></span>
                                                    <textarea class="form-control" rows="5" name="shortdescription" ng-model="newsPostOb.ShortPost" id="shortdescription" placeholder="Write something"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                </form>
                            </div>
                        </div>
                        <div class="panel-footer">
                                <div class="pull-right">
                                        <button class="btn btn-danger" ng-click="Save()"><span class="fa fa-send-o"></span> POST</button>
                                    </div>
                        </div>
                    </div>
                    <!-- END PANEL WITH CONTROL CLASSES -->
                    <div class="panel panel-default">
                        <div class="panel-body posts">

                            <div class="row" dir-paginate="x in getAllPersonalnewsPostList | itemsPerPage:PostListSearchParameters.PageSize" current-page="PostListSearchParameters.PageNo" pagination-id="metaData.name + 'getAllPostList'" total-items='PostListSearchParameters.Total_Count'>
                                <div class="col-md-12">
                                    <div class="post-item">
                                        <div class="post-title">
                                            <a class="col-sm-11" href="/newsPost/AdminPostDetail?id=@{{x.Id}}">@{{x.Title}}</a>
                                            <div class="dropdown col-sm-1" ng-show="x.UserId===globalUserInfo.UserId">
                                                <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                                                    ...
                                                </button>
                                                <ul class="dropdown-menu">
                                                    <li><a href="/newsPost/EditAdminPost?id=@{{x.Id}}" title="edit post">Edit</a></li>
                                                    <li><a style="cursor:pointer" ng-click="deletePost(x.Id)" title="delete post">Delete</a></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="post-date"><span class="fa fa-calendar"></span>  @{{x.AddedDate| haDateFilter | date}}  / <a href="pages-profile.html">by @{{x.AuthorName}}</a></div>
                                        <div class="post-text">
                                            <img ng-if="x.TempSrc !=null" src="@{{x.TempSrc}}" class="img-responsive img-text" style="height:225px" />
                                            <p compile="truncString(x.PostText,1500,'...')"></p>
                                        </div>
                                        <div class="post-row">
                                            <div class="post-info">
                                                <span class="fa fa-thumbs-up"></span> 15 - <span class="fa fa-eye"></span> 15,332 - <span class="fa fa-star"></span> 322
                                            </div>
                                            <a href="/newsPost/AdminPostDetail?id=@{{x.Id}}" class="btn btn-default btn-rounded pull-right">Read more &RightArrow;</a>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 pagination pagination-sm pull-right push-down-20">
                        <dir-pagination-controls max-size="10"
                                                 pagination-id="metaData.name + 'getAllPostList'"
                                                 direction-links="true"
                                                 boundary-links="true"
                                                 @*template-url="dirPagination.tpl.cshtml"*@
                                                 on-page-change="pageChangeHandler(newPageNumber)">
                        </dir-pagination-controls>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab-second">
                <div class="form-horizontal">
                    <div class="col-md-12">
                        <span>Total Post: </span> <i class="badge badge-success">@{{allnewsPostListSearchParameters.Total_Count}}</i>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>View For</th>
                                    <th>Detail</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr dir-paginate="x in allnewsPostList| itemsPerPage:allnewsPostListSearchParameters.PageSize" current-page="allnewsPostListSearchParameters.PageNo" pagination-id="metaData.name + 'allnewsPostList'" total-items='allnewsPostListSearchParameters.Total_Count'>
                                    <td>
                                        <div>
                                            <img ng-if="x.TempSrc===null || x.TempSrc===''" src="~/Images/default.jpg" class=" image img-thumbnail img-circle" style="width:11%" />
                                            <img ng-if="x.TempSrc !=''" id="uploadImageSrc" ng-src="@{{x.TempSrc}}" class=" image img-thumbnail img-circle" style="width:11%" alt="@{{x.Title}}" />
                                        </div>
                                    </td>
                                    <td>@{{x.Title}}</td>
                                    <td>@{{x.ViewFor}}</td>
                                    <td><a href="#" ng-click="getPostDetail(x)" class="btn single-small-btn btn-primary">Detail</a></td>
                                    <td><a href="#" ng-click="deletePost(x.Id)" class="btn single-small-btn btn-primary">Delete</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <dir-pagination-controls max-size="10"
                                                 pagination-id="metaData.name + 'allnewsPostList'"
                                                 direction-links="true"
                                                 boundary-links="true"
                                                 on-page-change="pageAllnewsPostChangeHandler(newPageNumber)">
                        </dir-pagination-controls>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END TABS -->
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
        $("#file-simple").fileinput({
                showUpload: false,
                showCaption: false,
                browseClass: "btn btn-danger",
                fileType: "any"
        });            
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