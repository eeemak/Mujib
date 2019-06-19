'use strict';
AdminVideoAlbumController.$inject = ['$scope', '$rootScope', '$http', '$location', '$routeParams', '$cookies', '$cookieStore', '$filter', 'fileReader'];
function AdminVideoAlbumController($scope, $rootScope, $http, $location, $routeParams, $cookies, $cookieStore, $filter, fileReader) {
    $scope.title = "Video Album";
    $scope.adminVideoLinkList = [];
    $scope.adminVideoLinkList = [];
    $scope.adminVideoOb = {
        Id: null,
        Title: null,
        Link: null,
        FileName: null,
        FileId: null,
        UserId: null,
        IsFitured: true,
        ViewFor: 'public'
    }
    $scope.allVideoList = [];
    $scope.AllVideoListSearchParameters = {
        PageSize: 10,
        Total_Count: 0,
        CurrentPage: 1,
        PageNo: 1
    }
    $scope.getAllVideoList = function () {
        $scope.pageAllChangeHandler = function (num) {
            $scope.AllVideoListSearchParameters.PageNo = num != undefined ? num : 1;
            $http({
                method: 'GET',
                url: '/UserVideoAlbum/GetAllVideoList?pageNo=' + $scope.AllVideoListSearchParameters.PageNo + '&pageSize=' + $scope.AllVideoListSearchParameters.PageSize
            }).then(function successCallback(response) {
                if (response.data.Items.length > 0) {
                    angular.forEach(response.data.Items, function (item) {
                        item.PhotoPath = getFileUrl(item.FileId, item.FileName);
                    });
                    $scope.allVideoList = response.data.Items;
                }
                $scope.AllVideoListSearchParameters.Total_Count = response.data.Pager.TotalItems;
            })
        };
        $scope.pageAllChangeHandler();
    }
    $scope.getAllVideoList();
    $scope.videoDetailOb = {};
    $scope.videoDetail = function (data) {
        if (data.FileId != null) {
            data.TempSrc = getFileUrl(data.FileId, data.FileName);
        }
        $scope.videoDetailOb = data;
        angular.element(document.querySelector('#modal_basic')).modal('show');
    }
    $scope.removePost = function (id) {
        if (id != null || id != undefined) {
            $http({
                method: 'POST',
                url: '/UserVideoAlbum/DeletePost/' + id,
                dataType: 'JSON'
            }).then(function successCallback(response) {
                if (response.data.Error === true) {
                    noty({ text: response.data.Message, layout: 'topRight', type: 'error' });
                }
                else {
                    noty({ text: response.data.Message, layout: 'topRight', type: 'success' });
                    for (var i = 0; i < $scope.allVideoList.length; i++) {
                        var ob = $scope.allVideoList[i];
                        if (ob.Id === id) {
                            $scope.allVideoList.splice(i, 1)
                            $scope.AllVideoListSearchParameters.Total_Count = $scope.AllVideoListSearchParameters.Total_Count - 1
                        }
                    }
                }
            }, function errorCallback(response) {
                noty({ text: response.data.Message, layout: 'topRight', type: 'error' });
            });
        }
        else {
            noty({ text: "No Post Found to delete", layout: 'topRight', type: 'error' });
        }
        return true;
    };
    $scope.AdminVideoListSearchParameters = {
        PageSize: 12,
        Total_Count: 0,
        CurrentPage: 1,
        PageNo: 1
    }
    $scope.getAdminVideoListById = function () {
        $scope.pageChangeHandler = function (num) {
            $scope.AdminVideoListSearchParameters.PageNo = num != undefined ? num : 1;
            $http({
                method: 'GET',
                url: '/UserVideoAlbum/GetAdminVideoList?pageNo=' + $scope.AdminVideoListSearchParameters.PageNo + '&pageSize=' + $scope.AdminVideoListSearchParameters.PageSize
            }).then(function successCallback(response) {
                if (response.data.Items.length > 0) {
                    angular.forEach(response.data.Items, function (item) {
                        item.TempSrc = getFileUrl(item.FileId, item.FileName);
                    });
                    $scope.adminVideoLinkList = response.data.Items;
                }
                $scope.AdminVideoListSearchParameters.Total_Count = response.data.Pager.TotalItems;
            })
        };
        $scope.pageChangeHandler();
    }
    $scope.getAdminVideoListById();
    $scope.updateVideoPopUp = function (data) {
        $scope.adminVideoUpdateOb = Object.assign({}, data);
        angular.element(document.querySelector('#modal_basic')).modal('show');
    }
    $scope.saveAlbum = function () {
        if ($scope.adminVideoAlbum.$valid) {
            var formData = new FormData();
            $http({
                method: "post",
                url: '/UserVideoAlbum/AdminCreate/',
                headers: { 'Content-Type': undefined },
                transformRequest: function (data) {
                    formData.append('userVideoLink', angular.toJson(data.userVideoLink));
                    for (var i = 0; i < data.userFile.length; i++) {
                        formData.append('userFile[' + i + ']', data.userFile[i]);
                    }
                    return formData;
                },
                data: {
                    'userVideoLink': $scope.adminVideoSaveLinkList
                    , 'userFile': $scope.inputFileList
                },
            }).then(function successCallback(response) {
                if (response.data.Error == true) {
                    noty({ text: response.data.Message, layout: 'topRight', type: 'error' });
                }
                else {
                    noty({ text: response.data.Message, layout: 'topRight', type: 'success' });
                    $scope.getAdminVideoListById();
                    ClearFields();
                }
            }), function errorCallBack(response) {
                showResult(response.data.Message, 'failure');
            }
        }
    }
    $scope.admimnVideoUpdateLink = [];
    $scope.inputUpdateFileList = [];
    //$scope.uploadDocument = function () {
    //    var fileD = $("#docs").get(0);
    //    $scope.fileDoc = fileD.files;
    //    var reader = new FileReader();

    //    reader.onload = function (e) {
    //        // get loaded data and render thumbnail.
    //        $scope.tempSrc =   e.target.result;
    //    };
    //    //$scope.tempSrc = document.getElementById("docs").value;
    //    var personId = null;
    //    //for (var i = 0; i < fileDoc.length; i++) {
    //    //    data.append(fileDoc[i].name, fileDoc[i], personId);
    //    //}
    //}
    $scope.imageSrc = null;
    $scope.filedata = null;
    $("#uploadImage").change(function () {
        $scope.filedata = this.files[0];
    });
    $scope.imageEditMode = false;
    $("#uploadUpdateImage").change(function () {
        $scope.imageEditMode = true;
        $scope.filedata = this.files[0];
    });
    $scope.getFile = function () {
        $scope.progress = 0;
        fileReader.readAsDataUrl($scope.file, $scope)
            .then(function (result) {
                if ($scope.imageEditMode) {
                    $scope.adminVideoUpdateOb.TempSrc = result;
                } else {
                    $scope.imageSrc = result;
                }
            });
    };

    $scope.inputFileList = [];
    $scope.adminVideoSaveLinkList = [];
    $scope.addAdminVideoLink = function () {
        var file = $scope.filedata;
        var ob = {
            Id: null,
            Title: $scope.adminVideoOb.Title,
            Link: $scope.adminVideoOb.Link,
            FileName: file != null ? file.name : null,
            FileId: file != null ? Math.random().toString(36).substr(2, 16) : null, 
            TempSrc: $scope.imageSrc != null ? $scope.imageSrc : "/Images/default.jpg",
            UserId: null,
            IsFitured: true,
            ViewFor: 'public'
        }
        $scope.adminVideoSaveLinkList.push(ob);
        $scope.inputFileList.push(file);
        $scope.adminVideoOb = {
            Id: null,
            Title: null,
            Link: null,
            FileName: null,
            FileId: null,
            UserId: null,
            IsFitured: true,
            ViewFor: 'public'
        }
        var file = [];
        $scope.fileDoc = [];
        $scope.ClearImage();
        $scope.saveAlbum();
    }
    $scope.ClearImage = function () {
        $scope.imageSrc = null;
        document.getElementById("uploadImage").value = '';
        if (document.getElementsByClassName("file-input-name").length > 0) {
            document.getElementsByClassName("file-input-name")[0].innerText = ''
        }
        if (document.getElementById("uploadImageSrc") != null) {
            document.getElementById("uploadImageSrc").setAttribute('src', null);
        }
    };
    $scope.deleteUserVideoLink = function (data) {
        if (data.Id != null || data.Id != undefined) {
            $http({
                method: 'POST',
                url: '/UserVideoAlbum/DeletePost/' + data.Id,
                dataType: 'JSON'
            }).then(function successCallback(response) {
                if (response.data.Error === true) {
                    noty({ text: response.data.Message, layout: 'topRight', type: 'error' });
                }
                else {
                    noty({ text: response.data.Message, layout: 'topRight', type: 'success' });
                    angular.forEach($scope.adminVideoLinkList, function (item, i) {
                        if (item.Id == data.Id) {
                            $scope.adminVideoLinkList.splice(i, 1);
                        }
                    });
                }
            }, function errorCallback(response) {
                noty({ text: response.data.Message, layout: 'topRight', type: 'error' });
            });
        }
        else {
            noty({ text: "No Post Found to delete", layout: 'topRight', type: 'error' });
        }
        return true;
    };
    function myFunction(msg) {
        $scope.msgText = msg
        var x = document.getElementById("snackbar")
        x.className = "show";
        setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);
    }
    //#gallary**
    $scope.modalTempSrc = null;
    $scope.imgTitle = null;
    $scope.img = function (data) {
        angular.element(document.querySelector('#myModal')).modal('show');
        $scope.modalTempSrc = data.TempSrc;
        $scope.imgTitle = data.Title;
    }
    //endgallary
    function getFileUrl(fileId, fileName) {
        if (fileId != null) {
            if (fileId != "") {
                var str = fileName;
                var extention = str.substr(str.indexOf('.'));
                return '/UploadFiles/UsersVideoFile/' + fileId + extention;
            } else {
                return '/Images/default.jpg';
            }
        } else {
            return '/Images/default.jpg';
        }
    }
    function ClearFields() {
        $scope.inputFileList = [];
        $scope.adminVideoSaveLinkList = [];
    }
};