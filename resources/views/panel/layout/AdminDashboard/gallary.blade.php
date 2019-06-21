@extends('panel.layout.adminDashboard.master')
@section('content')
<div class="col-md-12">
    <!-- START TABS -->
    <div class="panel panel-default tabs">
        <ul class="nav nav-tabs" role="tablist">
            <li class="active"><a href="#tab-first" role="tab" data-toggle="tab">Photo</a></li>
            {{-- <li><a href="#tab-second" role="tab" data-toggle="tab">All PhotoList</a></li>
            <li><a href="#tab-third" role="tab" data-toggle="tab">All Photo Link</a></li> --}}
        </ul>
        <div class="panel-body tab-content">
            <div class="tab-pane active" id="tab-first">
                <div class="form-horizontal" ng-form="adminPhotoAlbum">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><strong>New Photo</strong></h3>
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
                                            <input type="text" class="form-control" ng-model="adminUploadFileOb.Title" placeholder="Input link title" />
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Photo</label>
                                    <div class="col-md-6 col-xs-12">
                                        <div>
                                                <img ng-if="!imageSrc" src="{{ asset('img/no-image.jpg') }}" class="profileImage img-thumbnail" />
                        <img ng-if="imageSrc" src="@{{ imageSrc }}" class="profileImage img-thumbnail" />
                    </div>
                        <input type="file" id="imageFiles" title="Change Profile Picture" onchange="angular.element(this).scope().uploadImage()" class="upload fileinput btn-primary" file-upload />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label"></label>
                                    <div class="col-md-6 col-xs-12">
                                        <button type="button" class="btn btn-info" ng-click="addUserFile();">
                                            <span class="fa fa-floppy-o"></span> Save
                                        </button>
                     
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                             
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title"><strong>My Photo</strong></h3>
                            <ul class="panel-controls">
                                <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                            </ul>
                        </div>
                        <div class="panel-body posts ha-masanomy-grid">
                            <div class="row">
                                <div class="column-3" dir-paginate="x in userFeaturePhotoFileList | itemsPerPage:UserFeaturePhotoFileListSearchParameters.PageSize" current-page="UserFeaturePhotoFileListSearchParameters.PageNo" pagination-id="metaData.name + 'userFeaturePhotoFileList'" total-items='UserFeaturePhotoFileListSearchParameters.Total_Count'>
                                    <a href="@{{x.Link}}" title="@{{x.Title}}">
                                        <img src="@{{x.TempSrc}}" class="img-thumbnail img-responsive" width="304" height="236">
                                    </a>
                                    <h4>@{{x.Title}}</h4>
                                    <div class="ha-space"></div>
                                    <button type="button" class="btn btn-danger" ng-click="deleteUserFile(x)">
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
            <div class="tab-pane" id="tab-second">
                <div class="form-horizontal">
                    <div class="col-md-12">
                        <span>Total Post: </span> <i class="badge badge-success">@{{AllPhotoListSearchParameters.Total_Count}}</i>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Title</th>
                                    <th>
                                        Link
                                    </th>
                                    <th>View For</th>
                                    <th>Detail</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr dir-paginate="x in allPhotoList| itemsPerPage:AllPhotoListSearchParameters.PageSize" current-page="AllPhotoListSearchParameters.PageNo" pagination-id="metaData.name + 'allPhotoList'" total-items='AllPhotoListSearchParameters.Total_Count'>
                                    <td>
                                        <div>
                                            <img ng-if="x.PhotoPath===null || x.PhotoPath===''" src="~/Images/default.jpg" class=" image img-thumbnail img-circle" style="width:50px;height:50px;" />
                                            <img ng-if="x.PhotoPath !=''" id="uploadImageSrc" ng-src="@{{x.PhotoPath}}" class=" image img-thumbnail img-circle" style="width:50px;height:50px;" alt="@{{x.Title}}" />
                                        </div>
                                    </td>
                                    <td>@{{x.Title}}</td>
                                    <td>
                                        <a href="@{{x.Link}}">@{{x.Link}}</a>
                                    </td>
                                    <td>@{{x.ViewFor}}</td>
                                    <td><a href="#" ng-click="photoDetail(x)" class="btn single-small-btn btn-primary">Detail</a></td>
                                    <td><a href="#" ng-click="deleteUserFileFromAll(x)" class="btn single-small-btn btn-primary">Delete</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <dir-pagination-controls max-size="12"
                                                 pagination-id="metaData.name + 'allPhotoList'"
                                                 direction-links="true"
                                                 boundary-links="true"
                                                 on-page-change="pageAllChangeHandler(newPageNumber)">
                        </dir-pagination-controls>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab-third">
                <div class="form-horizontal">
                    <div class="col-md-12">
                        <span>Total Post: </span> <i class="badge badge-success">@{{UserPublicPhotoLinkSearchParameters.Total_Count}}</i>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Link</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr dir-paginate="x in userPublicPhotoLinkAllList| itemsPerPage:UserPublicPhotoLinkSearchParameters.PageSize" current-page="UserPublicPhotoLinkSearchParameters.PageNo" pagination-id="metaData.name + 'userPublicPhotoLinkAllList'" total-items='UserPublicPhotoLinkSearchParameters.Total_Count'>
                                    <td>
                                        <a href="@{{x.Link}}" target="_blank">@{{x.Title}}</a>
                                    </td>
                                    <td>
                                        <a href="@{{x.Link}}" target="_blank">@{{x.Link}}</a>
                                    </td>
                                    <td><a href="#" ng-click="deleteUserPhotoLink(x)" class="btn single-small-btn btn-primary">Delete</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-12">
                        <dir-pagination-controls max-size="12"
                                                 pagination-id="metaData.name + 'userPublicPhotoLinkAllList'"
                                                 direction-links="true"
                                                 boundary-links="true"
                                                 on-page-change="pageAllChangeHandler(newPageNumber)">
                        </dir-pagination-controls>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END TABS -->
</div>

@endsection