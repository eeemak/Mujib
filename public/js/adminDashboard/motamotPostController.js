'use strict';
MotamotPostController.$inject = ['$scope', '$rootScope', '$http', '$location', '$routeParams', '$cookies', '$cookieStore', '$filter', 'fileReader', '$compile', '$window'];
function MotamotPostController($scope, $rootScope, $http, $location, $routeParams, $cookies, $cookieStore, $filter, fileReader, $compile, $window) {
    $scope.title = "Motamot Post";
    $scope.action = 'Save';
    $scope.showEditButton = false;
    $scope.motamotPostList = [];
    $scope.motamotPostOb = {
        Id: null,
        Title: null,
        PostDetail: null,
        ShortPost:null,
        FileName: null,
        UserId: null,
    }
    $scope.postCategoryList=[];
    $scope.postCategorySelectedList=[];
    $scope.options = {
        height: 150,
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
            url: 'api/GetPostCategory'
        }).then(function successCallback(response) {
            $scope.postCategoryList = response.data;
        })
    }
    $scope.getPostCategory();
    $scope.PostListSearchParameters = {
        PageSize: 10,
        Total_Count: 0,
        CurrentPage: 1,
        PageNo: 1
    }
    $scope.getAllPersonalmotamotPostList = [];
    $scope.getPersonalList = function () {
        $scope.pageChangeHandler = function (num) {
            $scope.PostListSearchParameters.PageNo = num != undefined ? num : 1;
            $http({
                method: 'GET',
                url: 'api/GetAllMotamotPostsByUserId/'+ $scope.PostListSearchParameters.PageSize + '?page=' + $scope.PostListSearchParameters.PageNo
            }).then(function successCallback(result) {
                $scope.getAllPersonalmotamotPostList = result.data.data;
                $scope.PostListSearchParameters.Total_Count = result.data.meta.total;
            })
        };
        $scope.pageChangeHandler();
    }
    $scope.MotamotAllPostListSearchParameters = {
        PageSize: 10,
        Total_Count: 0,
        CurrentPage: 1,
        PageNo: 1
    }
    $scope.getAllMotamotPostList = [];
    $scope.getAllMotamotPostList = function () {
        $scope.pageAllmotamotPostChangeHandler = function (num) {
            $scope.MotamotAllPostListSearchParameters.PageNo = num != undefined ? num : 1;
            $http({
                method: 'GET',
                url: 'GetAllMotamotPosts/'+ $scope.MotamotAllPostListSearchParameters.PageSize + '?page=' + $scope.MotamotAllPostListSearchParameters.PageNo
            }).then(function successCallback(result) {
                $scope.getAllMotamotPostList = result.data.data;
                $scope.MotamotAllPostListSearchParameters.Total_Count = result.data.meta.total;
            })
        };
        $scope.pageAllmotamotPostChangeHandler();
    }
    $scope.Save = function () {
        if ($scope.filedata != null) {
            $scope.addmotamotPost();
        }
        $scope.postCategorySelectedList = [];
        angular.forEach($scope.postCategoryList, function(ob){
          if (ob.selected) $scope.postCategorySelectedList.push(ob.value);
        });
        
        var formData = new FormData();
        formData.append('motamotPostOb', JSON.stringify($scope.motamotPostOb));
        formData.append('motamotPostCategory',JSON.stringify( $scope.postCategorySelectedList));
        formData.append('file', $scope.filedata);
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/api/SaveMotamot",
            contentType: false,
            processData: false,
            data: formData,
            success: function (response) {
                console.log(response);
                if(response.error == true){
                    noty({ text: "This file format is not allowed to upload", layout: 'topRight', type: 'error',timeout:5000  });
                }else{
                    $scope.motamotPostOb.Title=null;
                    $scope.motamotPostOb.PostDetail=null;
                    $scope.motamotPostOb.ShortPost=null;
                    $scope.getPersonalList();
                    noty({ text: response.title +" has saved!", layout: 'topRight', type: 'success',timeout:5000  });
                }
            },
            error: function () {
                noty({ text: "Something went wrong!", layout: 'topRight', type: 'error',timeout:5000  });
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
    $scope.truncString = function (str, max, add) {
        add = add || '...';
        return (typeof str === 'string' && str.length > max ? str.substring(0, max) + add : str);
    };
    $scope.deletePost = function (id) {
        if (id != null || id != undefined) {
            $http({
                method: 'POST',
                url: '/api/DeleteMotamotPost/' + id,
                dataType: 'JSON'
            }).then(function successCallback(response) {
                console.log('res', response);
                noty({ text: response.data.title +" has deleted!", layout: 'topRight', type: 'success',timeout:5000  });
                $scope.getPersonalList();
                $scope.getAllMotamotPostList=  $scope.getAllMotamotPostList.filter(function(ob) {
                    return ob.id !=id;
                  });

            }, function errorCallback(response) {
                noty({ text: response.data.Message, layout: 'topRight', type: 'error',timeout:5000  });
            });
        }
        else {
            noty({ text: "No Post Found to delete", layout: 'topRight', type: 'error',timeout:5000  });
        }
        return true;
    };
    $scope.postDetailOb = {};
    $scope.getPostDetail = function (data) {
        $scope.postDetailOb.Id = data.id
        $scope.postDetailOb.Title = data.title
        $scope.postDetailOb.UserId = data.user_id
        $scope.postDetailOb.CategoryId = data.post_categories[0].id
        $scope.postDetailOb.CategoryName = data.post_categories[0].name
        $scope.postDetailOb.AddedDate = data.created_at
        $scope.postDetailOb.AuthorName = data.user_full_name
        $scope.postDetailOb.TempSrc = data.file_path;
        $scope.postDetailOb.PostText=data.post_detail;
        angular.element(document.querySelector('#modal_basic')).modal('show');
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