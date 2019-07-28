'use strict';
DetailNewsPostController.$inject = ['$scope', '$rootScope', '$http', '$location', '$routeParams', '$cookies', '$cookieStore', '$filter', '$compile'];
function DetailNewsPostController($scope, $rootScope, $http, $location, $routeParams, $cookies, $cookieStore, $filter, $compile) {
    $scope.title = "Detail Post";
    $scope.action = 'Save';
    $scope.showEditButton = true;
    $scope.IsShowCommentBox = true;
    $scope.newsPostList = [];
    $scope.newsPostOb = {
       Id : null,
       Title :null,
       PostDetail : null,
       UserFullName : null,
       FilePath : null,
       CategoryName : null,
       CreatedAt : null,
    }
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
                $scope.newsPostOb.UserFullName = item.user_full_name
                $scope.newsPostOb.FilePath = item.file_path
                $scope.newsPostOb.CategoryName = item.post_categories.length > 0 ? item.post_categories[0].name : null
                $scope.newsPostOb.CreatedAt = item.created_at
                $scope.getCommentListWithPostId(item.id);
            }
        })
    }
    $scope.SaveComment = function () {
        // $scope.commentOb.CommentCount = 1;
        // $scope.commentOb.Id = null;
        $scope.commentOb.PostId = $scope.newsPostOb.Id;
        // $scope.commentOb.CategoryId = $scope.blogPostOb.CategoryId;
        $rootScope.showPageLoading = false;
        // console.log('comment', $scope.commentOb);
        $http({
            method: "post",
            url: '/api/CommentInsert/',
            data: $scope.commentOb,
            dataType: "json"
        }).then(function successCallback(response) {
            // console.log(response);
            if (response.data.Error === true) {
                noty({ text: response.data.Message, layout: 'topRight', type: 'error' });
            }
            else {
                $scope.getCommentListWithPostId($scope.commentOb.PostId);
                clearComment();
            }
        }), function errorCallBack(response) {
            showResult(response.data.Message, 'failure');
        }
    }
    $scope.commentList = [];
    $scope.getCommentListWithPostId = function (postId) {
        $http({
            method: 'GET',
            url: '/api/GetCommentListWithPostId?postId=' + postId
        }).then(function successCallback(response) {
            // console.log('res', response);
            var data = response.data.data;
            if (data.length > 0) {
                $scope.commentList = [];
                var tempChildList = [];
                angular.forEach(data, function (item, i) {
                    if (item.parent_id === null) {
                        item.ShowNewCommentBox = false;
                        item.ChildCommentList = [];
                        $scope.commentList.push(item);
                    } else {
                        tempChildList.push(item);
                    }
                })
                angular.forEach($scope.commentList, function (item, i) {
                    angular.forEach(tempChildList, function (itemx) {
                        if (item.id === itemx.parent_id && itemx.parent_id != null) {
                            itemx.ShowNewCommentBox = false;
                            $scope.commentList[i].ChildCommentList.push(itemx);
                        }
                    })
                });
            }
        })
    }
    $scope.showCommentBox = function (id, index) {
        $scope.IsShowCommentBox = false;
        $scope.commentOb.ParentId = id;
        angular.forEach($scope.commentList, function (item, i) {
            if (item.id === id) {
                item.ShowNewCommentBox = true;
            } else {
                item.ShowNewCommentBox = false;
            }
            angular.forEach(item.ChildCommentList, function (item2, y) {
                if (item2.id === id) {
                    item2.ShowNewCommentBox = true;
                } else {
                    item2.ShowNewCommentBox = false;
                }
            })
        })
    }
    $scope.showMainCommentBox = function () {
        $scope.IsShowCommentBox = true;
        $scope.commentOb.ParentId = null;
        angular.forEach($scope.commentList, function (item, i) {
            item.ShowNewCommentBox = false;
            angular.forEach(item.ChildCommentList, function (item2, y) {
                item2.ShowNewCommentBox = false;
            })
        })
    }

   function clearComment() {
        $scope.commentOb = {
            Id: null,
            PostId: null,
            CategoryId: null,
            ParentId: null,
            CommentText: null,
            IsActive: true
        }
    }
    clearComment();
};