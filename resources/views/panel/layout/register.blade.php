@extends('panel.public.master')
@section('content')
<div class="row">
    <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2" style="margin-top: 20px;margin-bottom: 60px;">
        <div>
            @include('panel.layout.messages')
            <div class="sign-inner">
                <div class="col-sm-12">
                        <div class="text-right">
                                <h3 class="first-child" style="font-size:34px;color:#9d2118;margin-bottom: 0px;">আপনার অ্যাকাউন্ট</h3>
                                <span style="color:#000;font-weight:bold">নিবন্ধন করুন</span>
                            </div>
                            <hr style="background: #000;padding: 3px;float:right;width: 67px;margin-top: 5px;" />
                </div>
               <div class="col-sm-12">
                    <form action="{{route('attempt_register')}}" class="form-horizontal" method="post" autocomplete="off">
                            @csrf
                            @method('POST')
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group" show-errors>
                                        <label class="sr-only">Your Name</label>
                                        <div class="show-message">
                                            <input type="text" style="width: 100%" name="full_name" class="form-control" name="Full Name" ng-model="registerModel.FullName" placeholder="Your full name">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group" show-errors>
                                        <label class="sr-only">Enter contact no</label>
                                        <div class="show-message">
                                            <input type="text" style="width: 100%" name="phone" class="form-control" only-numbers name="ContactNo" ng-model="registerModel.Phone" placeholder="Mobile number" ng-blur="CheckUserAlreadyExist()" />
                                            <span ng-show="userAlreadyExist" style="color:red">@{{userAlreadyExistErrorMessage}}</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group" show-errors>
                                        <label class="sr-only">Enter password</label>
                                        <div class="show-message">
                                            <input type="password" name="password" style="width: 100%" class="form-control" ng-model="registerModel.Password" name="Password" placeholder="Password" data-toggle="popover" data-placement="left" data-trigger="focus" data-content="Enter a good password here." data-original-title="Password">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group" show-errors>
                                        <label class="sr-only">Repeat password</label>
                                        <div class="show-message">
                                            <input type="password" name="password_confirmation" style="width: 100%" class="form-control" name="ConfirmPassword" ng-model="registerModel.ConfirmPassword" placeholder="Repeat Password" data-toggle="popover" data-trigger="focus" data-content="Confirm your password here." data-original-title="Repeat Password">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group" show-errors>
                                        <div class="show-message">
                                            <select name="district_id" class="form-control select2" ng-model="registerModel.DistrictId" id="DistrictId" ng-change="getThana()">
                                                <option value="">Select District</option>
                                                <option ng-repeat="item in districtList" value="@{{ item.id }}">@{{ item.name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-12">
                                    <div class="form-group" show-errors>
                                        <div class="show-message">
                                            <select name="thana_id" class="form-control select2" ng-model="registerModel.ThanaId" id="ThanaId" ng-change="getPoliceStation()">
                                                <option value="">Select Thana</option>
                                                <option ng-repeat="item in thanaList" value="@{{ item.id }}">@{{ item.name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group" show-errors>
                                        <div class="show-message">
                                            <select name="police_station_id" class="form-control select2" ng-model="registerModel.PoliceStationId" id="PoliceStationId" ng-change="getVillage()">
                                                <option value="">Select Union</option>
                                                <option ng-repeat="item in policeStationList" value="@{{ item.id }}">@{{ item.name }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <select name="village_id" class="form-control select2" ng-model="registerModel.VillageId" id="VillageId" tabindex="1">
                                            <option value="">Select Village</option>
                                            <option ng-repeat="item in villageList" value="@{{ item.id }}">@{{ item.name }}</option>
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="form-group">
                                    <div>
                                        <button type="submit" class="btn btn-theme-primaryfocus" ng-click="showNewVillage()">Create New Village</button>
                                    </div>
                                </div>
                                <div class="form-group" ng-show="showNewVillageField &&registerModel.VillageId===null">
                                    <label class="sr-only">New Village</label>
                                    <div>
                                        <input type="text" class="form-control" name="ContactNo" ng-model="registerModel.NewVillageName" placeholder="Your Village (If not found on Village Select)" data-toggle="popover" data-placement="left" data-trigger="focus" data-content="Enter your new village here." data-original-title="New Village">
                                    </div>
                                </div> --}}
                                
                                <div class="col-sm-12">
                                    <div class="form-group" show-errors>
                                        <div class="show-message">
                                            <select name="ProfessionTypeId" class="form-control select2" ng-model="registerModel.ProfessionTypeId" id="ProfessionId" tabindex="1">
                                                <option value="">Select Your Profession</option>
                                                <option ng-repeat="item in professionTypeList" value="@{{ item.id }}">@{{ item.professionTypeName }}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="ha-btn-small" ng-click="register()">প্রবেশ</button>
                            </div>
                        </form>
               </div>
            </div>
        </div>
    </div>
</div>
@endsection