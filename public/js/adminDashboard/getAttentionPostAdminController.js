'use strict';
GetAttentionPostAdminController.$inject = ['$scope', '$rootScope', '$http', '$location', '$routeParams', '$cookies', '$cookieStore', '$filter', 'fileReader'];
function GetAttentionPostAdminController($scope, $rootScope, $http, $location, $routeParams, $cookies, $cookieStore, $filter, fileReader) {
    $scope.title = "Biggo Shomaj";
    $scope.getAttentionFeaturePostList = [];
    $scope.getAttentionPostList = [];
    $scope.getAttentionDetailList = [];
    $scope.getAttentionPostOb = {
        Id: null,
        Title: null,
        FileName: null,
        FileId: null,
        UserId: null,
        IsFetured: true,
        ViewFor: 'public',
        CategoryId: 5
    }
   // $scope.getGetAttentionFeaturePostListById();
    $scope.getAttentionListSearchParameters = {
        PageSize: 10,
        Total_Count: 0,
        CurrentPage: 1,
        PageNo: 1
    }
    $scope.getGetAttentionListById = function () {
        $scope.pageChangeHandler = function (num) {
            $scope.getAttentionListSearchParameters.PageNo = num != undefined ? num : 1;
            $http({
                method: 'GET',
                url: '/ForumPost/GetGetAttentionAdminPostList?pageNo=' + $scope.getAttentionListSearchParameters.PageNo + '&pageSize=' + $scope.getAttentionListSearchParameters.PageSize
            }).then(function successCallback(response) {
                if (response.data.Items.length > 0) {
                    angular.forEach(response.data.Items, function (item) {
                        if (item.FileId !=null) {
                            item.TempSrc = getFileUrl(item.FileId, item.FileName);
                        }
                    });
                    $scope.getAttentionPostList = response.data.Items;
                }
                $scope.getAttentionListSearchParameters.Total_Count = response.data.Pager.TotalItems;
            })
        };
        $scope.pageChangeHandler();
    }
    $scope.getGetAttentionListById();
    //**AllBiggoShomajPostList**/
    $scope.postList = [];
    $scope.PostListSearchParameters = {
        PageSize: 10,
        Total_Count: 0,
        CurrentPage: 1,
        PageNo: 1
    }
    $scope.getPostList = function () {
        $scope.pagePostChangeHandler = function (num) {
            $scope.PostListSearchParameters.PageNo = num != undefined ? num : 1;
            $http({
                method: 'GET',
                url: '/ForumPost/GetPostListWithCategoryId?pageNo=' + $scope.PostListSearchParameters.PageNo + '&pageSize=' + $scope.PostListSearchParameters.PageSize + '&fourmPostCategoryId=5'
            }).then(function successCallback(response) {
                if (response.data.Items.length > 0) {
                    angular.forEach(response.data.Items, function (item) {
                        if (item.FileId != null) {
                            item.PhotoPath = getFileUrl(item.FileId, item.FileName);
                        }
                    });
                    $scope.postList = response.data.Items;
                }
                $scope.PostListSearchParameters.Total_Count = response.data.Pager.TotalItems;
            })
        };
        $scope.pagePostChangeHandler();
    }
    $scope.getPostList();
    $scope.postDetailOb = {};
    $scope.postDetail = function (data) {
        if (data.FileId != null) {
            data.TempSrc = getFileUrl(data.FileId, data.FileName);
        }
        $scope.postDetailOb = data;
        angular.element(document.querySelector('#modal_basic')).modal('show');
    }
    $scope.removePost = function (id) {
        if (id != null || id != undefined) {
            $http({
                method: 'POST',
                url: '/ForumPost/DeletePost/' + id,
                dataType: 'JSON'
            }).then(function successCallback(response) {
                if (response.data.Error === true) {
                    noty({ text: response.data.Message, layout: 'topRight', type: 'error' });
                }
                else {
                    noty({ text: response.data.Message, layout: 'topRight', type: 'success' });
                    for (var i = 0; i < $scope.postList.length; i++) {
                        var ob = $scope.postList[i];
                        if (ob.Id === id) {
                            $scope.postList.splice(i, 1)
                            $scope.PostListSearchParameters.Total_Count = $scope.PostListSearchParameters.Total_Count - 1
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
    //end
    $scope.deleteUserVideoLink = function (data) {
        angular.forEach($scope.userVideoLinkList, function (item, i) {
            if (item.FileId == data.FileId) {
                $scope.userVideoLinkList.splice(i, 1);
            }
        })
    }
    function getPostText() {
        $scope.getAttentionDetailList.push($scope.getAttentionPostDetailOb);
    }
    $scope.savePost = function () {
        if ($scope.getAttentionPost.$valid) {
            $scope.getAttentionDetailList = [];
            getPostText();
            $scope.addGetAttentionPost();
            var formData = new FormData();
            $http({
                method: "post",
                url: '/ForumPost/Create/',
                headers: { 'Content-Type': undefined },
                transformRequest: function (data) {
                    formData.append('forumPost', angular.toJson(data.forumPost));
                    formData.append('forumPostDetail', angular.toJson(data.forumPostDetail));
                    for (var i = 0; i < data.postFile.length; i++) {
                        formData.append('postFile[' + i + ']', data.postFile[i]);
                    }
                    return formData;
                },
                data: {
                    'forumPost': $scope.getAttentionPostOb
                    , 'forumPostDetail': $scope.getAttentionDetailList
                    , 'postFile': $scope.inputFileList
                },
            }).then(function successCallback(response) {
                if (response.data.Error == true) {
                    noty({ text: response.data.Message, layout: 'topRight', type: 'error' });
                }
                else {
                    noty({ text: response.data.Message, layout: 'topRight', type: 'success' });
                    $scope.getGetAttentionListById();
                    ClearFields();
                }
            }), function errorCallBack(response) {
                showResult(response.data.Message, 'failure');
            }
        }
    }
    $scope.deletePost = function (id) {
        if (id != null || id != undefined) {
            $http({
                method: 'POST',
                url: '/ForumPost/DeletePost/' + id,
                dataType: 'JSON'
            }).then(function successCallback(response) {
                if (response.data.Error === true) {
                    noty({ text: response.data.Message, layout: 'topRight', type: 'error' });
                }
                else {
                    noty({ text: response.data.Message, layout: 'topRight', type: 'success' });
                    for (var i = 0; i < $scope.getAttentionPostList.length; i++) {
                        var ob = $scope.getAttentionPostList[i];
                        if (ob.Id === id) {
                            $scope.getAttentionPostList.splice(i, 1)
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
    function ClearFields() {
        $scope.inputFileList = [];
        $scope.getAttentionDetailList = [];
        $scope.getAttentionPostOb = {
            Id: null,
            Title: null,
            FileName: null,
            FileId: null,
            UserId: null,
            IsFetured: true,
        ViewFor: 'public',
            CategoryId: 5
        }
        $scope.getAttentionPostDetailOb = {
            Id: null,
            ForumPostId: null,
            PostText: null
        }
    }
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
    $scope.getFile = function () {
        $scope.progress = 0;
        fileReader.readAsDataUrl($scope.file, $scope)
            .then(function (result) {
                $scope.imageSrc = result;
            });
    };

    $scope.inputFileList = [];
    $scope.addGetAttentionPost = function () {
        var file = $scope.filedata;
        $scope.getAttentionPostOb.FileName= file.name,
            $scope.getAttentionPostOb.FileId= Math.random().toString(36).substr(2, 16),
        $scope.inputFileList.push(file);
        var file = [];
        $scope.fileDoc = [];
        $scope.ClearImage();
    }
    $scope.ClearImage = function () {
        $scope.imageSrc = null;
        document.getElementById("uploadImage").value = '';
        document.getElementById("uploadImageSrc").setAttribute('src', null);
    };
    $scope.deleteUserFile = function (data) {
        angular.forEach($scope.userVideoLinkList, function (item, i) {
            if (item.FileId == data.FileId) {
                $scope.userVideoLinkList.splice(i, 1);
            }
        })
    }
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
        var str = fileName;
        var extention = str.substr(str.indexOf('.'));
        return '/UploadFiles/UsersFilePhoto/GetAttention/' + fileId + extention;
    }
    $scope.truncString = function (str, max, add) {
        add = add || '...';
        return (typeof str === 'string' && str.length > max ? str.substring(0, max) + add : str);
    };
};