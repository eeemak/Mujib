'use strict';
EditAdminForumPostController.$inject = ['$scope', '$rootScope', '$http', '$location', '$routeParams', '$cookies', '$cookieStore', '$filter', '$compile', 'fileReader'];
function EditAdminForumPostController($scope, $rootScope, $http, $location, $routeParams, $cookies, $cookieStore, $filter, $compile, fileReader) {
    $scope.title = "Edit Post";
    $scope.biggoShomajFeaturePostList = [];
    $scope.biggoShomajPostList = [];
    $scope.biggoShomajDetailList = [];
    $scope.imageSrc = null;
    $scope.filedata = null;
    $scope.biggoShomajPostOb = {
        Id: null,
        Title: null,
        FileName: null,
        FileId: null,
        UserId: null,
        IsFetured: true,
        ViewFor:'public',
        CategoryId: null
    }
    $scope.biggoShomajPostDetailOb = {
        Id: null,
        ForumPostId: null,
        PostText: null
    }

    $scope.getPostDetailList = function (data) {
        $http({
            method: 'GET',
            url: '/ForumPost/GetPostDetailWithId?id=' + data.ForumPostId
        }).then(function successCallback(response) {
            if (response.data !== '') {
                var elements = [];
                $scope.getPostInfo = response.data;
                angular.forEach(response.data, function (item, i) {
                    $scope.biggoShomajPostOb.Id = item.Id
                    $scope.biggoShomajPostOb.Title = item.Title
                    $scope.biggoShomajPostOb.UserId = item.UserId
                    $scope.biggoShomajPostOb.FileName = item.FileName
                    $scope.biggoShomajPostOb.FileId = item.FileId
                    $scope.biggoShomajPostOb.CategoryId = item.CategoryId
                    $scope.biggoShomajPostOb.CategoryName = item.CategoryName
                    $scope.biggoShomajPostOb.AddedDate = item.AddedDate
                    $scope.biggoShomajPostOb.UpdatedDate = item.UpdatedDate
                    $scope.biggoShomajPostOb.AuthorName = item.AuthorName
                    $scope.biggoShomajPostOb.PostText = item.PostText
                    $scope.biggoShomajPostOb.PostDetailId = item.PostDetailId
                    $scope.biggoShomajPostOb.ViewFor = item.ViewFor
                    $scope.biggoShomajPostOb.IsFetured = item.IsFetured
                    $scope.imageSrc = getFileUrl(item.FileId, item.FileName);
                    $scope.biggoShomajPostOb.imageSrc = getFileUrl(item.FileId, item.FileName);
                });
                $scope.biggoShomajPostDetailOb.Id = $scope.biggoShomajPostOb.PostDetailId;
                $scope.biggoShomajPostDetailOb.PostText = $scope.biggoShomajPostOb.PostText;
                $scope.biggoShomajPostDetailOb.ForumPostId = $scope.biggoShomajPostOb.Id;
            }
        })
    }
    function getFileUrl(fileId, fileName) {
        var str = fileName;
        var extention = str.substr(str.indexOf('.'));
        return '/UploadFiles/UsersFilePhoto/'+ $scope.biggoShomajPostOb.CategoryName+'/'+ fileId + extention;
    }
   // $scope.getPostDetailList();
    function getPostText() {
        $scope.biggoShomajDetailList.push($scope.biggoShomajPostDetailOb);
    }
    $scope.savePost = function () {
        if ($scope.biggoShomajPost.$valid) {
            $scope.biggoShomajDetailList = [];
            getPostText();
            $scope.addBiggoShomajPost();
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
                    'forumPost': $scope.biggoShomajPostOb
                    , 'forumPostDetail': $scope.biggoShomajDetailList
                    , 'postFile': $scope.inputFileList
                },
            }).then(function successCallback(response) {
                if (response.data.Error == true) {
                    noty({ text: response.data.Message, layout: 'topRight', type: 'error' });
                }
                else {
                    noty({ text: response.data.Message, layout: 'topRight', type: 'success' });
                    var ob= {
                        ForumPostId: $scope.biggoShomajPostOb.Id
                    }
                    ClearFields();
                    $scope.getPostDetailList(ob);
                }
            }), function errorCallBack(response) {
                showResult(response.data.Message, 'failure');
            }
        }
    }

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
    $scope.addBiggoShomajPost = function () {
        var file = $scope.filedata;
        if (file !=null) {
            $scope.biggoShomajPostOb.FileName = file.name;
        } else {
            $scope.biggoShomajPostOb.FileName = $scope.biggoShomajPostOb.FileName;
        }
        $scope.biggoShomajPostOb.FileId = $scope.biggoShomajPostOb.FileId != null ? $scope.biggoShomajPostOb.FileId : Math.random().toString(36).substr(2, 16);
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
    function ClearFields() {
        $scope.inputFileList = [];
        $scope.biggoShomajDetailList = [];
        $scope.biggoShomajPostOb = {
            Id: null,
            Title: null,
            FileName: null,
            FileId: null,
            UserId: null,
            IsFetured: true,
            CategoryId: null
        }
        $scope.biggoShomajPostDetailOb = {
            Id: null,
            ForumPostId: null,
            PostText: null
        }
    }
};