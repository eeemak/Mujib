'use strict';
AddManageController.$inject = ['$scope', '$rootScope', '$http', '$location', '$routeParams', '$cookies', '$cookieStore', '$filter', 'fileReader'];
function AddManageController($scope, $rootScope, $http, $location, $routeParams, $cookies, $cookieStore, $filter, fileReader) {
    $scope.title = "Add Manage";
    $scope.addVertiseList = [];
    $scope.addVertise = {
        Id:null,
        Title: null,
        Description: null,
        FileId: null,
        FileName: null,
        Link:null,
        Active: null,
        AddvertiseCategoryId: null,
    }
    $scope.addvertiseCategoryList = [];
    $scope.getAdvertiseCategory = function () {
        $http({
            method: 'GET',
            url: '/AdminDashboard/GetAdvertiseCategoryCbo'
        }).then(function successCallback(response) {
            $scope.addvertiseCategoryList = response.data;
        })
    }
    $scope.getAdvertiseCategory();
    $scope.addvertiseListSearchParameters = {
        PageSize: 10,
        Total_Count: 0,
        CurrentPage: 1,
        PageNo: 1
    }
    $scope.getAdvertise = function () {
        $scope.pageChangeHandler = function (num) {
            $scope.addvertiseListSearchParameters.PageNo = num != undefined ? num : 1;
            $http({
                method: 'GET',
                url: '/AdminDashboard/GetAdvertiseList?pageNo=' + $scope.addvertiseListSearchParameters.PageNo + '&pageSize=' + $scope.addvertiseListSearchParameters.PageSize
            }).then(function successCallback(response) {
                if (response.data.Items.length > 0) {
                    angular.forEach(response.data.Items, function (item) {
                        item.TempSrc = getFileUrl(item.FileId, item.FileName);
                    });
                    $scope.addvertiseList = response.data.Items;
                }
                $scope.addvertiseListSearchParameters.Total_Count = response.data.Pager.TotalItems;
            })
        };
        $scope.pageChangeHandler();
    }
    $scope.getAdvertise();
    $scope.postDetailOb = {};
    $scope.postDetail = function (data) {
        if (data.FileId != null) {
            data.TempSrc = getFileUrl(data.FileId, data.FileName);
        }
        $scope.postDetailOb = data;
        angular.element(document.querySelector('#modal_basic')).modal('show');
    }
    //$scope.addvertiseList = [];
    //$scope.getAdvertise = function () {
    //    $http({
    //        method: 'GET',
    //        url: '/AdminDashboard/GetAdvertiseList'
    //    }).then(function successCallback(response) {
    //        if (response.data.length > 0) {
    //            angular.forEach(response.data, function (item) {
    //                item.TempSrc = getFileUrl(item.FileId, item.FileName);
    //            });
    //            $scope.addvertiseList = response.data;
    //        }
    //    })
    //}
    //$scope.getAdvertise();
    $scope.saveAdvertise = function () {
        if ($scope.addVertiseForm.$valid) {
            var formData = new FormData();
            $http({
                method: "post",
                url: '/AdminDashboard/CreateAdd/',
                headers: { 'Content-Type': undefined },
                transformRequest: function (data) {
                    formData.append('AdVertise', angular.toJson(data.AdVertise));
                    for (var i = 0; i < data.addFile.length; i++) {
                        formData.append('addFile[' + i + ']', data.addFile[i]);
                    }
                    return formData;
                },
                data: {
                     'AdVertise': $scope.addVertise
                    , 'addFile': $scope.inputFileList
                },
            }).then(function successCallback(response) {
                if (response.data.Error == true) {
                    myFunction(response.data.Message);
                }
                else {
                    myFunction(response.data.Message);
                    $scope.getAdvertise();
                    $scope.addVertise = {
                        Id: null,
                        Title: null,
                        Description: null,
                        FileId: null,
                        FileName: null,
                        Active: null,
                        AddvertiseCategoryId: null,
                    }
                }
            }), function errorCallBack(response) {
                showResult(response.data.Message, 'failure');
            }
        }
    }
    $scope.getEditData = function (data) {
        if (data.FileId != null) {
            data.imageSrc = getFileUrl(data.FileId, data.FileName);
        }
        $scope.postDataForEdit = data;
        angular.element(document.querySelector('#modal_edit')).modal('show');
    }
    $scope.editAdvertise = function () {
        if ($scope.editVertiseForm.$valid) {
            var formData = new FormData();
            $http({
                method: "post",
                url: '/AdminDashboard/CreateAdd/',
                headers: { 'Content-Type': undefined },
                transformRequest: function (data) {
                    formData.append('AdVertise', angular.toJson(data.AdVertise));
                    for (var i = 0; i < data.addFile.length; i++) {
                        formData.append('addFile[' + i + ']', data.addFile[i]);
                    }
                    return formData;
                },
                data: {
                    'AdVertise': $scope.postDataForEdit
                    , 'addFile': $scope.inputFileList
                },
            }).then(function successCallback(response) {
                if (response.data.Error == true) {
                    myFunction(response.data.Message);
                }
                else {
                    myFunction(response.data.Message);
        angular.element(document.querySelector('#modal_edit')).modal('hide');
                    $scope.getAdvertise();
                    $scope.postDataForEdit = {
                    }
                }
            }), function errorCallBack(response) {
                showResult(response.data.Message, 'failure');
            }
        }
    }
    $scope.imageSrc = null;
    $scope.filedata = null;
    $("#uploadImage").change(function () {
        $scope.filedata = this.files[0];
        $scope.addUserFile();
    });
    $scope.getFile = function () {
        $scope.progress = 0;
        fileReader.readAsDataUrl($scope.file, $scope)
            .then(function (result) {
                $scope.imageSrc = result;
            });
    };

    $scope.inputFileList = [];
    $scope.addUserFile = function () {
        var file = $scope.filedata;
        $scope.addVertise.FileId = Math.random().toString(36).substr(2, 16);
        $scope.addVertise.FileName = file.name;
        $scope.inputFileList = [];
        $scope.inputFileList.push(file);
    }
    $scope.ClearImage = function () {
        $scope.imageSrc = null;
        document.getElementById("uploadImage").value = '';
        document.getElementById("uploadImageSrc").setAttribute('src', null);
    };
    $scope.deleteAdd = function (index) {
        $scope.userFileList.splice(index, 1);
    }
    $scope.deleteAdd = function (index,id) {
        for (var i = 0; i < $scope.addvertiseList.length; i++) {
            if ($scope.addvertiseList[i].Id == id) {
                $http({
                    method: 'POST',
                    url: '/AdminDashboard/DeleteAdd?id=' + id,
                }).then(function successCallback(response) {
                    myFunction(response.data.Message);
                    $scope.addvertiseList.splice(index, 1);
                }, function () {
                    myFunction(response.data.Message);
                }).finally(function () {
                });
            }
        }
        $scope.BudgetMasterId = null;
        $scope.bIndex = null;
    };
    function myFunction(msg) {
        $scope.msgText = msg
        var x = document.getElementById("snackbar")
        x.className = "show";
        setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);
    }
    function getFileUrl(fileId, fileName) {
        var str = fileName;
        var extention = str.substr(str.indexOf('.'));
        return '/UploadFiles/AdvertisePhoto/' + fileId + extention;
    }
};