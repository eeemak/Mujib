@extends('panel.layout.adminDashboard.master')
@section('content')
<div class="row">
    <div class="col-md-12">

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
                        <strong>Info! </strong> এখানে রাখতে পারেন আপনার অতি দরকারী ডকুমেন্ট-এর ফটোকপি (যেমন, সিভি,  পরিচয়পত্র, ভিজিটিং কার্ড, এনাইডি কার্ড, জন্ম নিবন্ধন, বিবাহ নিবন্ধন, পার্সপোট, ড্রাইভিং লাইসেন্স, জাতীয়তা পরিচয়পত্র, আপনার সার্টিফিকেটসমুহ, ট্রেড লাইসেন্স, টেক্স সার্টিফিকেট, ভেট তথ্য, তথ্য ফরম, মানি রিসিপ্ট, চুক্তপত্র,জরুরী ডকুমেন্ট ফাইলসমুহ ইত্যাদি ইত্যাদি , যা প্রয়োজনে যে-কোন স্থান থেকে প্রিন্ট বা শেয়ারিং করা যাবে। অতিরিক্ত নিরাপত্তার অংশ হিসেবে আপনি ডকুমেন্টগুলি আপনার ইমেইলেও পাঠিয়েও প্রিন্ট করতে পারেন। কাজেই  নিশ্চিন্তে একের পর এক ডকুমেন্ট আপলোড করে নিজ সংরক্ষণে রেখে প্রয়োজনে কাজে লাগান
                    </div>
                </div>
                <div class="panel-body">

                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">File Type</label>
                        <div class="col-md-6 col-xs-12">
                            <select class="form-control " ng-model="userFileType.fileTypeId"
                                    ng-options="item.value as item.text for item in fileTypeList" id="fileTypeId"
                                    name="Document">
                                <option value="">Select File Type</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">File Title</label>
                        <div class="col-md-6 col-xs-12">
                            <div class="input-group">
                                <span class="input-group-addon"><span class="fa fa-pencil"></span></span>
                                <input type="text" class="form-control" ng-model="userFileType.file_title" placeholder="Input file title" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label">Upload File</label>
                        <div class="col-md-6 col-xs-12">
                        <input type="file" id="uploadImage" title="Upload Thumbline" ng-file-select="onFileSelect($files)" class="upload fileinput btn-primary" file-upload multiple />
                    </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-3 col-xs-12 control-label"></label>
                        <div class="col-md-6 col-xs-12">
                            <button type="button" class="btn btn-info" ng-click="SaveDocument()">
                                <span class="fa fa-plus"></span> Add
                            </button>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th> Type</th>
                                    <th>No</th>
                                    <th>Name</th>
                                    <th>Dwonload</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr ng-repeat="x in userFileList|orderBy:$index:true">
                                    <td>@{{x.FileTypeName}}</td>
                                    <td>@{{x.FileNo}}</td>
                                    <td><p>@{{x.FileName}}</p></td>
                                    <td><a href="@{{dwonloadUrl}}" ng-click="FileDownload(x)" class="btn single-small-btn btn-primary" download="@{{x.FileName}}" target="_self"><i class="fa fa-cloud-download"></i></a></td>
                                    <td style="width:50px" class="text-center"><button class="btn single-small-btn btn-danger" ng-click="deleteUserFile(x,$index)"><i class="fa fa-trash-o"></i></button></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="panel-footer">
                    <button class="btn btn-default" ng-click="clear()">Clear Form</button>
                    {{-- <button class="btn btn-primary pull-right" ng-click="SaveDocument()">Submit</button> --}}
                </div>
            </div>
        </form>
    </div>
</div>
@endsection