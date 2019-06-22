@extends('panel.public.master')
@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2" style="margin-top: 64px;margin-bottom: 60px;">
        <div ng-form="registerForm">
            <div class="sign-inner">
                <div class="text-right">
                    <h3 class="first-child" style="font-size:34px;color:#9d2118;margin-bottom: 0px;">আপনার অ্যাকাউন্ট</h3>
                    <span style="color:#000;font-weight:bold">নিবন্ধন করুন</span>
                </div>
                    <hr style="background: #000;padding: 3px;float:right;width: 67px;margin-top: 5px;" />
                <form action="{{route('attempt_register')}}" class="form-horizontal" method="post" autocomplete="off">
                    @csrf
                    @method('POST')
                    <div class="form-group" show-errors>
                        <label class="sr-only">Your Name</label>
                        <div class="show-message">
                            <input type="text" name="full_name" class="form-control" name="Full Name" ng-model="registerModel.FullName" placeholder="Your full name">
                        </div>
                    </div>
                    <div class="form-group" show-errors>
                        <label class="sr-only">Enter contact no</label>
                        <div class="show-message">
                            <input type="text" name="phone" class="form-control" only-numbers name="ContactNo" ng-model="registerModel.Phone" placeholder="Your contact no (contact no will be user name)" ng-blur="CheckUserAlreadyExist()" />
                            <span ng-show="userAlreadyExist" style="color:red">@{{userAlreadyExistErrorMessage}}</span>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-sm-6" show-errors>
                                <label class="sr-only">Enter password</label>
                                <div class="show-message">
                                    <input type="password" name="password" class="form-control margin-bottom-xs" ng-model="registerModel.Password" name="Password" placeholder="Password" data-toggle="popover" data-placement="left" data-trigger="focus" data-content="Enter a good password here." data-original-title="Password">
                                </div>
                            </div>
                            <div class="col-sm-6" show-errors>
                                <label class="sr-only">Repeat password</label>
                                <div class="show-message">
                                    <input type="password" name="password_confirmation" class="form-control" name="ConfirmPassword" ng-model="registerModel.ConfirmPassword" placeholder="Repeat Password" data-toggle="popover" data-trigger="focus" data-content="Confirm your password here." data-original-title="Repeat Password">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group" show-errors>
                        <div class="show-message">
                            <select name="district_id" class="form-control" ng-model="registerModel.DistrictId"
                                    ng-options="item.id as item.name for item in districtList" id="DistrictId"
                                    name="District" ng-change="getThana()">
                                <option value="">Select District</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" show-errors>
                        <div class="show-message">
                            <select name="thana_id" class="form-control" ng-model="registerModel.ThanaId"
                                    ng-options="item.id as item.name for item in thanaList" id="ThanaId"
                                    name="Thana" ng-change="getPoliceStation()">
                                <option value="">Select Thana</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" show-errors>
                        <div class="show-message">
                            <select name="police_station_id" class="form-control" ng-model="registerModel.PoliceStationId"
                                    ng-options="item.id as item.name for item in policeStationList" id="PoliceStationId"
                                    name="PoliceStation" ng-change="getVillage()">
                                <option value="">Select Union</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <select name="village_id" class="form-control" ng-model="registerModel.VillageId"
                                ng-options="item.id as item.name for item in villageList" id="VillageId"
                                name="Village" tabindex="1">
                            <option value="">Select Village</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <div>
                            <button type="submit" class="btn btn-theme-primaryfocus" ng-click="showNewVillage()">Create New Village</button>
                        </div>
                    </div>
                    <div class="form-group" ng-show="showNewVillageField &&registerModel.VillageId===null">
                        <label class="sr-only">New Village</label>
                        <div>
                            <input type="text" class="form-control" name="ContactNo" ng-model="registerModel.NewVillageName" placeholder="Your Village (If not found on Village Select)" data-toggle="popover" data-placement="left" data-trigger="focus" data-content="Enter your new village here." data-original-title="New Village">
                        </div>
                    </div>
                    <div class="form-group" show-errors>
                        <div class="show-message">
                            <select class="form-control" ng-model="registerModel.ProfessionTypeId"
                                    ng-options="item.id as item.professionTypeName for item in professionTypeList" id="ProfessionId"
                                    name="Village" tabindex="1">
                                <option value="">Select Your Profession</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" class="ha-btn-small">প্রবেশ</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection