'use strict';
AdminForumPostController.$inject = ['$scope', '$rootScope', '$http', '$location', '$routeParams', '$cookies', '$cookieStore', '$filter', 'fileReader', '$compile', '$window'];
function AdminForumPostController($scope, $rootScope, $http, $location, $routeParams, $cookies, $cookieStore, $filter, fileReader, $compile, $window) {
    $scope.title = "Blog Post";
    $scope.action = 'Save';
    $scope.showEditButton = false;
    $scope.blogPostList = [];
    $scope.forumPostOb = {
        Id: null,
        Title: null,
        Active: true,
        CategoryId: 4,
        FileName: null,
        FileId: null,
        UserId: null,
        IsFeatured: false
    }
    $scope.forumPostDetail = {
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
    //**AllForumPostList**/
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
                url: '/BlogPost/GetAllForumPostList?pageNo=' + $scope.allBlogPostListSearchParameters.PageNo + '&pageSize=' + $scope.allBlogPostListSearchParameters.PageSize
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
    $scope.postDetailOb = {};
    $scope.getPostDetail = function (item) {
        var elements = [];
        $scope.postDetailOb.Id = item.Id
        $scope.postDetailOb.Title = item.Title
        $scope.postDetailOb.UserId = item.UserId
        $scope.postDetailOb.CategoryId = item.CategoryId
        $scope.postDetailOb.AddedDate = item.AddedDate
        $scope.postDetailOb.AuthorName = item.AuthorName
        $scope.postDetailOb.TempSrc = getFileUrl(item.FileId, item.FileName);
        elements.push(item.PostText);
        $scope.postDetailOb.PostText = elements.join(' ');
        angular.element(document.querySelector('#modal_basic')).modal('show');
    }
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
                    for (var i = 0; i < $scope.allBlogPostList.length; i++) {
                        var ob = $scope.allBlogPostList[i];
                        if (ob.Id === id) {
                            $scope.allBlogPostList.splice(i, 1)
                            $scope.allBlogPostListSearchParameters.Total_Count = $scope.allBlogPostListSearchParameters.Total_Count - 1;
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
    function getFileUrl(fileId, fileName) {
        if (fileName != null) {
            var str = fileName;
            var extention = str.substr(str.indexOf('.'));
            return '/UploadFiles/UsersFilePhoto/' + $scope.forumPostOb.CategoryName + '/' + fileId + extention;
        } else {
            return fileName;
        }
    }
};