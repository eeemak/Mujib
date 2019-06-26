@extends('panel.layout.adminDashboard.master')
@section('content')
<div class="row">
    <div class="col-md-12" ng-init="getUserFileAll()">

        <form class="form-horizontal">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Upload File</strong></h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="alert alert-info" role="alert">
                        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <strong>Info! </strong> 
                    </div>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th> Type</th>
                                    <th>Dwonload</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="x in userFileList">
                                    <td><p>@{{x.FileName}}</p></td>
                                    <td>@{{x.FileExtension}}</td>
                                    <td><a href="@{{ x.FilePath }}" ng-click="FileDownload(x)" class="btn single-small-btn btn-primary" download="@{{x.FileName}}" target="_self"><i class="fa fa-cloud-download"></i></a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel-footer">
                </div>
            </div>
        </form>
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
</script>
@endsection