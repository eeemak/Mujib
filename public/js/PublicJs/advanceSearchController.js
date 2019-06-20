AdvanceSearchController.$inject = ['$scope', '$rootScope', '$http', '$location', '$routeParams', '$cookies', '$cookieStore', '$window'];

// Now create our controller function with all necessary logic
function AdvanceSearchController($scope, $rootScope, $http, $location, $routeParams, $cookies, $cookieStore, $window) {
    $scope.title = "Advance Search";
    var getQueryString = {
        DistrictId: null,
        ThanaId: null,
        PoliceStationId: null,
        VillageId: null,
    }
    $scope.querystringProfessionId = getAllUrlParams().professionid;
    $scope.querystringSearchType = getAllUrlParams().searchtype;
    getQueryString = {
        DistrictId: getAllUrlParams().districtid,
        ThanaId: getAllUrlParams().thanaid,
        PoliceStationId: getAllUrlParams().policestationid,
        VillageId: getAllUrlParams().villageid,
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
    $scope.addvertiseSearchParameters = {
        PageSize: 10,
        Total_Count: 0,
        CurrentPage: 1,
        PageNo: 1
    }
    $scope.addvertiseList = [];
    $scope.getAddvertiseList = function () {
        $http({
            method: 'GET',
            url: '/AdvanceSearch/GetAddVertiseListWithAmmount?categoryId=' + 1 + '&pageNo=' + $scope.addvertiseSearchParameters.PageNo + '&pageSize=' + $scope.addvertiseSearchParameters.PageSize
        }).then(function successCallback(response) {
            if (response.data.Items.length > 0) {
                angular.forEach(response.data.Items, function (item) {
                    item.TempSrc = getFileUrl(item.FileId, item.FileName);
                });
                $scope.addvertiseList = response.data.Items;
            }
        })
    }
    $scope.getAddvertiseList();
    function getFileUrl(fileId, fileName) {
        var str = fileName;
        var extention = str.substr(str.indexOf('.'));
        return '/UploadFiles/AdvertisePhoto/' + fileId + extention;
    }
    $scope.getAddInfo = function (data) {
        $scope.addTitle = data.Title;
        $scope.addDescription = data.Description;
        angular.element(document.querySelector('#addModal')).modal('show');
    }
    $scope.UserByAdvanceSearchParameters = {
        PageSize: 10,
        Total_Count: 0,
        CurrentPage: 1,
        PageNo: 1
    }
    $scope.advanceSearchUserList = [];
    $scope.getUserByAdvanceSearch = function () {
        $cookieStore.remove("professionId");
        $cookieStore.remove("csearchType");
        $scope.querystringProfessionId = null;
        $scope.pageChangeHandler = function (num) {
            $scope.UserByAdvanceSearchParameters.PageNo = num != undefined ? num : 1;
            $http({
                method: 'GET',
                url: '/AdvanceSearch/AdvanceSearchData?pageNo=' + $scope.UserByAdvanceSearchParameters.PageNo + '&pageSize=' + $scope.UserByAdvanceSearchParameters.PageSize + '&districtId=' + getQueryString.DistrictId + '&thanaId=' + getQueryString.ThanaId + '&policeStationId=' + getQueryString.PoliceStationId + '&villageId=' + getQueryString.VillageId
            }).then(function successCallback(response) {
                $scope.advanceSearchUserList = response.data.Items;
                $scope.UserByAdvanceSearchParameters.Total_Count = response.data.Pager.TotalItems;
            })
        };
        $scope.pageChangeHandler();
    }
    if ($scope.querystringSearchType === "location")
        $scope.getUserByAdvanceSearch();
    $scope.getUserByProfession = function () {
        var getQueryString = {
            DistrictId: null,
            ThanaId: null,
            PoliceStationId: null,
            VillageId: null,
        }
        $scope.pageChangeHandler = function (num) {
            $scope.UserByAdvanceSearchParameters.PageNo = num != undefined ? num : 1;
            $http({
                method: 'GET',
                url: '/AdvanceSearch/GetUserByProfession?pageNo=' + $scope.UserByAdvanceSearchParameters.PageNo + '&pageSize=' + $scope.UserByAdvanceSearchParameters.PageSize + '&professionId=' + $scope.querystringProfessionId
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
    }
    if ($scope.querystringSearchType === "profession")
        $scope.getUserByProfession();
    //**************AdvanceSearch****************/
    $scope.advanceSearchData = {
        DistrictId: null,
        ThanaId: null,
        PoliceStationId: null,
        VillageId: null,
        ProfessionId: null
    }
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
        if ($scope.advanceSearchData.DistrictId != null) {
            $http({
                method: 'GET',
                url: '/Home/GetThana?districtId=' + $scope.advanceSearchData.DistrictId
            }).then(function successCallback(response) {
                $scope.thanaList = response.data;
            })
        }
        else {
            $scope.thanaList = [];
        }
    }
    $scope.policeStationList = [];
    $scope.getPoliceStation = function () {
        if ($scope.advanceSearchData.DistrictId != null || $scope.advanceSearchData.ThanaId != null) {
            $http({
                method: 'GET',
                url: '/Home/GetPoliceStation?thanaId=' + $scope.advanceSearchData.ThanaId + '&districtId=' + $scope.advanceSearchData.DistrictId
            }).then(function successCallback(response) {
                $scope.policeStationList = response.data;
            })
        }
    }
    $scope.villageList = [];
    $scope.getVillage = function () {
        $http({
            method: 'GET',
            url: '/Home/GetVillage?policeStationId=' + $scope.advanceSearchData.PoliceStationId + '&thanaId=' + $scope.advanceSearchData.ThanaId + '&districtId=' + $scope.advanceSearchData.DistrictId
        }).then(function successCallback(response) {
            $scope.villageList = response.data;
        })
    }
    $scope.getUserByAdvanceSearchForThis = function () {
        $scope.pageChangeHandler = function (num) {
            if ($scope.advanceSearchData.DistrictId != null || $scope.advanceSearchData.ThanaId != null || $scope.advanceSearchData.PoliceStationId != null || $scope.advanceSearchData.VillageId != null) {
                $scope.UserByAdvanceSearchParameters.PageNo = num != undefined ? num : 1;
                $http({
                    method: 'GET',
                    url: '/AdvanceSearch/AdvanceSearchData?pageNo=' + $scope.UserByAdvanceSearchParameters.PageNo + '&pageSize=' + $scope.UserByAdvanceSearchParameters.PageSize + '&districtId=' + $scope.advanceSearchData.DistrictId + '&thanaId=' + $scope.advanceSearchData.ThanaId + '&policeStationId=' + $scope.advanceSearchData.PoliceStationId + '&villageId=' + $scope.advanceSearchData.VillageId
                }).then(function successCallback(response) {
                    $scope.advanceSearchUserList = response.data.Items;
                    $scope.UserByAdvanceSearchParameters.Total_Count = response.data.Pager.TotalItems;
                    if ($scope.advanceSearchUserList.length < 1) {
                        $scope.resultFound = false;
                    } else {
                        $scope.resultFound = true;
                    }
                })
            }
        }
        $scope.pageChangeHandler();
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
    $scope.getUserByProfessionForThis = function () {
        $cookies.remove("professionId");
        $scope.querystringProfessionId = null;
        $scope.pageChangeHandler = function (num) {
            $scope.UserByAdvanceSearchParameters.PageNo = num != undefined ? num : 1;
            $http({
                method: 'GET',
                url: '/AdvanceSearch/GetUserByProfession?pageNo=' + $scope.UserByAdvanceSearchParameters.PageNo + '&pageSize=' + $scope.UserByAdvanceSearchParameters.PageSize + '&professionId=' + $scope.advanceSearchData.ProfessionId
            }).then(function successCallback(response) {
                $scope.advanceSearchUserList = response.data.Items;
                $scope.UserByAdvanceSearchParameters.Total_Count = response.data.Pager.TotalItems;
                if (response.data === "") {
                    $scope.userFoundByProfession = null;
                    $scope.noProfessionResultFound = true;
                } else {
                    $scope.noProfessionResultFound = false;
                }
            })
        }
        $scope.pageChangeHandler();
    }
    $scope.getUserByProfessionAndLocation = function () {
        $cookieStore.remove("professionId");
        $scope.querystringProfessionId = null;
        $scope.pageChangeHandler = function (num) {
            $scope.UserByAdvanceSearchParameters.PageNo = num != undefined ? num : 1;
            $http({
                method: 'GET',
                url: '/AdvanceSearch/GetUserByProfessionAndLocation?pageNo=' + $scope.UserByAdvanceSearchParameters.PageNo + '&pageSize=' + $scope.UserByAdvanceSearchParameters.PageSize + '&professionId=' + $scope.advanceSearchData.ProfessionId + '&districtId=' + $scope.advanceSearchData.DistrictId + '&thanaId=' + $scope.advanceSearchData.ThanaId + '&policeStationId=' + $scope.advanceSearchData.PoliceStationId + '&villageId=' + $scope.advanceSearchData.VillageId
            }).then(function successCallback(response) {
                $scope.advanceSearchUserList = response.data.Items;
                $scope.UserByAdvanceSearchParameters.Total_Count = response.data.Pager.TotalItems;
                if (response.data === "") {
                    $scope.userFoundByProfession = null;
                    $scope.noProfessionResultFound = true;
                } else {
                    $scope.noProfessionResultFound = false;
                }
            })
        }
        $scope.pageChangeHandler();
    }
}