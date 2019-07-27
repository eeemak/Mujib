'use strict';
NewsController.$inject = ['$scope', '$rootScope', '$http', '$location', '$routeParams', '$cookies', '$cookieStore', '$compile','$window'];
function NewsController($scope, $rootScope, $http, $location, $routeParams, $cookies, $cookieStore,$compile,  $window) {
    $rootScope.title = "News";
    $scope.newsList=[];

    $scope.PostListSearchParameters = {
        PageSize: 10,
        Total_Count: 0,
        CurrentPage: 1,
        PageNo: 1
    }
    $scope.getAllPersonalnewsPostList = [];
    $scope.getPersonalList = function () {
        $scope.pageChangeHandler = function (num) {
            $scope.PostListSearchParameters.PageNo = num != undefined ? num : 1;
            $http({
                method: 'GET',
                url: 'api/GetAllPublicNewsPosts/'+ $scope.PostListSearchParameters.PageSize + '?page=' + $scope.PostListSearchParameters.PageNo
            }).then(function successCallback(result) {
                // if (result.data.Items.length > 0) {
                //     angular.forEach(result.data.Items, function (item) {
                //         item.TempSrc = getFileUrl(item.FileId, item.FileName);
                //     });
                // }

                $scope.getAllPersonalnewsPostList = result.data.data;
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