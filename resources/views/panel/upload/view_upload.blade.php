@extends('panel.layout.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <!-- START TABS -->
        <div class="panel panel-default tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#tab-first" role="tab" data-toggle="tab">Add management</a></li>
            </ul>
            <div class="panel-body tab-content">
                <div class="tab-pane active" id="tab-first">
                    <div class="form-horizontal" ng-form="addVertiseForm">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Add New Post</strong></h3>
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-xs-12 control-label">Add Type</label>
                                        <div class="col-md-6 col-xs-12">
                                            <select class="form-control" ng-model="addVertise.AddvertiseCategoryId"
                                                    ng-options="item.Value as item.Text for item in addvertiseCategoryList" id="fileTypeId"
                                                    name="Document">
                                                <option value="">Select Advertise Type</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <input class="form-control" type="hidden" ng-model="addVertise.Id" id="example-tel-input">
                                        <label for="example-tel-input" class="col-md-3 col-xs-12 control-label">Title</label>
                                        <div class="col-md-6 col-xs-12">
                                            <input class="form-control" type="text" ng-model="addVertise.Title" id="example-tel-input">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Description</label>
                                        <div class="col-md-6 col-xs-12">
                                            <textarea class="form-control" rows="10" ng-model="addVertise.Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <input class="form-control" type="hidden" ng-model="addVertise.Id" id="example-tel-input">
                                        <label for="example-tel-input" class="col-md-3 col-xs-12 control-label">Link</label>
                                        <div class="col-md-6 col-xs-12">
                                            <input class="form-control" type="text" ng-model="addVertise.Link" id="example-tel-input">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Photo</label>
                                        <div class="col-md-6 col-xs-12">
                                            <div>
                                                <img ng-if="imageSrc===null" src="~/Images/default.jpg" class="profileImage" />
                                                <img ng-if="imageSrc !=null" id="uploadImageSrc" ng-src="@{{imageSrc}}" style="border: 1px solid; height: 200px !important; width: 200px !important;" />
                                            </div>
                                            <input type="file" id="uploadImage" title="Upload Image" ng-file-select="onFileSelect($files)" class="upload fileinput btn-primary" file-upload multiple />
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <button type="button" class="btn btn-success" ng-click="saveAdvertise()">
                                        <span class="fa fa-send-o"></span> POST
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Add List</strong></h3>
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>
                                </div>
                                <div class="panel-body posts">
                                    <div class="row">
                                        <div class="form-horizontal">
                                            <div class="col-md-12">
                                                <span>Total Post: </span> <i class="badge badge-success">@{{addvertiseListSearchParameters.Total_Count}}</i>
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Image</th>
                                                            <th>Title</th>
                                                            <th>Description</th>
                                                            <th>Category</th>
                                                            <th>Detail</th>
                                                            <th>Edit</th>
                                                            <th>Delete</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr dir-paginate="x in addvertiseList| itemsPerPage:addvertiseListSearchParameters.PageSize" current-page="addvertiseListSearchParameters.PageNo" pagination-id="metaData.name + 'addvertiseList'" total-items='addvertiseListSearchParameters.Total_Count'>
                                                            <td>
                                                                <div>
                                                                    <img ng-if="x.TempSrc===null || x.TempSrc===''" src="~/Images/default.jpg" class=" image img-thumbnail img-circle" style="width:11%" />
                                                                    <img ng-if="x.TempSrc !=''" id="uploadImageSrc" ng-src="@{{x.TempSrc}}" class=" image img-thumbnail img-circle" style="width:11%" alt="@{{x.Title}}" />
                                                                </div>
                                                            </td>
                                                            <td>@{{x.Title}}</td>
                                                            <td>@{{x.Description}}</td>
                                                            <td>@{{x.AddvertiseCategoryName}}</td>
                                                            <td><a href="#" ng-click="postDetail(x)" class="btn single-small-btn btn-primary">Detail</a></td>
                                                            <td><a href="#" ng-click="getEditData(x)" class="btn single-small-btn btn-primary">Edit</a></td>
                                                            <td><a href="#" ng-click="deleteAdd($index,x.Id)" class="btn single-small-btn btn-primary">Delete</a></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                            <div class="col-md-12">
                                                <dir-pagination-controls max-size="10"
                                                                         pagination-id="metaData.name + 'addvertiseList'"
                                                                         direction-links="true"
                                                                         boundary-links="true"
                                                                         on-page-change="pageChangeHandler(newPageNumber)">
                                                </dir-pagination-controls>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- END TABS -->
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
                    <div class="form-horizontal" ng-form="addVertiseEditForm">
                        <div class="col-md-12">
                            <div class="post-item">
                                <div class="post-title">
                                    @{{postDetailOb.Title}}
                                </div>
                                <div class="post-text">
                                    <img src="@{{postDetailOb.TempSrc}}" class="img-responsive img-text" style="height:225px" />
                                    <p compile="postDetailOb.Description"></p>
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
</div>﻿
<div class="modal" id="modal_edit" tabindex="-1" role="dialog" aria-labelledby="defModalHead" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="defModalHead">Post Detail</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="form-horizontal" ng-form="editVertiseForm">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <h3 class="panel-title"><strong>Add New Post</strong></h3>
                                    <ul class="panel-controls">
                                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                    </ul>
                                </div>
                                <div class="panel-body">
                                    <div class="form-group row">
                                        <label class="col-md-3 col-xs-12 control-label">Add Type</label>
                                        <div class="col-md-6 col-xs-12">
                                            <select class="form-control" ng-model="postDataForEdit.AddvertiseCategoryId"
                                                    ng-options="item.Value as item.Text for item in addvertiseCategoryList" id="fileTypeId"
                                                    name="Document">
                                                <option value="">Select Advertise Type</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <input class="form-control" type="hidden" ng-model="postDataForEdit.Id" id="example-tel-input">
                                        <label for="example-tel-input" class="col-md-3 col-xs-12 control-label">Title</label>
                                        <div class="col-md-6 col-xs-12">
                                            <input class="form-control" type="text" ng-model="postDataForEdit.Title" id="example-tel-input">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Description</label>
                                        <div class="col-md-6 col-xs-12">
                                            <textarea class="form-control" rows="10" ng-model="postDataForEdit.Description"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label for="example-tel-input" class="col-md-3 col-xs-12 control-label">Link</label>
                                        <div class="col-md-6 col-xs-12">
                                            <input class="form-control" type="text" ng-model="postDataForEdit.Link" id="example-tel-input">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Photo</label>
                                        <div class="col-md-6 col-xs-12">
                                            <div>
                                                <img ng-if="postDataForEdit.imageSrc===null" src="~/Images/default.jpg" class="profileImage" />
                                                <img ng-if="postDataForEdit.imageSrc !=null" id="uploadImageSrc" ng-src="@{{postDataForEdit.imageSrc}}" style=" border: 1px solid; height: 200px; width: 200px;" />
                                            </div>
                                            <input type="file" id="uploadImage" title="Upload Image" ng-file-select="onFileSelect($files)" class="upload fileinput btn-primary" file-upload multiple />
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-footer">
                                    <button type="button" class="btn btn-success" ng-click="editAdvertise()">
                                        <span class="fa fa-send-o"></span> POST
                                    </button>
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
</div>﻿
@endsection