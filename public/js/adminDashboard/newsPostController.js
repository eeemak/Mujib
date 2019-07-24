'use strict';
NewsPostController.$inject = ['$scope', '$rootScope', '$http', '$location', '$routeParams', '$cookies', '$cookieStore', '$filter', 'fileReader', '$compile', '$window'];
function NewsPostController($scope, $rootScope, $http, $location, $routeParams, $cookies, $cookieStore, $filter, fileReader, $compile, $window) {
    $scope.title = "Blog Post";
    $scope.action = 'Save';
    $scope.showEditButton = false;
    $scope.blogPostList = [];
    $scope.blogPostOb = {
        Id: null,
        Title: null,
        Active: true,
        CategoryId: 1,
        FileName: null,
        FileId: null,
        UserId: null,
        IsFetured: true
    }
    $scope.blogPostDetail = {
        Id: null,
        Sequence: null,
        PostText: null
    }

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
    $scope.PostListSearchParameters = {
        PageSize: 10,
        Total_Count: 0,
        CurrentPage: 1,
        PageNo: 1
    }
    $scope.getAllPersonalBlogPostList = [];
    $scope.getPersonalList = function () {
        $scope.pageChangeHandler = function (num) {
            $scope.PostListSearchParameters.PageNo = num != undefined ? num : 1;
            $http({
                method: 'GET',
                url: '/BlogPost/GetBlogPostListWithUserId?pageNo=' + $scope.PostListSearchParameters.PageNo + '&pageSize=' + $scope.PostListSearchParameters.PageSize
            }).then(function successCallback(result) {
                if (result.data.Items.length > 0) {
                    angular.forEach(result.data.Items, function (item) {
                        item.TempSrc = getFileUrl(item.FileId, item.FileName);
                    });
                }
                $scope.getAllPersonalBlogPostList = result.data.Items;
                $scope.PostListSearchParameters.Total_Count = result.data.Pager.TotalItems;
            })
        };
        $scope.pageChangeHandler();
    }
    $scope.getPersonalList();
    $scope.blogPostDetailList = [];
    //**AllBlogPostList**/
    $scope.allBlogPostList = [];
    $scope.allBlogPostListSearchParameters = {
        PageSize: 10,
        Total_Count: 0,
        CurrentPage: 1,
        PageNo: 1
    }
    $scope.getPostList = function () {
        $scope.pageAllBlogPostChangeHandler = function (num) {
            $scope.allBlogPostListSearchParameters.PageNo = num != undefined ? num : 1;
            $http({
                method: 'GET',
                url: '/BlogPost/GetBlogPostList?pageNo=' + $scope.allBlogPostListSearchParameters.PageNo + '&pageSize=' + $scope.allBlogPostListSearchParameters.PageSize
            }).then(function successCallback(response) {
                if (response.data.Items.length > 0) {
                    angular.forEach(response.data.Items, function (item) {
                        item.TempSrc = getFileUrl(item.FileId, item.FileName);
                    });
                    $scope.allBlogPostList = response.data.Items;
                }
                $scope.allBlogPostListSearchParameters.Total_Count = response.data.Pager.TotalItems;
            })
        };
        $scope.pageAllBlogPostChangeHandler();
    }
    $scope.getPostList();
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
                $scope.getPersonalList();
                $scope.getPostList();
                $scope.blogPostOb = {
                    Id: null,
                    Title: null,
                    Active: true,
                    CategoryId: 1
                }
                $scope.blogPostDetail = {
                    Id: null,
                    Sequence: null,
                    PostText: null
                }
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
    $scope.truncString = function (str, max, add) {
        add = add || '...';
        return (typeof str === 'string' && str.length > max ? str.substring(0, max) + add : str);
    };
    $scope.deletePost = function (id) {
        if (id != null || id != undefined) {
            $http({
                method: 'POST',
                url: '/BlogPost/DeletePost/' + id,
                dataType: 'JSON'
            }).then(function successCallback(response) {
                if (response.data.Error === true) {
                    noty({ text: response.data.Message, layout: 'topRight', type: 'error' });
                }
                else {
                    noty({ text: response.data.Message, layout: 'topRight', type: 'success' });
                    for (var i = 0; i < $scope.getAllPersonalBlogPostList.length; i++) {
                        var ob = $scope.getAllPersonalBlogPostList[i];
                        if (ob.Id === id) {
                            $scope.getAllPersonalBlogPostList.splice(i, 1)
                        }
                    }
                    for (var i = 0; i < $scope.allBlogPostList.length; i++) {
                        var ob = $scope.allBlogPostList[i];
                        if (ob.Id === id) {
                            $scope.allBlogPostList.splice(i, 1)
                            $scope.allBlogPostListSearchParameters.Total_Count = $scope.allBlogPostListSearchParameters.Total_Count -1;
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
    $scope.postDetailOb = {};
    $scope.getPostDetail = function (data) {
        $http({
            method: 'GET',
            url: '/BlogPost/GetPostDetailWithId?id=' + data.Id
        }).then(function successCallback(response) {
            if (response.data !== '') {
                var elements = [];
                angular.forEach(response.data, function (item, i) {
                    $scope.postDetailOb.Id = item.Id
                    $scope.postDetailOb.Title = item.Title
                    $scope.postDetailOb.UserId = item.UserId
                    $scope.postDetailOb.CategoryId = item.CategoryId
                    $scope.postDetailOb.AddedDate = item.AddedDate
                    $scope.postDetailOb.AuthorName = item.AuthorName
                    $scope.postDetailOb.TempSrc = getFileUrl(item.FileId, item.FileName);
                    elements.push(item.PostText);
                });
                $scope.postDetailOb.PostText = elements.join(' ');
                angular.element(document.querySelector('#modal_basic')).modal('show');
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