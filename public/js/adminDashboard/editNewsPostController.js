'use strict';
EditNewsPostController.$inject = ['$scope', '$rootScope', '$http', '$location', '$routeParams', '$cookies', '$cookieStore', '$filter', '$compile', 'fileReader'];
function EditNewsPostController($scope, $rootScope, $http, $location, $routeParams, $cookies, $cookieStore, $filter, $compile, fileReader) {
    $scope.title = "Edit Post";
    $scope.action = 'Save';
    $scope.showEditButton = false;
    $scope.newsPostList = [];
    $scope.newsPostOb = {
        Id: null,
        Title: null,
        Active: true,
        CategoryId: 1,
        UserId: null,
        AddedDate: null,
        UpdatedDate: null
    }
    $scope.newsPostDetail = {
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

    $scope.getPostInfo = [];
    $scope.getPostDetailList = function (id) {
        $http({
            method: 'GET',
            url: '/api/GetNewsPostById/'+id,
        }).then(function successCallback(response) {
            if (response.data !== '') {
                var item = response.data.data;
                $scope.newsPostOb.Id = item.id
                $scope.newsPostOb.Title = item.title
                $scope.newsPostOb.PostDetail = item.post_detail
                $scope.newsPostOb.ShortPost = item.short_post
                $scope.newsPostOb.UserFullName = item.user_full_name
                $scope.newsPostOb.FilePath = "/"+item.file_path
                $scope.newsPostOb.CategoryName = item.post_categories[0].name
                $scope.newsPostOb.CreatedAt = item.created_at
                $scope.imageSrc = $scope.newsPostOb.FilePath;
            }
        })
    }
    // $scope.getPostDetailList();
    $scope.newsPostDetailList = [];
    $scope.Save = function () {
        if ($scope.filedata != null) {
            $scope.addnewsPost();
        }
        $scope.postCategorySelectedList = [];
        angular.forEach($scope.postCategoryList, function(ob){
          if (ob.selected) $scope.postCategorySelectedList.push(ob.value);
        });
        
        var formData = new FormData();
        formData.append('newsPostOb', JSON.stringify($scope.newsPostOb));
        formData.append('newsPostCategory',JSON.stringify( $scope.postCategorySelectedList));
        formData.append('file', $scope.filedata);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/api/UpdateNews",
            contentType: false,
            processData: false,
            data: formData,
            success: function (response) {
                console.log(response);
                if(response.error == true){
                    noty({ text: "This file format is not allowed to upload", layout: 'topRight', type: 'error' });
                }else{
                    $scope.newsPostOb.Title=null;
                    $scope.newsPostOb.PostDetail=null;
                    $scope.newsPostOb.ShortPost=null;
                    noty({ text: response.title +" has saved!", layout: 'topRight', type: 'success' });
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
    $scope.addnewsPost = function () {
        var file = $scope.filedata;
        $scope.newsPostOb.FileName = file.name,
            $scope.newsPostOb.FileId = Math.random().toString(36).substr(2, 16),
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
            return '/UploadFiles/UsersFilePhoto/news/' + fileId + extention;
        } else {
            return fileName;
        }
    }
};