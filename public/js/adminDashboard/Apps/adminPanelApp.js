'use strict';
var adminPanelApp = angular.module('adminPanelApp', ['ngRoute', 'ngCookies', 'angularUtils.directives.dirPagination']);
adminPanelApp.controller('AdminDashboardController', AdminDashboardController)
adminPanelApp.controller('UserManageController', UserManageController)
adminPanelApp.controller('c', UserManageController)
adminPanelApp.controller('AddManageController', AddManageController)
adminPanelApp.controller('AdminVideoAlbumController', AdminVideoAlbumController)
adminPanelApp.controller('AdminPhotoAlbumController', AdminPhotoAlbumController)
adminPanelApp.directive('datepicker', datepicker)
adminPanelApp.directive('ngFileSelect', ngFileSelect)
adminPanelApp.directive('loader', loader)
adminPanelApp.directive('pageLoader', pageLoader)
adminPanelApp.directive('onlyNumbers', onlyNumbers)
adminPanelApp.directive('nDecimals', nDecimals)
adminPanelApp.factory('fileReader', fileReader)
adminPanelApp.filter('dateFiltering', dateFiltering)
adminPanelApp.filter('dateFilter', dateFilter)
adminPanelApp.filter('haDateFilter', haDateFilter)
adminPanelApp.directive('compile', compile)
adminPanelApp.run(function ($rootScope, $http) {
    $rootScope.userUniquePhotoPath = '';
    $rootScope.globalUserInfo = {
        UserId: null,
        UserFullName: null,
        UserPhone: null,
        InstituteName: null,
        Position: null,
        ProfessionTypeName: null
    };
    $http.get('/api/GetUserById')
        .then(function successCallback(response) {
            $rootScope.userUniquePhotoPath = response.data.PhotoPath;
            $rootScope.globalUserInfo.UserId = response.data.Id;
            $rootScope.globalUserInfo.UserFullName = response.data.FullName;
            $rootScope.globalUserInfo.UserPhone = response.data.Phone;
            $rootScope.globalUserInfo.InstituteName = response.data.InstituteName;
            $rootScope.globalUserInfo.Position = response.data.Position;
            $rootScope.globalUserInfo.ProfessionTypeName = response.data.ProfessionTypeName;
        });
    $rootScope.openLightboxModal = function (imgSrc, caption) {
        $rootScope.lightBoxImage = imgSrc;
        $rootScope.lightBoxTitle = caption;
        angular.element(document.querySelector('#modal_lightBox')).modal('show');
    };
    $rootScope.options = {
        height: 250,
        //toolbar: [
        //    ['style', ['bold', 'italic', 'underline']],
        //    ['para', ['ul', 'ol']]
        //]
        toolbar: [
            ['edit', ['undo', 'redo']],
            ['headline', ['style']],
            ['style', ['bold', 'italic', 'underline', 'superscript', 'subscript', 'strikethrough', 'clear']],
            ['fontface', ['fontname']],
            ['textsize', ['fontsize']],
            ['fontclr', ['color']],
            ['alignment', ['ul', 'ol', 'paragraph', 'lineheight']],
            ['height', ['height']],
            //['table', ['table']],
            ['insert', ['link', 'picture', 'video', 'hr']],
            ['view', ['fullscreen']],
            //['help', ['help']]
        ]
    };
});
function ngFileSelect() {
    return {
        link: function ($scope, el) {
            el.bind('change', function (e) {
                $scope.file = (e.srcElement || e.target).files[0];
                $scope.getFile();
            });
        }
    }
}
function ngFileSelectMultiple() {
    return {
        link: function ($scope, el) {
            el.bind('change', function (e) {
                $scope.file = (e.srcElement || e.target).files[0];
                $scope.getFile();
            });
        }
    }
}

fileReader.$inject = ['$q', '$log'];
function fileReader($q, $log) {
    var onLoad = function (reader, deferred, scope) {
        return function () {
            scope.$apply(function () {
                deferred.resolve(reader.result);
            });
        };
    };

    var onError = function (reader, deferred, scope) {
        return function () {
            scope.$apply(function () {
                deferred.reject(reader.result);
            });
        };
    };

    var onProgress = function (reader, scope) {
        return function (event) {
            scope.$broadcast("fileProgress",
                {
                    total: event.total,
                    loaded: event.loaded
                });
        };
    };

    var getReader = function (deferred, scope) {
        var reader = new FileReader();
        reader.onload = onLoad(reader, deferred, scope);
        reader.onerror = onError(reader, deferred, scope);
        reader.onprogress = onProgress(reader, scope);
        return reader;
    };

    var readAsDataURL = function (file, scope) {
        var deferred = $q.defer();

        var reader = getReader(deferred, scope);
        reader.readAsDataURL(file);

        return deferred.promise;
    };

    return {
        readAsDataUrl: readAsDataURL
    };
}
function loader($http) {
    return {
        restrict: 'A',
        link: function (scope, elm, attrs) {
            scope.isLoading = function () {
                return $http.pendingRequests.length > 0;
            };
            scope.$watch(scope.isLoading, function (v) {
                if (v) {
                    elm.show();
                } else {
                    elm.hide();
                }
            });
        }
    }
}
function pageLoader($http) {
    return {
        restrict: 'A',
        link: function (scope, elm, attrs) {
            scope.isLoading = function () {
                return $http.pendingRequests.length > 0;
            };
            scope.$watch(scope.isLoading, function (v) {
                if (v) {
                    elm.show();
                } else {
                    elm.hide();
                    document.getElementById("pageloading").style.display = "block";
                }
            });
        }
    }
}
datepicker.$inject = ['$parse', '$timeout'];
function datepicker($parse, $timeout) {
    var directive = {
        restrict: 'A',
        link: datepickerLink,
        require: '?ngModel'
    };
    return directive;
    function datepickerLink(scope, element, attrs, ngModel) {
        if (!ngModel) return;
        var getter = $parse(attrs.ngModel);
        var value = getter(scope);
        element
            .addClass('datepicker')
            .datepicker({
                format: 'dd-M-yyyy'
                , autoclose: true
                , reset: true
                , todayHighlight: true
                , orientation: 'bottom'
                , startDate: attrs.startDate
                , endDate: attrs.endDate
            }).on('changeDate', function (event) {
                scope.$apply(function () {
                    ngModel.$setViewValue(event.date);
                    scope.$eval(attrs.datepicker);
                });
            });
        ngModel.$render = function () {
            element.datepicker('update', ngModel.$viewValue || '');
        };
        $timeout(function () {
            element.datepicker('update', value || '');
        }, 1)
    }
}
dateFiltering.$inject = ['$filter'];
function dateFiltering($filter) {
    return function (input) {
        if (input === null) { return ""; }
        return $filter('date')(new Date(input), 'dd-MMM-yyyy');
    };
}
dateFiltering.$inject = ['$filter'];
function dateFilter($filter) {
    return function (val) {
        if (val != null || val != undefined) {
            return new Date(parseInt(val.substr(6)));
        }
        else return null;
        //var date = new Date(input);
        //return ($filter('dateFilter')(date, 'EEE MMM dd yyyy HH:mm:ss'));
    };
}
haDateFilter.$inject = ['$filter'];
function haDateFilter($filter) {
    return function (val) {
        if (val != null || val != undefined) {
            return new Date(val);
        }
        else return null;
        //var date = new Date(input);
        //return ($filter('dateFilter')(date, 'EEE MMM dd yyyy HH:mm:ss'));
    };
}
onlyNumbers.$inject = ['$rootScope'];
function onlyNumbers($rootScope) {
    return {
        require: 'ngModel',
        link: function (scope, element, attr, ngModelCtrl) {
            function fromUser(text) {
                if (attr.min !== text.length)
                    $rootScope.lengthCheck = true;
                else
                    $rootScope.lengthCheck = false;
                if (text) {
                    var transformedInput = text.replace(/[^-0-9]/g, '');
                    var negativeCheck = transformedInput.split('-');
                    if (!angular.isUndefined(negativeCheck[1])) {
                        negativeCheck[1] = negativeCheck[1].slice(0, negativeCheck[1].length);
                        transformedInput = negativeCheck[0] + '-' + negativeCheck[1];
                        if (negativeCheck[0].length > 0) {
                            transformedInput = negativeCheck[0];
                        }
                    }
                    if (transformedInput !== text) {
                        ngModelCtrl.$setViewValue(transformedInput);
                        ngModelCtrl.$render();
                    }
                    return transformedInput;
                }
                return undefined;
            }
            ngModelCtrl.$parsers.push(fromUser);
        }
    };
}
function nDecimals() {
    return {
        require: '?ngModel',
        link: function (scope, element, attrs, ngModelCtrl) {
            if (!ngModelCtrl)
                return;
            ngModelCtrl.$parsers.push(function (val) {
                if (angular.isUndefined(val)) {
                    val = '';
                }
                var maxDecimal = Number(element.attr('n-Decimals'));
                var clean = val.replace(/[^-0-9\.]/g, '');
                var negativeCheck = clean.split('-');
                var decimalCheck = clean.split('.');
                if (!angular.isUndefined(negativeCheck[1])) {
                    negativeCheck[1] = negativeCheck[1].slice(0, negativeCheck[1].length);
                    clean = negativeCheck[0] + '-' + negativeCheck[1];
                    if (negativeCheck[0].length > 0) {
                        clean = negativeCheck[0];
                    }
                }
                if (!angular.isUndefined(decimalCheck[1])) {
                    decimalCheck[1] = decimalCheck[1].slice(0, maxDecimal);
                    clean = decimalCheck[0] + '.' + decimalCheck[1];
                }
                if (val !== clean) {
                    ngModelCtrl.$setViewValue(clean);
                    ngModelCtrl.$render();
                }
                return clean;
            });
            element.bind('keypress', function (event) {
                if (event.keyCode === 32) {
                    event.preventDefault();
                }
            });
        }
    };
}

compile.$inject = ['$compile'];
function compile($compile) {
    return function (scope, element, attrs) {
        scope.$watch(
            function (scope) {
                return scope.$eval(attrs.compile);
            },
            function (value) {
                element.html(value);
                $compile(element.contents())(scope);
            }
        );
    };
}
            //adminPanelApp.filter('date', function ($filter) {
            //        return function (input) {
            //            if (input == null) { return ""; }

            //            var _date = $filter('date')(new Date(input), 'MM/dd/yyyy');

            //            return _date.toUpperCase();

            //        };
            //    });

        //adminPanelApp.factory('LoginService', function ($http) {
        //        var fac = {};
        //        fac.GetUser = function (d) {
        //            return $http({
        //                url: '/Login',
        //                method: 'POST',
        //                data: JSON.stringify(d),
        //                headers: { 'content-type': 'application/json' }
        //            });
        //        };
        //        return fac;
        //    })