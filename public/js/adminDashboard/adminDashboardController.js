'use strict';
AdminDashboardController.$inject = ['$scope', '$rootScope', '$http', '$location', '$routeParams', '$cookies', '$cookieStore', '$filter'];
function AdminDashboardController($scope, $rootScope, $http, $location, $routeParams, $cookies, $cookieStore, $filter) {
    $scope.title = "Admin Dashboard";
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
        PhoneUpdateCount: 0,
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
    $scope.changePassOb = {
        OldPassword: null,
        NewPassword: null,
        NewPasswordConfirm: null
    }
    $scope.changeUserIdOb = {
        Phone: null
    }
    $scope.getUserInfoById = function () {
        $http({
            method: 'GET',
            url: '/UserDashboard/GetUserById'
        }).then(function successCallback(response) {
            $scope.editUserProfile = response.data;
            $scope.changeUserIdOb.Phone = $scope.editUserProfile.Phone;
            $rootScope.userUniquePhotoPath = response.data.PhotoPath;
            $scope.getDistrict();
            $scope.getUserInstructionById();
            $scope.getUserMobileById();
            $scope.getFamilyAndFriendPhoneById();
            $scope.getSocialLinkById();
            $scope.getUserFileById();
            if (response.data === "") {
                $scope.userFoundByPhone = null;
            }
            console.log($scope.userFoundByPhone)
        })
    }
    $scope.getUserInfoById();
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
    $scope.showNewVillageField = false;
    $scope.addNewVillage = function () {
        $scope.editUserProfile.VillageId = null;
        if ($scope.editUserProfile.VillageId == null) {
            $scope.showNewVillageField = true;
        }
    }
    $scope.addUserInstitute = function () {
        $scope.userInstituteList.push({
            ProfessionTypeId: null,
            InstituteName: null,
            Position: null,
            JoiningDate: null,
            EndDate: null,
            Address: null,
            UserId: $scope.editUserProfile.Id
        });
    }
    if ($scope.userInstituteList.length < 1) {
        $scope.addUserInstitute();
    }
    $scope.deleteUserInstitute = function (index) {
        $scope.userInstituteList.splice(index, 1);
    }
    //------------
    $scope.addFamilyAndFriendsNo = function () {
        $scope.familyAndFriendsNoList.push({
            Id: null,
            RelationName: null,
            PhoneNo: null,
            UserId: $scope.editUserProfile.Id
        });
    }
    if ($scope.familyAndFriendsNoList.length < 1) {
        $scope.addFamilyAndFriendsNo();
    }
    $scope.deleteFamilyAndFriendsNo = function (index) {
        $scope.familyAndFriendsNoList.splice(index, 1);
    }

    //----------------

    $scope.addUserSocialLink = function () {
        $scope.userSocialLinkList.push({
            Id: null,
            SocialTypeName: null,
            SocialTypeId: null,
            SocialLink: null,
            UserId: $scope.editUserProfile.Id
        });
    }
    if ($scope.userSocialLinkList.length < 1) {
        $scope.addUserSocialLink();
    }
    $scope.deleteUserSocialLink = function (index) {
        $scope.userSocialLinkList.splice(index, 1);
    }
    $scope.showAddressEditable = false;
    $scope.editAddress = function () {
        $scope.showAddressEditable = true;
    }

    $scope.updateUserProfile = function () {
        $http({
            method: 'POST',
            url: '/UserDashboard/UpdateUser/',
            data: {
                'model': $scope.editUserProfile
                , 'userInstructions': $scope.userInstituteList
                , 'userMobile': $scope.userMobileList
                , 'emailLink': $scope.userEmailList
                , 'familyAndFriendPhone': $scope.familyAndFriendsNoList
                , 'socialLink': $scope.userSocialLinkList
                , 'userLink': $scope.userLinkList
            },
            dataType: "json"
        }).then(function successCallback(response) {
            if (response.data.Error === true) {
                //myFunction(response.data.Message);
                noty({ text: response.data.Message, layout: 'topRight', type: 'error' });
            }
            else {
                noty({ text: response.data.Message, layout: 'topRight', type: 'success' });
            }
        }), function errorCallBack(response) {
            ShowResult(response.data.Message, 'failure');
        }
    }
    $scope.changePassword = function () {
        if ($scope.changePassOb.OldPassword === null) {
            return noty({ text: "Old Password require!", layout: 'topRight', type: 'error' });
        }
        if ($scope.changePassOb.NewPassword === null) {
            return noty({ text: "New Password require!", layout: 'topRight', type: 'error' });
        }
        if ($scope.changePassOb.NewPassword !== $scope.changePassOb.NewPasswordConfirm) {
            return noty({ text: "New Password and new ConfirmPassword does not match", layout: 'topRight', type: 'error' });
        }
        $scope.$broadcast('show-errors-check-validity');
        if ($scope.passwrodChangeForm.$valid) {
            $http({
                method: "post",
                url: '/Account/ChangePassword/',
                data: { 'model': $scope.changePassOb },
                dataType: "json"
            }).then(function successCallback(response) {
                if (response.data.Error === true) {
                    //myFunction(response.data.Message);
                    noty({ text: response.data.Message, layout: 'topRight', type: 'error' });
                }
                else {
                    noty({ text: response.data.Message, layout: 'topRight', type: 'success' });
                    $scope.changePassOb = {
                        OldPassword: null,
                        NewPassword: null,
                        NewPasswordConfirm: null
                    }
                }
            }), function errorCallBack(response) {
                showResult(response.data.Message, 'failure');
            }
        }
    }
    $scope.changeUserId = function () {
        if ($scope.changeUserIdOb.Phone === null) {
            return noty({ text: "Phone require!", layout: 'topRight', type: 'error' });
        }
        $scope.$broadcast('show-errors-check-validity');
        if ($scope.userIdChangeForm.$valid) {
            $http({
                method: "post",
                url: '/Account/ChangeUserId/',
                data: { 'phone': $scope.changeUserIdOb.Phone },
                dataType: "json"
            }).then(function successCallback(response) {
                if (response.data.Error === true) {
                    //myFunction(response.data.Message);
                    noty({ text: response.data.Message, layout: 'topRight', type: 'error' });
                }
                else {
                    noty({ text: response.data.Message, layout: 'topRight', type: 'success' });
                    $scope.changeUserIdOb = {
                        Phone: null
                    }
                }
            }), function errorCallBack(response) {
                showResult(response.data.Message, 'failure');
            }
        }
    }
    $scope.uploadDocument = function () {
        var fileD = $("#docs").get(0);
        $scope.fileDoc = fileD.files;
        var personId = $scope.editUserProfile.Id;
        //for (var i = 0; i < fileDoc.length; i++) {
        //    data.append(fileDoc[i].name, fileDoc[i], personId);
        //}
    }
    $scope.inputFileList = [];
    $scope.addUserFile = function () {
        var file = $scope.fileDoc;
        for (var i = 0; i < file.length; i++) {
            var ob = {
                Id: null,
                FileTypeId: $scope.userFileOb.FileTypeId,
                FileTypeName: document.getElementById('fileTypeId').options[document.getElementById('fileTypeId').selectedIndex].text,
                FileName: file[i].name,
                FileId: Math.random().toString(36).substr(2, 16),
                FileNo: $scope.userFileOb.FileNo,
                UserId: $scope.editUserProfile.Id
            }
            $scope.userFileList.push(ob);
            $scope.inputFileList.push(file[i]);
        }
        $scope.userFileOb = {
            Id: null,
            FileTypeId: null,
            FileName: null,
            FileId: null,
            FileNo: null,
            UserId: $scope.editUserProfile.Id
        }
        var file = [];
        $scope.fileDoc = [];
    }
    $scope.deleteUserFile = function (index) {
        $scope.userFileList.splice(index, 1);
    }
    $scope.uploadImage = function () {
        var fileUpload = $("#imageFiles").get(0);
        var files = fileUpload.files;
        var personId = $scope.editUserProfile.Id;
        var data = new FormData();
        for (var i = 0; i < files.length; i++) {
            data.append(files[i].name, files[i], personId);
        }
        $.ajax({
            type: "POST",
            url: "/UserDashboard/UploadProfileImage",
            contentType: false,
            processData: false,
            data: data,
            success: function (imgSrc) {
                if (imgSrc !== null) {
                    $(".profileImage").attr('src', "");
                    $(".profileImage").attr('src', imgSrc);
                    $scope.editUserProfile.PhotoPath = '';
                    $scope.editUserProfile.PhotoPath = imgSrc;
                    $rootScope.userUniquePhotoPath = imgSrc;
                    //$scope.GetPerson();
                }
            },
            error: function () {
                //alert("There was error uploading files!");
            }
        });
    };
    function myFunction(msg) {
        $scope.msgText = msg
        var x = document.getElementById("snackbar")
        x.className = "show";
        setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);
    }
    $scope.FileDownload = function (data) {
        $scope.dwonloadUrl = null;
        var str = data.FileName;
        var extention = str.substr(str.indexOf('.'));
        $scope.dwonloadUrl = '/UploadFiles/UsersFileDoc/' + data.FileId + extention;
    };
};