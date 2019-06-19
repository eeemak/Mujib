'use strict';
EditAdminBlogPostController.$inject = ['$scope', '$rootScope', '$http', '$location', '$routeParams', '$cookies', '$cookieStore', '$filter', '$compile', 'fileReader'];
function EditAdminBlogPostController($scope, $rootScope, $http, $location, $routeParams, $cookies, $cookieStore, $filter, $compile, fileReader) {
    $scope.title = "Edit Post";
    $scope.action = 'Save';
    $scope.showEditButton = false;
    $scope.blogPostList = [];
    $scope.blogPostOb = {
        Id: null,
        Title: null,
        Active: true,
        CategoryId: 1,
        UserId: null,
        AddedDate: null,
        UpdatedDate: null
    }
    $scope.blogPostDetail = {
        Id: null,
        Sequence: null,
        PostText: null
    }
    $scope.options = {
        height: 450,
        //toolbar: [
        //    ['style', ['bold', 'italic', 'underline']],
        //    ['para', ['ul', 'ol']]
        //]
        toolbar: [
            ['edit', ['undo', 'redo']],
            ['headline', ['style']],
            ['style', ['bold', 'italic', 'underline', 'superscript', 'subscript', 'strikethrough', 'clear']],
            ['fontface', ['fontname']],
            ['textsize', ['fontsize']],
            ['fontclr', ['color']],
            ['alignment', ['ul', 'ol', 'paragraph', 'lineheight']],
            ['height', ['height']],
            //['table', ['table']],
            ['insert', ['link', 'picture', 'video', 'hr']],
            ['view', ['fullscreen']],
            //['help', ['help']]
        ]
    };
    function splitter(str, l) {
        var strs = [];
        while (str.length > l) {
            var pos = str.substring(0, l).lastIndexOf(' ');
            pos = pos <= 0 ? l : pos;
            strs.push(str.substring(0, pos));
            var i = str.indexOf(' ', pos) + 1;
            if (i < pos || i > pos + l)
                i = pos;
            str = str.substring(i);
        }
        strs.push(str);
        return strs;
    }
    $scope.getPostInfo = [];
    $scope.getPostDetailList = function (data) {
        $http({
            method: 'GET',
            url: '/BlogPost/GetPostDetailWithId?id=' + data.PostId
        }).then(function successCallback(response) {
            if (response.data !== '') {
                var elements = [];
                $scope.getPostInfo = response.data;
                angular.forEach(response.data, function (item, i) {
                    $scope.blogPostOb.Id = item.Id
                    $scope.blogPostOb.Title = item.Title
                    $scope.blogPostOb.UserId = item.UserId
                    $scope.blogPostOb.FileId = item.FileId
                    $scope.blogPostOb.FileName = item.FileName
                    $scope.imageSrc = getFileUrl(item.FileId, item.FileName);
                    $scope.blogPostOb.CategoryId = item.CategoryId
                    $scope.blogPostOb.IsFetured = item.IsFetured
                    $scope.blogPostOb.AddedDate = item.AddedDate
                    $scope.blogPostOb.UpdatedDate = item.UpdatedDate
                    elements.push(item.PostText);
                });
                $scope.blogPostDetail.PostText = elements.join(' ');
            }
        })
    }
    // $scope.getPostDetailList();
    $scope.blogPostDetailList = [];
    $scope.Save = function () {
        var textList = [];
        textList = splitter($scope.blogPostDetail.PostText, 20000);
        $scope.blogPostDetailList = [];
        angular.forEach(textList, function (item, i) {
            $scope.blogPostDetailList.push({
                Id: null,
                Sequence: i,
                PostText: item
            });
        });
        if ($scope.filedata != null) {
            $scope.addBlogPost();
        }
        var formData = new FormData();
        $http({
            method: "post",
            url: '/BlogPost/Save/',
            headers: { 'Content-Type': undefined },
            transformRequest: function (data) {
                formData.append('blogPost', JSON.stringify(data.blogPost));
                formData.append('postDetailList', JSON.stringify(data.postDetailList));
                for (var i = 0; i < data.postFile.length; i++) {
                    formData.append('postFile[' + i + ']', data.postFile[i]);
                }
                return formData;
            },
            data: {
                'blogPost': $scope.blogPostOb
                , 'postDetailList': $scope.blogPostDetailList
                , 'postFile': $scope.inputFileList
            },
            dataType: "json"
        }).then(function successCallback(response) {
            if (response.data.Error === true) {
                noty({ text: response.data.Message, layout: 'topRight', type: 'error' });
            }
            else {
                noty({ text: response.data.Message, layout: 'topRight', type: 'success' });
            }
        }), function errorCallBack(response) {
            noty({ text: response.data.Message, layout: 'topRight', type: 'error' });
        }
    }
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
    $scope.addBlogPost = function () {
        var file = $scope.filedata;
        $scope.blogPostOb.FileName = file.name,
            $scope.blogPostOb.FileId = Math.random().toString(36).substr(2, 16),
            $scope.inputFileList.push(file);
        var file = [];
        $scope.fileDoc = [];
        $scope.ClearImage();
    }
    $scope.ClearImage = function () {
        $scope.imageSrc = null;
        document.getElementById("uploadImage").value = '';
        document.getElementsByClassName("file-input-name")[0].innerText = ''
        document.getElementById("uploadImageSrc").setAttribute('src', null);
    };
    $scope.deleteUserFile = function (data) {
        angular.forEach($scope.userVideoLinkList, function (item, i) {
            if (item.FileId == data.FileId) {
                $scope.userVideoLinkList.splice(i, 1);
            }
        })
    }
    function getFileUrl(fileId, fileName) {
        if (fileName != null) {
            var str = fileName;
            var extention = str.substr(str.indexOf('.'));
            return '/UploadFiles/UsersFilePhoto/Blog/' + fileId + extention;
        } else {
            return fileName;
        }
    }
};