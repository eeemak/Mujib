'use strict';
NewsController.$inject = ['$scope', '$rootScope', '$http', '$location', '$routeParams', '$cookies', '$cookieStore', '$compile','$window'];
function NewsController($scope, $rootScope, $http, $location, $routeParams, $cookies, $cookieStore,$compile,  $window) {
    $rootScope.title = "News";
    $scope.newsList=[];
    $scope.newsTitleOb={};
    $scope.newsRightList=[];
    $scope.headerNewsBottomList=[];
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
    $scope.getAllGeneralNewsPostList = [];
    $scope.getPersonalList = function () {
        $scope.pageChangeHandler = function (num) {
            $scope.PostListSearchParameters.PageNo = num != undefined ? num : 1;
            $http({
                method: 'GET',
                url: 'api/GetAllPublicNewsPosts/'+ $scope.PostListSearchParameters.PageSize + '?page=' + $scope.PostListSearchParameters.PageNo
            }).then(function successCallback(result) {
                $scope.PostListSearchParameters.Total_Count = result.data.meta.total;
                $scope.getAllGeneralNewsPostList=result.data.data.filter(function(ob) {
                    return ob.post_categories[0].name =="general_news";
                  });
                var ob= result.data.data.filter(function(ob) {
                    return ob.post_categories[0].name =="header_news";
                  });
                  $scope.newsTitleOb=ob[0];
                  $scope.newsRightList=result.data.data.filter(function(ob) {
                    return ob.post_categories[0].name =="header_news_right";
                  });
                  $scope.headerNewsBottomList=result.data.data.filter(function(ob) {
                    return ob.post_categories[0].name =="header_news_bottom";
                  });
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