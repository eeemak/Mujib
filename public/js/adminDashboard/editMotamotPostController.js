
'use strict';
EditMotamotPostController.$inject = ['$scope', '$rootScope', '$http', '$location', '$routeParams', '$cookies', '$cookieStore', '$filter', '$compile', 'fileReader'];
function EditMotamotPostController($scope, $rootScope, $http, $location, $routeParams, $cookies, $cookieStore, $filter, $compile, fileReader) {
    $scope.title = "Edit Post";
    $scope.action = 'Save';
    $scope.showEditButton = false;
    $scope.motamotPostList = [];
    $scope.motamotPostOb = {
        Id: null,
        Title: null,
        PostDetail: null,
        ShortPost: null,
        FileName: null,
        UserId: null,
    }
    $scope.postCategoryList = [];
    $scope.postCategorySelectedList = [];
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
    $scope.getPostCategory = function () {
        $http({
            method: 'GET',
            url: '/api/GetPostCategory'
        }).then(function successCallback(response) {
            $scope.postCategoryList = response.data;
        })
    }
    $scope.getPostCategory();
    $scope.getPostInfo = [];
    $scope.getPostDetailList = function (id) {
        $http({
            method: 'GET',
            url: '/api/GetMotamotPostById/' + id,
        }).then(function successCallback(response) {
            if (response.data !== '') {
                var item = response.data.data;
                $scope.motamotPostOb.Id = item.id
                $scope.motamotPostOb.Title = item.title
                $scope.motamotPostOb.PostDetail = item.post_detail
                $scope.motamotPostOb.ShortPost = item.short_post
                $scope.motamotPostOb.UserFullName = item.user_full_name
                $scope.motamotPostOb.FilePath = "/" + item.file_path
                $scope.motamotPostOb.CategoryName = item.post_categories[0].name
                $scope.motamotPostOb.CreatedAt = item.created_at
                $scope.imageSrc = $scope.motamotPostOb.FilePath;
                angular.forEach($scope.postCategoryList, function (ob) {
                    angular.forEach(response.data.data.post_categories, function (x) {
                        if (ob.value === x.id) {
                            ob.selected = true;
                        }
                    })
                });
            }
        })
    }
    // $scope.getPostDetailList();
    $scope.motamotPostDetailList = [];
    $scope.Save = function () {
        if ($scope.filedata != null) {
            $scope.addmotamotPost();
        }
        $scope.postCategorySelectedList = [];
        angular.forEach($scope.postCategoryList, function (ob) {
            if (ob.selected) $scope.postCategorySelectedList.push(ob.value);
        });

        var formData = new FormData();
        formData.append('motamotPostOb', JSON.stringify($scope.motamotPostOb));
        formData.append('motamotPostCategory', JSON.stringify($scope.postCategorySelectedList));
        formData.append('file', $scope.filedata);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/api/UpdateMotamot",
            contentType: false,
            processData: false,
            data: formData,
            success: function (response) {
                console.log(response);
                if (response.error == true) {
                    noty({ text: "This file format is not allowed to upload", layout: 'topRight', type: 'error' });
                } else {
                    $scope.motamotPostOb.Title = null;
                    $scope.motamotPostOb.PostDetail = null;
                    $scope.motamotPostOb.ShortPost = null;
                    noty({ text: response.title + " has saved!", layout: 'topRight', type: 'success' });
                    $scope.getPersonalList();
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
        $scope.progress = 0;
        fileReader.readAsDataUrl($scope.file, $scope)
            .then(function (result) {
                $scope.imageSrc = result;
            });
    };

    $scope.inputFileList = [];
    $scope.addmotamotPost = function () {
        var file = $scope.filedata;
        $scope.motamotPostOb.FileName = file.name,
            $scope.motamotPostOb.FileId = Math.random().toString(36).substr(2, 16),
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
            return '/UploadFiles/UsersFilePhoto/motamot/' + fileId + extention;
        } else {
            return fileName;
        }
    }
};