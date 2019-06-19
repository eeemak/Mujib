'use strict';
KagojBartaPostAdminController.$inject = ['$scope', '$rootScope', '$http', '$location', '$routeParams', '$cookies', '$cookieStore', '$filter', 'fileReader'];
function KagojBartaPostAdminController($scope, $rootScope, $http, $location, $routeParams, $cookies, $cookieStore, $filter, fileReader) {
    $scope.title = "Biggo Shomaj";
    $scope.kagojBartaFeaturePostList = [];
    $scope.kagojBartaPostList = [];
    $scope.kagojBartaDetailList = [];
    $scope.kagojBartaPostOb = {
        Id: null,
        Title: null,
        FileName: null,
        FileId: null,
        UserId: null,
        IsFetured: true,
        ViewFor: 'public',
        CategoryId: 3
    }
    // $scope.getKagojBartaFeaturePostListById();
    $scope.kagojBartaListSearchParameters = {
        PageSize: 10,
        Total_Count: 0,
        CurrentPage: 1,
        PageNo: 1
    }
    $scope.kagojBartaLinkOb = {
        Id: null,
        Title: null,
        Description: null,
        Link: null,
        UserId: null,
        PostCategoryId: 3
    }

    $scope.getKagojBartaListById = function () {
        $scope.pageChangeHandler = function (num) {
            $scope.kagojBartaListSearchParameters.PageNo = num != undefined ? num : 1;
            $http({
                method: 'GET',
                url: '/ForumPost/GetKagojBartaAdminPostList?pageNo=' + $scope.kagojBartaListSearchParameters.PageNo + '&pageSize=' + $scope.kagojBartaListSearchParameters.PageSize
            }).then(function successCallback(response) {
                if (response.data.Items.length > 0) {
                    angular.forEach(response.data.Items, function (item) {
                        if (item.FileId != null) {
                            item.TempSrc = getFileUrl(item.FileId, item.FileName);
                        }
                    });
                    $scope.kagojBartaPostList = response.data.Items;
                }
                $scope.kagojBartaListSearchParameters.Total_Count = response.data.Pager.TotalItems;
            })
        };
        $scope.pageChangeHandler();
    }
    $scope.getKagojBartaListById();
    //**AllBiggoShomajPostList**/
    $scope.postList = [];
    $scope.PostListSearchParameters = {
        PageSize: 10,
        Total_Count: 0,
        CurrentPage: 1,
        PageNo: 1
    }
    $scope.getPostList = function () {
        $scope.pagePostChangeHandler = function (num) {
            $scope.PostListSearchParameters.PageNo = num != undefined ? num : 1;
            $http({
                method: 'GET',
                url: '/ForumPost/GetPostListWithCategoryId?pageNo=' + $scope.PostListSearchParameters.PageNo + '&pageSize=' + $scope.PostListSearchParameters.PageSize + '&fourmPostCategoryId=3'
            }).then(function successCallback(response) {
                if (response.data.Items.length > 0) {
                    angular.forEach(response.data.Items, function (item) {
                        if (item.FileId != null) {
                            item.PhotoPath = getFileUrl(item.FileId, item.FileName);
                        }
                    });
                    $scope.postList = response.data.Items;
                }
                $scope.PostListSearchParameters.Total_Count = response.data.Pager.TotalItems;
            })
        };
        $scope.pagePostChangeHandler();
    }
    $scope.getPostList();
    $scope.postDetailOb = {};
    $scope.postDetail = function (data) {
        if (data.FileId != null) {
            data.TempSrc = getFileUrl(data.FileId, data.FileName);
        }
        $scope.postDetailOb = data;
        angular.element(document.querySelector('#modal_basic')).modal('show');
    }
    $scope.removePost = function (id) {
        if (id != null || id != undefined) {
            $http({
                method: 'POST',
                url: '/ForumPost/DeletePost/' + id,
                dataType: 'JSON'
            }).then(function successCallback(response) {
                if (response.data.Error === true) {
                    noty({ text: response.data.Message, layout: 'topRight', type: 'error' });
                }
                else {
                    noty({ text: response.data.Message, layout: 'topRight', type: 'success' });
                    for (var i = 0; i < $scope.postList.length; i++) {
                        var ob = $scope.postList[i];
                        if (ob.Id === id) {
                            $scope.postList.splice(i, 1)
                            $scope.PostListSearchParameters.Total_Count = $scope.PostListSearchParameters.Total_Count - 1
                        }
                    }
                }
            }, function errorCallback(response) {
                noty({ text: response.data.Message, layout: 'topRight', type: 'error' });
            });
        }
        else {
            noty({ text: "No Post Found to delete", layout: 'topRight', type: 'error' });
        }
        return true;
    };
    //end
    $scope.deleteUserVideoLink = function (data) {
        angular.forEach($scope.userVideoLinkList, function (item, i) {
            if (item.FileId == data.FileId) {
                $scope.userVideoLinkList.splice(i, 1);
            }
        })
    }
    function getPostText() {
        $scope.kagojBartaDetailList.push($scope.kagojBartaPostDetailOb);
    }
    $scope.savePost = function () {
        if ($scope.kagojBartaPost.$valid) {
            $scope.kagojBartaDetailList = [];
            getPostText();
            $scope.addKagojBartaPost();
            var formData = new FormData();
            $http({
                method: "post",
                url: '/ForumPost/Create/',
                headers: { 'Content-Type': undefined },
                transformRequest: function (data) {
                    formData.append('forumPost', angular.toJson(data.forumPost));
                    formData.append('forumPostDetail', angular.toJson(data.forumPostDetail));
                    for (var i = 0; i < data.postFile.length; i++) {
                        formData.append('postFile[' + i + ']', data.postFile[i]);
                    }
                    return formData;
                },
                data: {
                    'forumPost': $scope.kagojBartaPostOb
                    , 'forumPostDetail': $scope.kagojBartaDetailList
                    , 'postFile': $scope.inputFileList
                },
            }).then(function successCallback(response) {
                if (response.data.Error == true) {
                    noty({ text: response.data.Message, layout: 'topRight', type: 'error' });
                }
                else {
                    noty({ text: response.data.Message, layout: 'topRight', type: 'success' });
                    $scope.getKagojBartaListById();
                    ClearFields();
                }
            }), function errorCallBack(response) {
                showResult(response.data.Message, 'failure');
            }
        }
    }
    $scope.deletePost = function (id) {
        if (id != null || id != undefined) {
            $http({
                method: 'POST',
                url: '/ForumPost/DeletePost/' + id,
                dataType: 'JSON'
            }).then(function successCallback(response) {
                if (response.data.Error === true) {
                    noty({ text: response.data.Message, layout: 'topRight', type: 'error' });
                }
                else {
                    noty({ text: response.data.Message, layout: 'topRight', type: 'success' });
                    for (var i = 0; i < $scope.kagojBartaPostList.length; i++) {
                        var ob = $scope.kagojBartaPostList[i];
                        if (ob.Id === id) {
                            $scope.kagojBartaPostList.splice(i, 1)
                        }
                    }
                }
            }, function errorCallback(response) {
                noty({ text: response.data.Message, layout: 'topRight', type: 'error' });
            });
        }
        else {
            noty({ text: "No Post Found to delete", layout: 'topRight', type: 'error' });
        }
        return true;
    };
    function ClearFields() {
        $scope.inputFileList = [];
        $scope.kagojBartaDetailList = [];
        $scope.kagojBartaPostOb = {
            Id: null,
            Title: null,
            FileName: null,
            FileId: null,
            UserId: null,
            IsFetured: true,
        ViewFor: 'public',
            CategoryId: 3
        }
        $scope.kagojBartaPostDetailOb = {
            Id: null,
            ForumPostId: null,
            PostText: null
        }
    }
    //#region KagojBarta Link
    $scope.kagojBartaLinkList = [];
    $scope.kagojBartaLinkListSearchParameters = {
        PageSize: 12,
        Total_Count: 0,
        CurrentPage: 1,
        PageNo: 1
    }
    $scope.getKagojBartaLinkList = function () {
        $scope.kagojBartaLinkPageChangeHandler = function (num) {
            $scope.kagojBartaLinkListSearchParameters.PageNo = num != undefined ? num : 1;
            $http({
                method: 'GET',
                url: '/ForumPost/GetKagojBartaLinkList?pageNo=' + $scope.kagojBartaLinkListSearchParameters.PageNo + '&pageSize=' + $scope.kagojBartaLinkListSearchParameters.PageSize
            }).then(function successCallback(response) {
                $scope.kagojBartaLinkList = response.data.Items;
                $scope.kagojBartaLinkListSearchParameters.Total_Count = response.data.Pager.TotalItems;
            })
        };
        $scope.kagojBartaLinkPageChangeHandler();
    }
    $scope.getKagojBartaLinkList();
    $scope.SaveLink = function () {
        $http({
            method: "post",
            url: '/ForumPost/InsertKagojBartaLink/',
            data: $scope.kagojBartaLinkOb,
            dataType: "json"
        }).then(function successCallback(response) {
            if (response.data.Error === true) {
                noty({ text: response.data.Message, layout: 'topRight', type: 'error' });
            }
            else {
                noty({ text: response.data.Message, layout: 'topRight', type: 'success' });
                $scope.getKagojBartaLinkList();
                $scope.kagojBartaLinkOb = {
                    Id: null,
                    Title: null,
                    Description: null,
                    Link: null,
                    UserId: null,
                    PostCategoryId: 3
                }
            }
        }), function errorCallBack(response) {
            showResult(response.data.Message, 'failure');
        }
    }
    $scope.deleteLink = function (data) {
        if (data.Id != null || data.Id != undefined) {
            $http({
                method: 'POST',
                url: '/ForumPost/DeleteLink/' + data.Id,
                dataType: 'JSON'
            }).then(function successCallback(response) {
                if (response.data.Error === true) {
                    noty({ text: response.data.Message, layout: 'topRight', type: 'error' });
                }
                else {
                    noty({ text: response.data.Message, layout: 'topRight', type: 'success' });
                    angular.forEach($scope.kagojBartaLinkList, function (item, i) {
                        if (item.Id == data.Id) {
                            $scope.kagojBartaLinkList.splice(i, 1);
                        }
                    });
                }
            }, function errorCallback(response) {
                noty({ text: response.data.Message, layout: 'topRight', type: 'error' });
            });
        }
        else {
            noty({ text: "No Post Found to delete", layout: 'topRight', type: 'error' });
        }
        return true;
    };
    //#end
    $scope.imageSrc = null;
    $scope.filedata = null;
    $("#uploadImage").change(function () {
        $scope.filedata = this.files[0];
    });
    $scope.getFile = function () {
        $scope.progress = 0;
        fileReader.readAsDataUrl($scope.file, $scope)
            .then(function (result) {
                $scope.imageSrc = result;
            });
    };

    $scope.inputFileList = [];
    $scope.addKagojBartaPost = function () {
        var file = $scope.filedata;
        $scope.kagojBartaPostOb.FileName = file.name,
            $scope.kagojBartaPostOb.FileId = Math.random().toString(36).substr(2, 16),
            $scope.inputFileList.push(file);
        var file = [];
        $scope.fileDoc = [];
        $scope.ClearImage();
    }
    $scope.ClearImage = function () {
        $scope.imageSrc = null;
        document.getElementById("uploadImage").value = '';
        document.getElementById("uploadImageSrc").setAttribute('src', null);
    };
    $scope.deleteUserFile = function (data) {
        angular.forEach($scope.userVideoLinkList, function (item, i) {
            if (item.FileId == data.FileId) {
                $scope.userVideoLinkList.splice(i, 1);
            }
        })
    }
    function myFunction(msg) {
        $scope.msgText = msg
        var x = document.getElementById("snackbar")
        x.className = "show";
        setTimeout(function () { x.className = x.className.replace("show", ""); }, 3000);
    }
    //#gallary**
    $scope.modalTempSrc = null;
    $scope.imgTitle = null;
    $scope.img = function (data) {
        angular.element(document.querySelector('#myModal')).modal('show');
        $scope.modalTempSrc = data.TempSrc;
        $scope.imgTitle = data.Title;
    }
    //endgallary
    function getFileUrl(fileId, fileName) {
        var str = fileName;
        var extention = str.substr(str.indexOf('.'));
        return '/UploadFiles/UsersFilePhoto/KagojBarta/' + fileId + extention;
    }
    $scope.truncString = function (str, max, add) {
        add = add || '...';
        return (typeof str === 'string' && str.length > max ? str.substring(0, max) + add : str);
    };
};