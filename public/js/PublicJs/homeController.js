'use strict';
HomeController.$inject = ['$scope', '$rootScope', '$http', '$location', '$routeParams', '$cookies', '$cookieStore', '$window'];
function HomeController($scope, $rootScope, $http, $location, $routeParams, $cookies, $cookieStore, $window) {
    $rootScope.title = "Administration::Login";
    $scope.phoneText = null;
    $scope.userFoundByPhone = null;
    $scope.noResultFound = false;
    // $scope.getUserByPhone = function () {
    //     $http({
    //         method: 'GET',
    //         url: '/Home/GetUserByPhone?phone=' + $scope.phoneText
    //     }).then(function successCallback(response) {
    //         $scope.userFoundByPhone = response.data;
    //         if (response.data === "") {
    //             $scope.userFoundByPhone = null;
    //             $scope.noResultFound = true;
    //         } else {
    //             $scope.noResultFound = false;
    //             getSocialLinkWithPhone();
    //         }
    //     })
    // }
    // $scope.clearUserFound = function () {
    //     $scope.userFoundByPhone = null;
    //     $scope.noResultFound = false;
    // }
    $scope.advertisementList =[];
    $scope.getAdvertisements = function () {
        $http({
            method: 'GET',
            url: 'api/GetPublicAdvertise/10?page=1'
        }).then(function successCallback(response) {
            if (response.data !== '') {
                $scope.advertisementList = response.data.data;
            }
        })
    }
    $scope.getAdvertisements();


    // $scope.socialLinkList = [];
    // function getSocialLinkWithPhone() {
    //     $http({
    //         method: 'GET',
    //         url: '/Home/GetSocialLinkListWithPhone?phone=' + $scope.phoneText
    //     }).then(function successCallback(response) {
    //         $scope.socialLinkList = response.data;
    //     })
    // }
    //  $scope.getUserByProfession = function (id) {
    //     var obj = {
    //         searchType: 'Profession',
    //         professionId: id,
    //         districtId: null,
    //         thanaId: null,
    //         policeStationId: null,
    //         villageId: null,
    //     }
    //     $cookies.remove('cookieName', { path: '/' });
    //     $cookies.putObject('cookieName', '', '/');
    //     $cookies.putObject('cookieName', obj, '/');
    //     location.href = '/advanceSearch/index?searchType=Profession&professionId=' + id + '&districtId=' + $scope.advanceSearchData.DistrictId + '&thanaId=' + $scope.advanceSearchData.ThanaId + '&policeStationId=' + $scope.advanceSearchData.PoliceStationId + '&villageId=' + $scope.advanceSearchData.VillageId
    // }
    // $scope.clearProfessionFound = function () {
    //     $scope.userFoundByProfession = null;
    //     $scope.noProfessionResultFound = false;
    // }
    // $scope.activeBtn = 'phonesearch';
    // $scope.getActiveButton = function(value) {
    //     $scope.activeBtn = value;
    //     $scope.userFoundByPhone = null
    // }
    //**************AdvanceSearch****************/
    $scope.advanceSearchData = {
        DistrictId: null,
        ThanaId: null,
        PoliceStationId: null,
        VillageId: null
    }
    $scope.districtList = [];
    $scope.getDistrict = function () {
        $http({
            method: 'GET',
            url: 'api/GetDistrict'
        }).then(function successCallback(response) {
            $scope.districtList = response.data;
        });
    }
    $scope.getDistrict();
    $scope.thanaList = [];
    $scope.getThana = function () {
        if ($scope.advanceSearchData.DistrictId != null) {
            $http({
                method: 'GET',
                url: 'api/GetThana?districtId=' + $scope.advanceSearchData.DistrictId
            }).then(function successCallback(response) {
                $scope.thanaList = response.data;
            })
        }
    }
    $scope.policeStationList = [];
    $scope.getPoliceStation = function () {
        $http({
            method: 'GET',
            url: '/api/GetPoliceStation?thanaId=' + $scope.advanceSearchData.ThanaId + '&districtId=' + $scope.advanceSearchData.DistrictId
        }).then(function successCallback(response) {
            $scope.policeStationList = response.data;
        });
    }
    $scope.villageList = [];
    $scope.getVillage = function () {
        $http({
            method: 'GET',
            url: '/api/GetVillage?policeStationId=' + $scope.advanceSearchData.PoliceStationId + '&thanaId=' + $scope.advanceSearchData.ThanaId + '&districtId=' + $scope.advanceSearchData.DistrictId
        }).then(function successCallback(response) {
            $scope.villageList = response.data;
        });
    }
    // $scope.advanceSearch = function () {
    //     var obj = {
    //         searchType: 'Location',
    //         professionId: null,
    //         districtId: $scope.advanceSearchData.DistrictId,
    //         thanaId: $scope.advanceSearchData.ThanaId,
    //         policeStationId: $scope.advanceSearchData.PoliceStationId,
    //         villageId: $scope.advanceSearchData.VillageId,
    //     }
    //     $cookies.remove('cookieName', { path: '/' });
    //     $cookies.putObject('cookieName', '', '/');
    //     $cookies.putObject('cookieName', obj, '/');
    //     location.href = '/advanceSearch/index?searchType=Location&districtId=' + $scope.advanceSearchData.DistrictId + '&thanaId=' + $scope.advanceSearchData.ThanaId + '&policeStationId=' + $scope.advanceSearchData.PoliceStationId + '&villageId=' + $scope.advanceSearchData.VillageId

    //     //location.href = '/advanceSearch/index/'
    // }
    // $scope.advanceSearchRefresh = function () {
    //     $scope.advanceSearchData = {
    //         DistrictId: null,
    //         ThanaId: null,
    //         PoliceStationId: null,
    //         VillageId: null,
    //     }
    //     $scope.thanaList = [];
    //     $scope.policeStationList = [];
    //     $scope.villageList = [];
    // }
    // $scope.goToLogin = function () {
    //     location.href = "/Account/Login";
    // }
    //*************End************************/
    //*************Advance Search page*********/
    $scope.UserByAdvanceSearchParameters = {
        PageSize: 10,
        Total_Count: 0,
        CurrentPage: 1,
        PageNo: 1
    }
    $scope.advanceSearchUserList = [];
    $scope.getUserByAdvanceSearch = function () {
        $scope.advanceSearchUserList = [];
        $scope.querystringProfessionId = null;
        $scope.pageChangeHandler = function (num) {
            $scope.UserByAdvanceSearchParameters.PageNo = num != undefined ? num : 1;
            $http({
                method: 'GET',
                url: '/api/AdvanceSearchUsers?pageNo=' + $scope.UserByAdvanceSearchParameters.PageNo + '&pageSize=' + $scope.UserByAdvanceSearchParameters.PageSize + '&districtId=' + $scope.advanceSearchData.DistrictId + '&thanaId=' + $scope.advanceSearchData.ThanaId + '&policeStationId=' + $scope.advanceSearchData.PoliceStationId + '&villageId=' + $scope.advanceSearchData.VillageId
            }).then(function successCallback(response) {
                console.log('response',response.data);
                $scope.advanceSearchUserList = response.data.users;
                $scope.UserByAdvanceSearchParameters.Total_Count = response.data.user_count;
            })
        };
        $scope.pageChangeHandler();
        angular.element(document.querySelector('#thikanaModal')).modal('show');
    }
    if ($scope.querystringSearchType === "location")
        $scope.getUserByAdvanceSearch();
    $scope.getUserByProfession = function () {
        $scope.advanceSearchUserList = [];
        $scope.pageChangeHandler = function (num) {
            $scope.UserByAdvanceSearchParameters.PageNo = num != undefined ? num : 1;
            $http({
                method: 'GET',
                url: '/AdvanceSearch/GetUserByProfession?pageNo=' + $scope.UserByAdvanceSearchParameters.PageNo + '&pageSize=' + $scope.UserByAdvanceSearchParameters.PageSize + '&professionId=' + $scope.searchWithProfessionTypeId
            }).then(function successCallback(response) {
                $scope.advanceSearchUserList = response.data.Items;
                $scope.UserByAdvanceSearchParameters.Total_Count = response.data.Pager.TotalItems;
                if (response.data === "") {
                    $scope.userFoundByProfession = null;
                    $scope.noProfessionResultFound = true;
                } else {
                    $scope.noProfessionResultFound = false;
                }
                console.log($scope.userFoundByPhone)
            })
        }
        $scope.pageChangeHandler();
        angular.element(document.querySelector('#thikanaModal')).modal('show');
    }
    //*************end Advance Search page*****/
    $scope.getAddInfo = function (data) {
        $scope.addTitle = data.Title;
        $scope.addDescription = data.Description;
        angular.element(document.querySelector('#addModal')).modal('show');
    }
    $scope.isDetailShow=false;
    $scope.showDetail=function(){
        $scope.isDetailShow = !$scope.isDetailShow;
    }
};