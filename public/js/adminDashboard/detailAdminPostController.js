'use strict';
DetailAdminPostController.$inject = ['$scope', '$rootScope', '$http', '$location', '$routeParams', '$cookies', '$cookieStore', '$filter', '$compile'];
function DetailAdminPostController($scope, $rootScope, $http, $location, $routeParams, $cookies, $cookieStore, $filter, $compile) {
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
        Sequence: null,
        PostText: null,
        AuthorName: null,
        AddedDate: null,
        UpdatedDate: null
    }
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
                    $scope.blogPostOb.CategoryId = item.CategoryId
                    $scope.blogPostOb.AddedDate = item.AddedDate
                    $scope.blogPostOb.UpdatedDate = item.UpdatedDate
                    $scope.blogPostOb.AuthorName = item.AuthorName
                    $scope.blogPostOb.TempSrc = getFileUrl(item.FileId, item.FileName);
                    elements.push(item.PostText);
                });
                $scope.blogPostOb.PostText = elements.join(' ');
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