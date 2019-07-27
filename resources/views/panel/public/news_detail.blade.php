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
                                    @{{newsPostOb.Title}} <a ng-show="showEditButton && newsPostOb.UserId===globalUserInfo.UserId" href="/newsPost/EditPost?id=@{{newsPostOb.Id}}" class="btn btn-default btn-rounded  pull-right"><i class="fa fa-edit"></i></a>
                                </div>
                                <div class="post-date"><span class="fa fa-calendar"></span>  @{{newsPostOb.CreatedAt}} / @{{newsPostOb.CategoryName}} / <a href="pages-profile.html">by @{{newsPostOb.UserFullName}}</a></div>
                                <div class="post-text">
                                    <img ng-if="newsPostOb.FilePath !=null" src="@{{newsPostOb.FilePath}}" class="img-responsive img-text" style="height:225px" />
                                    <div class="bangla-font" compile="newsPostOb.PostDetail"></div>
                                </div>
                                <div class="post-row">
                                    <div class="post-info">
                                        <span class="fa fa-thumbs-up"></span> 15 - <span class="fa fa-eye"></span> 15,332 - <span class="fa fa-star"></span> 322
                                    </div>
                                </div>
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