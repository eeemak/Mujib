@extends('panel.layout.AdminDashboard.master')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <h3><span class="fa fa-mail-forward"></span> Profile Picture</h3>
                <p>Add Your Profile Picture</p>
                <div class="form-group">
                    <div>
                        {{-- <img ng-if="editUserProfile.PhotoPath==''" src="~/Images/no_image.png" class="profileImage img-thumbnail" />
                        <img ng-if="editUserProfile.PhotoPath!=''" src="@{{editUserProfile.PhotoPath}}" class="profileImage img-thumbnail" /> --}}
                    </div>
                    <div class="col-md-12">
                        <input type="file" id="imageFiles" title="Change Profile Picture" onchange="angular.element(this).scope().uploadImage()" class="upload fileinput btn-primary" file-upload multiple />
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <!-- START TABS -->
        <div class="panel panel-default tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="#tab-first" role="tab" data-toggle="tab">General</a></li>
                <li><a href="#tab-second" role="tab" data-toggle="tab">Security</a></li>
            </ul>
            <div class="panel-body tab-content">
                <div class="tab-pane active" id="tab-first">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><strong>General Info</strong> Edit</h3>
                                <ul class="panel-controls">
                                    <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                </ul>
                            </div>
                            <div class="panel-body form-horizontal">
                                <input class="form-control" type="hidden" ng-model="editUserProfile.Id" id="example-text-input">
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Name</label>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                            <input type="text" class="form-control" ng-model="editUserProfile.FullName" placeholder="Input your name" />
                                        </div>
                                    </div>
                                    <span class="text-danger"><i class="fa fa-star"></i></span>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Parmanent Address</label>
                                    <div class="col-md-6 col-xs-12">
                                        <textarea class="form-control" ng-model="editUserProfile.PermanentAddress" rows="5" readonly></textarea>
                                    </div>
                                    <span class="text-danger"><i class="fa fa-star"></i></span>
                                </div>
                                <div class="form-group" ng-if="showAddressEditable===false">
                                    <label class="col-md-3 col-xs-12 control-label"></label>
                                    <div class="col-md-6 col-xs-12">
                                        <button type="button" class="btn btn-info" ng-click="editAddress()">
                                            <span class="fa fa-edit"></span> Edit
                                        </button>
                                    </div>
                                </div>
                                <div class="edit-address" ng-if="showAddressEditable">
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">District</label>
                                        <div class="col-md-6 col-xs-12">
                                            <select class="form-control select" ng-model="editUserProfile.DistrictId"
                                                    ng-options="item.id as item.name for item in districtList" id="DistrictId"
                                                    name="District" ng-change="getThana()">
                                                <option value="">Select One</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Thana</label>
                                        <div class="col-md-6 col-xs-12">
                                            <select class="form-control select" ng-model="editUserProfile.ThanaId"
                                                    ng-options="item.id as item.name for item in thanaList" id="ThanaId"
                                                    name="Thana" ng-change="getPoliceStation()">
                                                <option value="">Select One</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Union</label>
                                        <div class="col-md-6 col-xs-12">
                                            <select class="form-control select" ng-model="editUserProfile.PoliceStationId"
                                                    ng-options="item.id as item.name for item in policeStationList" id="PoliceStationId"
                                                    name="Thana" ng-change="getVillage()">
                                                <option value="">Select One</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Village</label>
                                        <div class="col-md-6 col-xs-12">
                                            <select class="form-control select" ng-model="editUserProfile.VillageId"
                                                    ng-options="item.id as item.name for item in villageList" id="VillageId"
                                                    name="Thana" ng-change="getVillage()" required>
                                                <option value="">Select One</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label"></label>
                                        <div class="col-md-6 col-xs-12">
                                            <button type="button" class="btn btn-info" ng-click="addNewVillage()">
                                                <span class="fa fa-edit"></span>  Add New Village
                                            </button>
                                        </div>
                                    </div>
                                    <div class="form-group" ng-show="showNewVillageField">
                                        <label class="col-md-3 col-xs-12 control-label">New Village</label>
                                        <div class="col-md-6 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" class="form-control" ng-model="editUserProfile.VillageName" placeholder="Input your village name" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Present Address</label>
                                    <div class="col-md-6 col-xs-12">
                                        <textarea class="form-control" rows="5" ng-model="editUserProfile.PresentAddress" readonly></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Mobile No</label>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-mobile-phone"></span></span>
                                            <input type="text" class="form-control" ng-model="editUserProfile.Phone" placeholder="Input your phone no" readonly />
                                        </div>
                                    </div>
                                    <span class="text-danger"><i class="fa fa-star"></i></span>
                                </div>
                                <div ng-repeat="x in userMobileList">
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Mobile No  @{{$index+2}}</label>
                                        <div class="col-md-5 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-mobile-phone"></span></span>
                                                <input type="text" class="form-control" ng-model="x.MobileNo" placeholder="Input your phone no" />
                                            </div>
                                        </div>
                                        <div class="col-md-1 col-xs-12">
                                            <button type="button" class="btn btn-danger single-small-btn" ng-click="deleteMobileNo($index)">
                                                Delete
                                            </button>
                                        </div>
                                    </div>
                                    <br />
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label"></label>
                                    <div class="col-md-6 col-xs-12">
                                        <button type="button" class="btn btn-info" ng-click="addMobileNo()">
                                            <span class="fa fa-plus"></span> Add More Mobile No
                                        </button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">About Self</label>
                                    <div class="col-md-6 col-xs-12">
                                        <textarea class="form-control" rows="5" ng-model="editUserProfile.AboutSelf"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><strong>Profession Info</strong> Edit</h3>
                                <ul class="panel-controls">
                                    <li><a href="#" class="panel-remove"><span class="fa fa-times"></span></a></li>
                                </ul>
                            </div>
                            <div class="panel-body form-horizontal">
                                <input class="form-control" type="hidden" ng-model="editUserProfile.Id" id="example-text-input">
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Profession</label>
                                    <div class="col-md-6 col-xs-12">
                                        <select class="form-control" ng-model="userInstituteList[0].ProfessionTypeId"
                                                ng-options="item.id as item.professionTypeName for item in professionTypeList" id="ProfessionId"
                                                name="Profession" required>
                                            <option value="">Select One</option>
                                        </select>
                                    </div>
                                    <span class="text-danger"><i class="fa fa-star"></i></span>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Institution</label>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-institution"></span></span>
                                            <input type="text" class="form-control" ng-model="userInstituteList[0].InstituteName" placeholder="Input your institute name" />
                                        </div>
                                    </div>
                                    <span class="text-danger"><i class="fa fa-star"></i></span>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Position</label>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-institution"></span></span>
                                            <input type="text" class="form-control" ng-model="userInstituteList[0].Position" placeholder="Input your Position" />
                                        </div>
                                    </div>
                                    <span class="text-danger"><i class="fa fa-star"></i></span>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">JoiningDate</label>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                            <input type="text" ng-model="userInstituteList[0].JoiningDate" datepicker class="form-control datepicker">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">EndDate</label>
                                    <div class="col-md-6 col-xs-12">
                                        <div class="input-group">
                                            <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                            <input type="text" ng-model="userInstituteList[0].EndDate" datepicker class="form-control datepicker">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label">Institue Address</label>
                                    <div class="col-md-6 col-xs-12">
                                        <textarea class="form-control" rows="5" ng-model="userInstituteList[0].Address"></textarea>
                                    </div>
                                    <span class="text-danger"><i class="fa fa-star"></i></span>
                                </div>
                                <div ng-if="userInstituteList.length>1" ng-repeat="x in userInstituteList">
                                    <div ng-if="$index !=0">
                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Profession @{{$index+1}}</label>
                                            <div class="col-md-5 col-xs-12">
                                                <select class="form-control select" ng-model="x.ProfessionTypeId"
                                                        ng-options="item.Value as item.Text for item in professionTypeList" id="ProfessionId"
                                                        name="District" required>
                                                    <option value="">Select One</option>
                                                </select>
                                            </div>
                                            <div class="col-1">
                                                <button type="button" class="btn btn-danger single-small-btn" ng-click="deleteUserInstitute($index)">
                                                    Delete
                                                </button>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Institution</label>
                                            <div class="col-md-6 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-institution"></span></span>
                                                    <input type="text" class="form-control" ng-model="x.InstituteName" placeholder="Input your institute name" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Position</label>
                                            <div class="col-md-6 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-institution"></span></span>
                                                    <input type="text" class="form-control" ng-model="x.Position" placeholder="Input your Position" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">JoiningDate</label>
                                            <div class="col-md-6 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                                    <input type="text" ng-model="x.JoiningDate" datepicker class="form-control datepicker">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">EndDate</label>
                                            <div class="col-md-6 col-xs-12">
                                                <div class="input-group">
                                                    <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
                                                    <input type="text" ng-model="x.EndDate" datepicker class="form-control datepicker">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 col-xs-12 control-label">Institue Address</label>
                                            <div class="col-md-6 col-xs-12">
                                                <textarea class="form-control" rows="5" ng-model="x.Address"></textarea>
                                            </div>
                                        </div>
                                        <br />
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 col-xs-12 control-label"></label>
                                    <div class="col-md-6 col-xs-12">
                                        <button type="button" class="btn btn-info" ng-click="addUserInstitute()">
                                            <span class="fa fa-plus"></span> Add More Institute
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="panel-footer">
                                <button class="btn btn-primary pull-left" ng-click="updateUserProfile()">Submit</button>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <div class="tab-pane" id="tab-second">
                    <!-- START ACCORDION -->
                    <div class="panel-group accordion">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="#accOneColOne">
                                        Change Password
                                    </a>
                                </h4>
                            </div>
                            <div class="panel-body panel-body-open" id="accOneColOne">
                                <div class="form-horizontal" ng-form="passwrodChangeForm">
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Old Password</label>
                                        <div class="col-md-6 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="password" class="form-control" ng-model="changePassOb.OldPassword" placeholder="Input your old password" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">New Password</label>
                                        <div class="col-md-6 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="password" class="form-control" ng-model="changePassOb.NewPassword" placeholder="Input your new password" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">Confirm New Password</label>
                                        <div class="col-md-6 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="password" class="form-control" ng-model="changePassOb.NewPasswordConfirm" placeholder="Input your new password again" />
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary pull-right" ng-click="changePassword()">Update</button>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-info">
                            <div class="panel-heading">
                                <h4 class="panel-title">
                                    <a href="#accOneColTwo">
                                        Change User Id (You can change your Id for once.)
                                    </a>
                                </h4>
                            </div>
                            <div class="panel-body" id="accOneColTwo">
                                <div class="form-horizontal" ng-form="userIdChangeForm">
                                    <div class="form-group">
                                        <label class="col-md-3 col-xs-12 control-label">User Id</label>
                                        <div class="col-md-6 col-xs-12">
                                            <div class="input-group">
                                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                                <input type="text" class="form-control" ng-model="changeUserIdOb.Phone" placeholder="Input your phone no" ng-disabled="editUserProfile.PhoneUpdateCount>0" />
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-primary pull-left" ng-click="changeUserId()" ng-disabled="editUserProfile.PhoneUpdateCount>0">Update</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END ACCORDION -->
                </div>
            </div>
        </div>
        <!-- END TABS -->
    </div>
</div>
@endsection