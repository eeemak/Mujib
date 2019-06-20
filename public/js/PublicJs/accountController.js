'use strict';
function AccountController($scope, $rootScope, $routeParams, $http, $filter, $window, $location, LoginService, $timeout) {
    $rootScope.title = "Registration";
    $scope.registerModel = {
        FullName: null,
        Phone: null,
        Password: null,
        ConfirmPassword: null,
        DistrictId: null,
        ThanaId: null,
        PoliceStationId: null,
        VillageId: null,
        NewVillageName: null,
        ProfessionTypeId: null
    }
    $scope.loginModel = {
        Phone: null,
        Password: null,
        RememberMe: false
    }
    $scope.professionTypeList = [];
    $scope.getProfessionType = function () {
        $http({
            method: 'GET',
            url: '/Home/GetProfessionTypeCbo'
        }).then(function successCallback(response) {
            $scope.professionTypeList = response.data;
        })
    }
    $scope.getProfessionType();
    $scope.userAlreadyExist = false;
    $scope.userAlreadyExistErrorMessage = "";
    $scope.CheckUserAlreadyExist = function () {
        $http({
            method: 'GET',
            url: '/Account/CheckUserExist?phone=' + $scope.registerModel.Phone
        }).then(function successCallback(response) {
            $scope.userAlreadyExistErrorMessage = response.data.Message;
            $scope.userAlreadyExist = response.data.Error;
        })
    }
    //**************AdvanceSearch****************/
    $scope.districtList = [];
    $scope.getDistrict = function () {
        $http({
            method: 'GET',
            url: '/Home/GetDistrict'
        }).then(function successCallback(response) {
            $scope.districtList = response.data;
        })
    }
    $scope.getDistrict();
    $scope.thanaList = [];
    $scope.getThana = function () {
        $http({
            method: 'GET',
            url: '/Home/GetThana?districtId=' + $scope.registerModel.DistrictId
        }).then(function successCallback(response) {
            $scope.thanaList = response.data;
        })
    }
    $scope.policeStationList = [];
    $scope.getPoliceStation = function () {
        $http({
            method: 'GET',
            url: '/Home/GetPoliceStation?thanaId=' + $scope.registerModel.ThanaId + '&districtId=' + $scope.registerModel.DistrictId
        }).then(function successCallback(response) {
            $scope.policeStationList = response.data;
        })
    }
    $scope.villageList = [];
    $scope.getVillage = function () {
        $http({
            method: 'GET',
            url: '/Home/GetVillage?policeStationId=' + $scope.registerModel.PoliceStationId + '&thanaId=' + $scope.registerModel.ThanaId + '&districtId=' + $scope.registerModel.DistrictId
        }).then(function successCallback(response) {
            $scope.villageList = response.data;
        })
    }
    function myFunction(msg) {
        $scope.msgText = msg
        var x = document.getElementById("snackbar")
        x.className = "show";
        setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);
    }
    $scope.showNewVillageField = false;
    $scope.showNewVillage = function () {
        if ($scope.registerModel.VillageId == null && $scope.registerModel.PoliceStationId != null) {
            $scope.showNewVillageField = true;
        } else {
            myFunction("Please Deselect Village First");
        }
    }
    $scope.register = function () {
        if ($scope.registerModel.Password !== $scope.registerModel.ConfirmPassword) {
            return myFunction("Password and ConfirmPassword does not match");
        }
        if ($scope.registerModel.VillageId === null && $scope.registerModel.NewVillageName === null) {
            return myFunction("Please select Village");
        }
        if ($scope.registerModel.Phone === null) {
            return myFunction("Please input Contact no");
        }
        if ($scope.userAlreadyExist) {
            return myFunction("This phone is already used.");
        }
        $scope.$broadcast('show-errors-check-validity');
        if ($scope.registerForm.$valid) {
            $http({
                method: "post",
                url: '/Account/RegisterUser/',
                data: { 'model': $scope.registerModel },
                dataType: "json"
            }).then(function successCallback(response) {
                if (response.data.Error == true) {
                    myFunction(response.data.Message);
                }
                else {
                    myFunction(response.data.Message);
                    $timeout(function () { location.href = '/Account/Login'; }, 3000);

                    ClearFields();
                }
            }), function errorCallBack(response) {
                showResult(response.data.Message, 'failure');
            }
        }
    }

    $scope.login = function () {
        if ($scope.loginForm.$valid) {
            var returnUrl = null;
            if (window.location.search.slice(1) != "") {
                var rr = getAllUrlParams();
                returnUrl = rr.returnurl;
            }
            $http({
                method: "post",
                url: '/Account/Login/',
                data: { 'model': $scope.loginModel, 'returnUrl': returnUrl },
                dataType: "json"
            }).then(function successCallback(response) {
                if (response.data.user != null) {
                    $scope.IsLogedIn = true;
                    $window.location.href = response.data.redirectUrl;
                }
                else {
                    alert('Invalid Credential!');
                }
            })
        }
    }
    function getAllUrlParams(url) {
        // get query string from url (optional) or window
        var queryString = url ? url.split('?')[1] : window.location.search.slice(1);

        // we'll store the parameters here
        var obj = {};

        // if query string exists
        if (queryString) {
            // stuff after # is not part of query string, so get rid of it
            queryString = queryString.split('#')[0];

            // split our query string into its component parts
            var arr = queryString.split('&');

            for (var i = 0; i < arr.length; i++) {
                // separate the keys and the values
                var a = arr[i].split('=');

                // in case params look like: list[]=thing1&list[]=thing2
                var paramNum = undefined;
                var paramName = a[0].replace(/\[\d*\]/, function (v) {
                    paramNum = v.slice(1, -1);
                    return '';
                });

                // set parameter value (use 'true' if empty)
                var paramValue = typeof (a[1]) === 'undefined' ? true : a[1];

                // (optional) keep case consistent
                paramName = paramName.toLowerCase();
                paramValue = paramValue.toLowerCase();

                // if parameter name already exists
                if (obj[paramName]) {
                    // convert value to array (if still string)
                    if (typeof obj[paramName] === 'string') {
                        obj[paramName] = [obj[paramName]];
                    }
                    // if no array index number specified...
                    if (typeof paramNum === 'undefined') {
                        // put the value on the end of the array
                        obj[paramName].push(paramValue);
                    }
                    // if array index number specified...
                    else {
                        // put the value at that index number
                        obj[paramName][paramNum] = paramValue;
                    }
                }
                // if param name doesn't exist yet, set it
                else {
                    obj[paramName] = paramValue;
                }
            }
        }

        return obj;
    }
    function ClearFields() {
        $scope.registerModel = {};
    }
};
AccountController.$inject = ['$scope', '$rootScope', '$routeParams', '$http', '$filter', '$window', '$location', 'LoginService', '$timeout'];