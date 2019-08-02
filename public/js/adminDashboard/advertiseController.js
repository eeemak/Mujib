'use strict';
AdvertiseController.$inject = ['$scope', '$rootScope', '$http', '$location', '$routeParams', '$cookies', '$cookieStore', '$filter', 'fileReader'];
function AdvertiseController($scope, $rootScope, $http, $location, $routeParams, $cookies, $cookieStore, $filter,fileReader) {
    $scope.title = "Advertise";
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

    $scope.getAdvertisements = function () {
        $http({
            method: 'GET',
            url: 'api/advertisement?page=1&take=10'
        }).then(function successCallback(response) {
            if (response.data !== '') {
                $scope.advertisementList = response.data.data;
            }
        })
    }
    
    $scope.getUserFileAll = function () {
        $http({
            method: 'GET',
            url: 'api/GetUserFileAll'
        }).then(function successCallback(response) {
            if (response.data !== '') {
                $scope.userFileList = response.data;
            }
        })
    }
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
    $scope.uploadFile = function () {
        var formData = new FormData();
            formData.append('title', $scope.adminUploadFileOb.Title);
            formData.append('file', $scope.filedata);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "/api/advertisement",
                contentType: false,
                processData: false,
                data: formData,
                success: function (response) {
                    console.log(response);
                    if(response.error == true){
                        noty({ text: "This file format is not allowed to upload", layout: 'topRight', type: 'error' });
                    }else{
                        $scope.adminUploadFileOb.Title=null;
                        noty({ text: response.file_title +" has uploaded!", layout: 'topRight', type: 'success' });
                        $scope.getAdvertisements();
                    }
                },
                error: function () {
                    noty({ text: "Something went wrong!", layout: 'topRight', type: 'error' });
                }
            });
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
    $scope.delete = function (id) {
        // angular.forEach($scope.userFileList, function (item, i) {
        //     if (item.FileId == data.FileId) {
        //         $scope.userFileList.splice(i, 1);
        //     }
        // })
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "DELETE",
            url: "/api/advertisement/" + id,
            contentType: false,
            processData: false,
            success: function (response) {
                noty({ text: response.data.file_title +" has deleted!", layout: 'topRight', type: 'success' });
                $scope.getAdvertisements();
            },
            error: function () {
            }
        });
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