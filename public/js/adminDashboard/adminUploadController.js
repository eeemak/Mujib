'use strict';
AdminUploadController.$inject = ['$scope', '$rootScope', '$http', '$location', '$routeParams', '$cookies', '$cookieStore', '$filter', 'fileReader'];
function AdminUploadController($scope, $rootScope, $http, $location, $routeParams, $cookies, $cookieStore, $filter,fileReader) {
    $scope.title = "User Document";
    $scope.userFileList = [];
    $scope.getFileTypeOb=function(){
        $scope.userFileType = {
            id: null,
            fileTypeId: null,
            file_path: null,
            file_title:null
        }
    }
    $scope.getFileTypeOb();

    $scope.getUserFileById = function () {
        $http({
            method: 'GET',
            url: 'api/GetUserFileById'
        }).then(function successCallback(response) {
            if (response.data !== '') {
                $scope.userFileList = response.data;
            }
        })
    }
    $scope.getUserFileById();
    //--------------
    $scope.fileTypeList = [];
    $scope.getFileType = function () {
        $http({
            method: 'GET',
            url: 'api/GetFileType'
        }).then(function successCallback(response) {
            $scope.fileTypeList = response.data;
        })
    }
    $scope.getFileType();
  
 
    //------------
    $scope.SaveDocument = function () {
        var formData = new FormData();
        formData.append('title',angular.toJson($scope.userFileType) );
        formData.append('file', $scope.filedata);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/api/UploadFile",
            contentType: false,
            processData: false,
            data: formData,
            success: function (imgSrc) {
                noty({ text: "file added to the gallary!", layout: 'topRight', type: 'success' });
                $scope.getFileTypeOb();
                $scope.ClearImage();
                $scope.getUserFileById();
            },
            error: function () {
            }
        });

        // $http({
        //     method: 'POST',
        //     url: '/UserDocument/SaveDocument/',
        //     headers: { 'Content-Type': undefined },
        //     transformRequest: function (data) {
        //         formData.append('userFileList', angular.toJson(data.userFileList));
        //         for (var i = 0; i < data.userFile.length; i++) {
        //             formData.append('userFile[' + i + ']', data.userFile[i]);
        //         }
        //         return formData;
        //     },
        //     data: {
        //         'userFileList': $scope.userFileList
        //         , 'userFile': $scope.inputFileList
        //     },
        // }).then(function successCallback(response) {
        //     if (response.data.Error === true) {
        //         noty({ text: response.data.Message, layout: 'topRight', type: 'error' });
        //     }
        //     else {
        //         noty({ text: response.data.Message, layout: 'topRight', type: 'success' });
        //         ClearFields();
        //     }
        // }), function errorCallBack(response) {
        //     ShowResult(response.data.Message, 'failure');
        // }
    }
    $scope.imageSrc = null;
    $scope.filedata = null;
    $("#uploadImage").change(function () {
        $scope.filedata = this.files[0];
    });
    $scope.getFile = function () {
        fileReader.readAsDataUrl($scope.file, $scope)
            .then(function (result) {
                $scope.imageSrc = result;
            });
    };
    $scope.deleteUserFile = function (data, index) {
        angular.forEach($scope.userFileList, function (item, i) {
            if (item.FileId == data.FileId) {
                $scope.userFileList.splice(i, 1);
            }
        })
    }
    function myFunction(msg) {
        $scope.msgText = msg
        var x = document.getElementById("snackbar")
        x.className = "show";
        setTimeout(function () { x.className = x.className.replace("show", ""); }, 5000);
    }
    $scope.FileDownload = function (data) {
        $scope.dwonloadUrl = null;
        var str = data.FileName;
        var extention = str.substr(str.indexOf('.'));
        $scope.dwonloadUrl = '/UploadFiles/UsersFileDoc/' + data.FileId + extention;
    };
    $scope.clearImage = function () {
        document.getElementById("docs").value = '';
        document.getElementById("docs").setAttribute('src', null);
    };
    function ClearFields() {
        $scope.userFileType = {
            Id: null,
            FileTypeId: null,
            FileName: null,
            FileId: null,
            FileNo: null,
            UserId: null
        }
        var file = [];
        $scope.fileDoc = [];
        $scope.clearImage();
    }
    $scope.clear = function () {
        ClearFields();
    }
};