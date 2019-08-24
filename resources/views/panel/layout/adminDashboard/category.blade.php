@extends('panel.layout.adminDashboard.master')
@section('content')
<div class="col-md-12" ng-init="getAllCategories()">
    <div class="form-horizontal" ng-form="adminPhotoAlbum">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><strong>Category</strong></h3>
                    <ul class="panel-controls">
                        <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                    </ul>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <input class="form-control" type="hidden" ng-model="categoryOb.id" id="example-tel-input">
                        <label class="col-md-3 col-xs-12 control-label">Name</label>
                        <div class="col-md-6 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-edit"></span></span>
                                <input type="text" class="form-control" ng-model="categoryOb.name" placeholder="Input link title" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Type</label>
                        <div class="col-md-6 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-edit"></span></span>
                                <select class="form-control select" ng-model="categoryOb.type"
                                                   id="typeId"
                                                    name="Type">
                                                    <option ng-repeat="x in typeList" value="@{{x.Value}}">@{{x.Text}}</option>
                                                <option value="">Select One</option>
                                            </select>
                            </div>
                        </div>
                    </div>


                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"></label>
                        <div class="col-md-6 col-xs-12">
                            <button type="button" class="btn btn-info" ng-click="save();">
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
                <h3 class="panel-title"><strong>Category List</strong></h3>
                <ul class="panel-controls">
                    <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                </ul>
            </div>
            <div class="panel-body posts ha-masanomy-grid">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-repeat="x in categoryList">
                                <td><p>@{{x.name}}</p></td>
                                <td><p>@{{x.type}}</p></td>
                                <td style="width:50px" class="text-center"><button class="btn single-small-btn btn-danger" ng-click="delete(x.id)"><i class="fa fa-trash-o"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <dir-pagination-controls max-size="12"
                                         pagination-id="metaData.name + 'categoryList'"
                                         direction-links="true"
                                         boundary-links="true"
                                         on-page-change="pagecategoryChangeHandler(newPageNumber)">
                </dir-pagination-controls>
            </div>
        </div>
    </div>
</div>

@endsection