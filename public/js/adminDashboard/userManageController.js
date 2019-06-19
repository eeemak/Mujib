'use strict';
UserManageController.$inject = ['$scope', '$rootScope', '$http', '$location', '$routeParams', '$cookies', '$cookieStore', '$filter'];
function UserManageController($scope, $rootScope, $http, $location, $routeParams, $cookies, $cookieStore, $filter) {
    $scope.title = "User Manage";
    $scope.userMobileList = [];
    $scope.userInstituteList = [];
    $scope.userLinkList = [];
    $scope.userSocialLinkList = [];
    $scope.educationLicenseList = [];
    $scope.familyAndFriendsNoList = [];
    $scope.userEmailList = [];
    $scope.userCardList = [];
    $scope.editUserProfile = {
        Id: null,
        FullName: null,
        PermanentAddress: null,
        PresentAddress: null,
        AboutSelf: null,
        DistrictId: null,
        ThanaId: null,
        PoliceStationId: null,
        VillageId: null,
        VillageName: null,
        Phone: null,
        EmailId: null,
        NIDNo: null,
        NIdFileName: null,
        NIDFileId: null,
        PassportNo: null,
        PassportFileName: null,
        PassportFileId: null,
        DrivingLicenseNo: null,
        DrivingLicenseFileName: null,
        DrivingLicenseFileNo: null,
        BirthLicenseNo: null,
        BirthLicenseFileName: null,
        BirthLicenseFileNo: null,
        NationalityLicenseNo: null,
        NationalityLicenseFileName: null,
        NationalityLicenseFileNo: null,
        TradeLicenseNo: null,
        TradeLicenseFileName: null,
        TradeLicenseFileNo: null,
        TaxtLicenseNo: null,
        TaxtLicenseFileName: null,
        TaxtLicenseFileNo: null,
        PhotoPath: ''
    }
    $scope.userDetailOb = {
        FullName: null,
        Phone: null,
        EmailId: null,
        PermanentAddress: null,
        PresentAddress: null,
        PhotoPath: '',
        AddedDate:null
    }
    $scope.UserListSearchParameters = {
        PageSize: 10,
        Total_Count: 0,
        CurrentPage: 1,
        PageNo: 1
    }
    $scope.usersList = [];
    $scope.getUserList = function () {
        $scope.pageChangeHandler = function (num) {
            $scope.UserListSearchParameters.PageNo = num != undefined ? num : 1;
            $http({
                method: 'GET',
                url: '/AdminDashboard/GetUserList?pageNo=' + $scope.UserListSearchParameters.PageNo + '&pageSize=' + $scope.UserListSearchParameters.PageSize
            }).then(function successCallback(response) {
                if (response.data.Items.length > 0) {
                    //angular.forEach(response.data.Items, function (item) {
                    //    item.TempSrc = getFileUrl(item.FileId, item.FileName);
                    //});
                    $scope.usersList = response.data.Items;
                }
                $scope.UserListSearchParameters.Total_Count = response.data.Pager.TotalItems;
            })
        };
        $scope.pageChangeHandler();
    }
    $scope.getUserList();
    $scope.getUserInfoById = function () {
        $http({
            method: 'GET',
            url: '/AdminDashboard/GetUserById'
        }).then(function successCallback(response) {
            $scope.editUserProfile = response.data;
            $scope.getDistrict();
            $scope.getUserInstructionById();
            $scope.getUserMobileById();
            $scope.getEmailLinkById();
            $scope.getFamilyAndFriendPhoneById();
            $scope.getUserLinkById();
            $scope.getSocialLinkById();
            $scope.getUserFileById();
            if (response.data === "") {
                $scope.userFoundByPhone = null;
            }
            console.log($scope.userFoundByPhone)
        })
    }
    $scope.professionTypeList = [];
    $scope.getProfessionType = function () {
        $http({
            method: 'GET',
            url: '/UserDashboard/GetProfessionTypeCbo'
        }).then(function successCallback(response) {
            $scope.professionTypeList = response.data;
        })
    }
    $scope.getProfessionType();
    //**************AdvanceSearch****************/
    $scope.districtList = [];
    $scope.getDistrict = function () {
        $http({
            method: 'GET',
            url: '/Home/GetDistrict'
        }).then(function successCallback(response) {
            $scope.districtList = response.data;
            $scope.getThana();
        })
    }
    $scope.thanaList = [];
    $scope.getThana = function () {
        if ($scope.editUserProfile.DistrictId !== null) {
            $http({
                method: 'GET',
                url: '/Home/GetThana?districtId=' + $scope.editUserProfile.DistrictId
            }).then(function successCallback(response) {
                $scope.thanaList = response.data;
                $scope.getPoliceStation();
            })
        }
    }
    $scope.policeStationList = [];
    $scope.getPoliceStation = function () {
        $http({
            method: 'GET',
            url: '/Home/GetPoliceStation?thanaId=' + $scope.editUserProfile.ThanaId + '&districtId=' + $scope.editUserProfile.DistrictId
        }).then(function successCallback(response) {
            $scope.policeStationList = response.data;
            $scope.getVillage();
        })
    }
    $scope.villageList = [];
    $scope.getVillage = function () {
        $http({
            method: 'GET',
            url: '/Home/GetVillage?policeStationId=' + $scope.editUserProfile.PoliceStationId + '&thanaId=' + $scope.editUserProfile.ThanaId + '&districtId=' + $scope.editUserProfile.DistrictId
        }).then(function successCallback(response) {
            $scope.villageList = response.data;
        })
    }
    $scope.getUserInstructionById = function () {
        $http({
            method: 'GET',
            url: '/UserDashboard/GetUserInstructionList'
        }).then(function successCallback(response) {
            if (response.data !== '') {
                $scope.userInstituteList = response.data;
            }
        })
    }
    $scope.getUserMobileById = function () {
        $http({
            method: 'GET',
            url: '/UserDashboard/GetUserMobileList'
        }).then(function successCallback(response) {
            if (response.data !== '') {
                $scope.userMobileList = response.data;
            }
        })
    }
    $scope.getEmailLinkById = function () {
        $http({
            method: 'GET',
            url: '/UserDashboard/GetEmailLinkList'
        }).then(function successCallback(response) {
            if (response.data !== '') {
                $scope.userEmailList = response.data;
            }
        })
    }
    $scope.getFamilyAndFriendPhoneById = function () {
        $http({
            method: 'GET',
            url: '/UserDashboard/GetFamilyAndFriendPhoneList'
        }).then(function successCallback(response) {
            if (response.data !== '') {
                $scope.familyAndFriendsNoList = response.data;
            }
        })
    }
    $scope.getUserLinkById = function () {
        $http({
            method: 'GET',
            url: '/UserDashboard/GetUserLinkList'
        }).then(function successCallback(response) {
            if (response.data !== '') {
                $scope.userLinkList = response.data;
            }
        })
    }
    $scope.getSocialLinkById = function () {
        $http({
            method: 'GET',
            url: '/UserDashboard/GetSocialLinkList'
        }).then(function successCallback(response) {
            if (response.data !== '') {
                $scope.userSocialLinkList = response.data;
            }
        })
    }
    $scope.addMobileNo = function () {
        $scope.userMobileList.push({
            MobileNo: null,
            SerialNo: null
        });
    }
    $scope.deleteMobileNo = function (index) {
        $scope.userMobileList.splice(index, 1);
    }
    $scope.getUserFileById = function () {
        $http({
            method: 'GET',
            url: '/UserDashboard/GetUserFileModelById'
        }).then(function successCallback(response) {
            if (response.data !== '') {
                $scope.userFileList = response.data;
            }
        })
    }
    //----------------
    $scope.getUserDetail = function (data) {
        $scope.userDetailOb = {
            FullName: data.FullName,
            Phone: data.Phone,
            EmailId: data.EmailId,
            PermanentAddress: data.PermanentAddress,
            PresentAddress: data.PresentAddress,
            PhotoPath: data.PhotoPath
        }
    }
    //----------------
    function myFunction(msg) {
        $scope.msgText = msg
        var x = document.getElementById("snackbar")
        x.className = "show";
        setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);
    }
    function getFileUrl(fileId, fileName) {
        var str = fileName;
        var extention = str.substr(str.indexOf('.'));
        return '/UploadFiles/UsersFilePhoto/' + fileId + extention;
    }
};