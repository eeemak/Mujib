'use strict';
MotamotController.$inject = ['$scope', '$rootScope', '$http', '$location', '$routeParams', '$cookies', '$cookieStore', '$compile','$window'];
function MotamotController($scope, $rootScope, $http, $location, $routeParams, $cookies, $cookieStore,$compile,  $window) {
    $rootScope.title = "Motamot";
    $scope.motamotList=[];
    $scope.showPane = function() {
        $scope.isPaneShown = true;
      };
      $scope.showPane();
      $scope.hidePane = function() {
        $scope.isPaneShown = false;
      };
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
                url: 'api/GetAllPublicMotamotPosts/'+ $scope.PostListSearchParameters.PageSize + '?page=' + $scope.PostListSearchParameters.PageNo
            }).then(function successCallback(result) {
                $scope.getAllPersonalmotamotPostList = result.data.data;
                $scope.PostListSearchParameters.Total_Count = result.data.meta.total;
            })
        };
        $scope.pageChangeHandler();
    }
    $scope.getPersonalList();
    $scope.truncString = function (str, max, add) {
        add = add || '...';
        return (typeof str === 'string' && str.length > max ? str.substring(0, max) + add : str);
    };
}