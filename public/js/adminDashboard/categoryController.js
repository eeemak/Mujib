'use strict';
CategoryController.$inject = ['$scope', '$rootScope', '$http', '$location', '$routeParams', '$cookies', '$cookieStore', '$filter', 'fileReader'];
function CategoryController($scope, $rootScope, $http, $location, $routeParams, $cookies, $cookieStore, $filter, fileReader) {
    $scope.title = "Category";
    $scope.categoryList = [];
function category() {
    $scope.categoryOb ={
        id:null,
        name:null
    }
}
category();
    $scope.categorySearchParameters = {
        PageSize: 12,
        Total_Count: 0,
        CurrentPage: 1,
        PageNo: 1
    }
    $scope.getAllCategories = function () {
        $scope.pagecategoryChangeHandler = function (num) {
            $scope.categorySearchParameters.PageNo = num != undefined ? num : 1;
            $http({
                method: 'GET',
                url: '/api/post-category?page=' + $scope.categorySearchParameters.PageNo + '&take=' + $scope.categorySearchParameters.PageSize
            }).then(function successCallback(response) {
                $scope.categoryList = response.data.data;
            })
        };
        $scope.pagecategoryChangeHandler();
    }
    $scope.save = function () {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "/api/post-category",
                    dataType: "json",
                    data: $scope.categoryOb,
                    success: function (response) {
                        noty({ text: response.data.name +" added!", layout: 'topRight', type: 'success',timeout:5000 });
                        category();
                        $scope.getAllCategories();
                    },
                    error: function () {
                    }
                });
           
    }
  
    $scope.delete = function (id) {
        if (id != null || id != undefined) {
            $http({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'DELETE',
                url: '/api/post-category/' + id,
                dataType: 'JSON'
            }).then(function successCallback(response) {
                noty({ text: response.data.data.name + ' has deleted!', layout: 'topRight', type: 'success',timeout:5000 });
                $scope.getAllCategories();
            }, function errorCallback(response) {
                noty({ text: 'Something went wrong!', layout: 'topRight', type: 'error',timeout:5000 });
            });
        }
        else {
            noty({ text: "No Post Found to delete", layout: 'topRight', type: 'error',timeout:5000 });
        }
        return true;
    };

   
};