'use strict';
CategoryController.$inject = ['$scope', '$rootScope', '$http', '$location', '$routeParams', '$cookies', '$cookieStore', '$filter', 'fileReader'];
function CategoryController($scope, $rootScope, $http, $location, $routeParams, $cookies, $cookieStore, $filter, fileReader) {
    $scope.title = "Category";
    $scope.categoryList = [];
function category() {
    $scope.categoryOb ={
        Id:null,
        Name:null
    }
}
category();
    $scope.categorySearchParameters = {
        PageSize: 12,
        Total_Count: 0,
        CurrentPage: 1,
        PageNo: 1
    }
    $scope.getcategoryById = function () {
        $scope.pagecategoryChangeHandler = function (num) {
            $scope.categorySearchParameters.PageNo = num != undefined ? num : 1;
            $http({
                method: 'GET',
                url: '/api/GetCategory?pageNo=' + $scope.categorySearchParameters.PageNo + '&pageSize=' + $scope.categorySearchParameters.PageSize
            }).then(function successCallback(response) {
                $scope.categoryList = response.data;
            })
        };
        $scope.pagecategoryChangeHandler();
    }
    $scope.saveCategory = function () {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: "POST",
                    url: "/api/SaveCategory",
                    contentType: false,
                    processData: false,
                    data: $scope.categoryOb,
                    success: function () {
                        noty({ text: "category added!", layout: 'topRight', type: 'success',timeout:5000 });
                        category();
                        $scope.getcategoryById();
                    },
                    error: function () {
                    }
                });
           
    }
  
    $scope.deleteCategory = function (data) {
        if (data.id != null || data.id != undefined) {
            $http({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: 'POST',
                url: '/api/DeleteCategory?categoryId=' + data.id,
                dataType: 'JSON'
            }).then(function successCallback(response) {
                noty({ text: response.data.title + ' has deleted!', layout: 'topRight', type: 'success',timeout:5000 });
                $scope.getcategoryById();
            }, function errorCallback(response) {
                noty({ text: response.data.Message, layout: 'topRight', type: 'error',timeout:5000 });
            });
        }
        else {
            noty({ text: "No Post Found to delete", layout: 'topRight', type: 'error',timeout:5000 });
        }
        return true;
    };

   
};