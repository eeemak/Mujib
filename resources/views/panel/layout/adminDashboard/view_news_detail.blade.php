@extends('panel.layout.adminDashboard.master')
@section('content')
<div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body posts">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="post-item">
                                <div class="post-title" ng-mouseover="showEditButton=true" ng-mouseleave="showEditButton=false">
                                    @{{blogPostOb.Title}} <a ng-show="showEditButton && blogPostOb.UserId===globalUserInfo.UserId" href="/BlogPost/EditPost?id=@{{blogPostOb.Id}}" class="btn btn-default btn-rounded  pull-right"><i class="fa fa-edit"></i></a>
                                </div>
                                <div class="post-date"><span class="fa fa-calendar"></span>  @{{blogPostOb.AddedDate| dateFilter | date}}  / <a href="pages-profile.html">by @{{blogPostOb.AuthorName}}</a></div>
                                <div class="post-text">
                                    <img ng-if="blogPostOb.TempSrc !=null" src="@{{blogPostOb.TempSrc}}" class="img-responsive img-text" style="height:225px" />
                                    <p compile="blogPostOb.PostText"></p>
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