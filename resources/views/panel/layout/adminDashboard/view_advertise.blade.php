@extends('panel.layout.adminDashboard.master')
@section('content')
<div class="row">
    <div class="col-md-12"  ng-init="getAdvertisements()">

        <form class="form-horizontal">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Create Advertise</strong></h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <input class="form-control" type="hidden" ng-model="adminUploadFileOb.Id" id="example-tel-input">
                        <label class="col-md-3 col-xs-12 control-label">Title</label>
                        <div class="col-md-6 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-edit"></span></span>
                                <input type="text" class="form-control" ng-model="adminUploadFileOb.Title" placeholder="Input file title" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Photo</label>
                        <div class="col-md-6 col-xs-12">
                    <div>
            </div>
            <input type="file" id="uploadImage" title="Choose File" ng-file-select="onFileSelect($files)" class="upload fileinput btn-primary" file-upload />
            <p><small>File format: PDF, JPG, PNG</small></p>
        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"></label>
                        <div class="col-md-6 col-xs-12">
                            <button ng-disabled="!adminUploadFileOb.Title || !filedata" type="button" class="btn btn-info" ng-click="uploadFile();">
                                <span class="fa fa-floppy-o"></span> Save
                            </button>
         
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <button class="btn btn-default" ng-click="clear()">Clear Form</button>
                    {{-- <button class="btn btn-primary pull-right" ng-click="SaveDocument()">Submit</button> --}}
                </div>
            </div>
        </form>
    </div>
                    <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>Advertise List</strong></h3>
                            <ul class="panel-controls">
                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                            </ul>
                        </div>
                        <div class="panel-body posts ha-masanomy-grid">
                            <div class="row">
                                <div class="column-3" dir-paginate="x in advertisementList | itemsPerPage:UserFeaturePhotoFileListSearchParameters.PageSize" current-page="UserFeaturePhotoFileListSearchParameters.PageNo" pagination-id="metaData.name + 'userFeaturePhotoFileList'" total-items='UserFeaturePhotoFileListSearchParameters.Total_Count'>
                                    <a href="@{{x.Link}}" title="@{{x.file_title}}">
                                        <img src="/@{{x.file_path}}" class="img-thumbnail img-responsive" width="304" height="236">
                                    </a>
                                    <h4>@{{x.Title}}</h4>
                                    <div class="ha-space"></div>
                                    <button type="button" class="btn btn-danger" ng-click="delete(x.id)">
                                        <span class="fa fa-trash-o"> Delete</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="panel-footer">
                            <dir-pagination-controls max-size="12"
                                                     pagination-id="metaData.name + 'userFeaturePhotoFileList'"
                                                     direction-links="true"
                                                     boundary-links="true"
                                                     on-page-change="pageFeaturePhotoFileChangeHandler(newPageNumber)">
                            </dir-pagination-controls>
                        </div>
                    </div>
                </div>
</div>
@endsection
@section('script')
{{-- <script>
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
</script> --}}
@endsection