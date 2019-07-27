@extends('panel.layout.adminDashboard.master')
@section('content')
<div class="row" data-ng-init="getPostDetailList({{$detailId}})">
    <div class="col-md-12">
        <!-- START NEW RECORD -->
        <div class="panel panel-default">
            <div class="panel-body">
                <h3>Something on your mind?</h3>
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input class="form-control" placeholder="Write something" ng-model="newsPostOb.Title" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div>
                                <img ng-if="imageSrc===null" src="~/Images/default.jpg" class="profileImage" />
                                <img ng-if="imageSrc !=null" id="uploadImageSrc" ng-src="@{{imageSrc}}" style=" border: 1px solid; height: 200px; width: 200px;" />
                            </div>
                            <input type="file" id="uploadImage" title="Upload Image" ng-file-select="onFileSelect($files)" class="upload fileinput btn-primary" file-upload multiple />
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="">
                                <summernote config="options" ng-model="newsPostDetail.PostText"></summernote>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <div class="btn-group pull-left">
                                <button class="btn btn-primary"><span class="fa fa-camera"></span></button>
                                <button class="btn btn-primary"><span class="fa fa-map-marker"></span></button>
                                <button class="btn btn-primary"><span class="fa fa-calendar"></span></button>
                            </div>
                            <div class="pull-right">
                                <button class="btn btn-danger" ng-click="Save()"><span class="fa fa-send-o"></span> Update</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END NEW RECORD -->
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