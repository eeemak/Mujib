<!DOCTYPE html>
<!--[if lt IE 7 ]>
<html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]>
<html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]>
<html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html ng-app="publicpanelApp" class=" js flexbox canvas canvastext webgl no-touch geolocation postmessage websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths" lang="" style="">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <link rel="shortcut icon" href="misc/favicon.ico" type="image/x-icon" />
    <title>Mujib</title>
    <!-- Mobile Specific Metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-Frame-Options" content="deny">
    <meta name="description" content="">

    <!-- =============== tt canonical End =============================== -->
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('assets/css/bootstrap/bootstrap.min.css')}}"/>
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('assets/assets/themes/Gob/themes/responsive_npf/stylesheets/base.css')}}"/>
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('assets/assets/themes/Gob/themes/responsive_npf/stylesheets/skeleton.css')}}"/>
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('assets/assets/themes/Gob/themes/responsive_npf/stylesheets/style.css')}}"/>
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('assets/assets/themes/Gob/themes/responsive_npf/stylesheets/meganizr.css')}}"/>
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('assets/assets/themes/Gob/themes/responsive_npf/stylesheets/demo.css')}}"/>
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('assets/assets/themes/Gob/themes/responsive_npf/templates/ministry/style.css')}}"/>
        <script type="text/javascript" src="{{asset('assets/assets/themes/Gob/themes/responsive_npf/js/jquery-1.11.1.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/plugins/bootstrap/bootstrap.min.js')}}"></script>
    <!-- include the jquery-accessibleMegaMenu plugin script -->
        <script type="text/javascript" src="{{asset('assets/assets/themes/Gob/themes/responsive_npf/js/jquery-accessibleMegaMenu.js')}}"></script>

    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('assets/assets/themes/Gob/themes/responsive_npf/stylesheets/responsiveslides.css')}}"/>
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('assets/assets/themes/Gob/themes/responsive_npf/templates/ministry/responsive.css')}}"/>
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('assets/assets/themes/Gob/themes/responsive_npf/templates/ministry/accessibility.css')}}"/>

        <script type="text/javascript" src="{{asset('assets/assets/themes/Gob/themes/responsive_npf/js/responsiveslides.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/assets/themes/Gob/themes/responsive_npf/js/jquery.vticker.js')}}"></script>
    <link rel="shortcut icon" href="ico/favicon.png" />


    <style>
        #pageloading {
            display: none;
        }
    </style>
    <script type="text/javascript">
        function OnCopy() {
            if (window.clipboardData) {
                window.clipboardData.setData("Text", "My clipboard data");
            }
            return false;   // cancels the default copy operation
        }
    </script>
</head>
<body class="bangabhaban-portal-gov-bd" oncopy="return OnCopy()" ng-controller="{{$ControllerName}}">
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- Add your site or application content here -->

    <div class="container">
        <div class="sixteen columns" style="background-color: #c40a2a; box-shadow: 0 1px 5px #999999;width: 960px;border-bottom: 4px solid #e59aa7;">
            <div class="slide-panel-btns" style="float: left;width: 165px;height: 30px">
                <div class="slide-panel-button" style="display: table;margin-top: 5px">
                    <i class="flaticon-menu10"></i>
                    <a style="color: white;font-size:.9em" href="http://www.bangladesh.gov.bd/" target="_blank">মুজিব সার্কেল</a>
                </div>
            </div>
            <div id="div-lang" style="float:left;width: 795px;height: 32px;">
                <div id="newNavigation"></div>
                <!--                 <div id="div-lang-sel">
                                   <div id="search_any" style="float: left">
                                       <form action="https://bangabhaban.gov.bd/site/search" style="margin-top: 5px;padding: 0;float: left;">
                                           <input style="width:90px;border-radius: 4px;height: 18px;" id="search" name="key" value="" />
                                           <button class="search-btn" type="submit" style="margin: 0;padding: 1px 10px">Search</button>
                                       </form>
                                   </div>
                                   <div style="float: left;margin-left: 5px">

                                       <form id="lang_form" action="https://bangabhaban.gov.bd/index.php" method="post">
                                           <input type="hidden" name="lang" id="lang" value="en" />
                                           <button type="submit" style="padding: 2px;margin-top: 5px">English</button>
                                       </form>
                                   </div>

                               </div>
                -->
            </div>
        </div>

        <div class="sixteen columns">
            <div class="callbacks_container" style="box-shadow: 0 1px 5px #999999;">
                <ul class="rslides" id="front-image-slider">
                    <li>

                        <img src="{{URL::asset('assets/assets/themes/Gob/images/E0RY0E.jpg')}}" alt="" width="960" height="220" />

                    </li>
                    <li>

                        <img src="{{URL::asset('assets/assets/themes/Gob/images/E0YRB0.jpg')}}" alt="" width="960" height="220" />

                    </li>
                    <li>

                        <img src="{{URL::asset('assets/assets/themes/Gob/images/E10C30.jpg')}}" alt="" width="960" height="220" />

                    </li>
                    <li>

                        <img src="{{URL::asset('assets/assets/themes/Gob/images/E10EAC.jpg')}}" alt="" width="960" height="220" />

                    </li>
                    <li>

                        <img src="{{URL::asset('assets/assets/themes/Gob/images/E10J5E.jpg')}}" alt="" width="960" height="220" />

                    </li>
                </ul>
                <style>
                    .rslides img {
                        height: 220px
                    }
                </style>
                <script></script>
            </div>

            <div class="header-site-info" id="header-site-info">

                <div>
                    <div class="clearfix" id="site-name-wrapper">
                        <div>
                            <h4 style=" text-align: center;  margin-right: 42px; color: #fff; font-weight: bold;">অনুসন্ধান</h4>
                            <div class="form-horizontal">
                                <div class="col-xs-12 col-md-5" style="padding-right:0px">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <select class="form-control ha-dbbl" ng-model="advanceSearchData.DistrictId"
                                                    ng-options="item.Value as item.Text for item in districtList" id="DistrictId"
                                                    name="District" ng-change="getThana()">
                                                <option value="">District</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <div class="select-style">
                                                <select class="form-control ha-dbbl" ng-model="advanceSearchData.PoliceStationId"
                                                        ng-options="item.Value as item.Text for item in policeStationList" id="PoliceStationId"
                                                        name="PoliceStation" ng-change="getVillage()">
                                                    <option value="">Union</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-5">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <div class="select-style">
                                                <select class="form-control ha-dbbl" ng-model="advanceSearchData.ThanaId"
                                                        ng-options="item.Value as item.Text for item in thanaList" id="ThanaId"
                                                        name="Thana" ng-change="getPoliceStation()">
                                                    <option value="">Thana</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <div class="select-style">
                                                <select class="form-control ha-dbbl" ng-model="advanceSearchData.VillageId"
                                                        ng-options="item.Value as item.Text for item in villageList" id="VillageId"
                                                        name="Village" required tabindex="1">
                                                    <option value="">Village</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-md-10">
                                    <div class="form-group">
                                        <div class="col-sm-12">
                                            <button class="btn btn-danger" style="width:30%;padding:10px;" ng-click="getUserByAdvanceSearch();"><i class="fa fa-search"></i> <span>সার্চ</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /site-name-wrapper -->

                </div>
                <!-- /header-site-info-inner -->

            </div>

        </div>
        <script>
            /* Responsive Design*/
            $(document).ready(function () {
                var wi = $(window).width();
                if (wi < 980) {
                    $('.mzr-responsive').slideUp();
                    $('#jmenu .show-menu').click(function () {
                        //$('.mzr-responsive').show();
                        $(".mzr-responsive").slideToggle(400, "linear", function () {

                        });
                    });

                    $("#jmenu a.submenu").click(function () {

                        $('#jmenu a.submenu').siblings().addClass('sibling-toggle');
                        $(this).parent().find(".mzr-content").removeClass('sibling-toggle').addClass('slide-visible').slideToggle(400, "linear", function () { });
                        return false;
                    });
                }

            });
        </script>

        <div class="sixteen columns" id="jmenu">
            <div class="sixteen columns">

                <a href="javascript:;" class="show-menu menu-head"> মেনু নির্বাচন করুন</a>
                <div role="navigation" id="dawgdrops">
                    <ul class="meganizr mzr-slide mzr-responsive">
                        <!-- Build The Menu -->
                        <li class="col0 ">
                            <a title="Home" href="/Home/Index" style="background-image: url('{{asset('assets/assets/themes/Gob/themes/responsive_npf/img/home_dark.png')}}');margin-top:5px;"></a>
                        </li>
                        <li class="col1">
                            <a href="#" class="submenu">আপলোড/ডাউনলোড</a>
                        </li>
                        <li class="col2">
                            <a href="/Home/Commity">কমিটিসমূহ</a>
                        </li>
                        <li class="col3">
                            <a href="/Home/Karjokrom">কার্যক্রম</a>
                        </li>
                        <li class="col4">
                            <a href="/Home/Gallery">গ্যালারি</a>
                        </li>
                        <li class="col5">
                            <a href="/Home/News">নিউজ</a>
                        </li>
                        <li class="col6">
                            <a href="/Home/KroiBikroi">ক্রয়-বিক্রয়</a>
                        </li>
                        <li class="col7">
                            <a href="/Home/Biggopti">বিজ্ঞপ্তি</a>
                        </li>
                        <li class="col8">
                            <a href="/Home/Motamot">মতামত</a>
                        </li>
                        <li class="col9">
                            <a href="/Account/Register">রেজিস্ট্রেশন</a>
                        </li>
                        <li class="col10">
                            <a href="/Account/Login">লগইন</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

        <script>
            $(document).ready(function () {
                $('.col6 a').on('click', function () {
                    var link_value = $(this).attr("href");
                    window.location.replace(link_value);
                });
            });
        </script>
        <div id="contents" class="sixteen columns">
        @yield('content')
        </div>
    </div>

    <div class="footer-artwork" id="footer-artwork">&nbsp;</div>
    <div class="footer-wrapper full-width" id="footer-wrapper">
        <div id="footer-menu">

            <!-- <ul>
                <li><a href="site/view/sitemap/%e0%a6%b8%e0%a6%be%e0%a6%87%e0%a6%9f-%e0%a6%ae%e0%a7%8d%e0%a6%af%e0%a6%be%e0%a6%aa.html">সাইট ম্যাপ</a></li>
            </ul> -->
            <div style="float: left; font-size: .9em;">
                © স্বত্ব মুজিব ২০১৯
                <!--<span><a href="http://support.portal.gov.bd/" style="color: green" target="_blank"> | <u>হেল্পডেস্ক</u></a></span>-->
            </div>
        </div>
        <!--
                <div class="footer-credit" id="footer">
                    <p>
                        পরিকল্পনা ও বাস্তবায়নে:&nbsp;
                        <a href="http://www.cabinet.gov.bd/">মন্ত্রিপরিষদ
                            বিভাগ</a>,&nbsp;
                        <a href="https://a2i.gov.bd/">এটুআই</a>,&nbsp;
                        <a href="http://www.bcc.net.bd/">বিসিসি</a>,&nbsp;
                        <a href="http://doict.gov.bd/">ডিওআইসিটি</a>&nbsp;ও&nbsp;
                        <a href="http://www.basis.org.bd/">বেসিস</a>।
                    </p>

                    <p>
                        কারিগরি সহায়তায়:
                        <a href="https://a2i.gov.bd/"><img style="height: 28px; vertical-align: baseline; width: 30px" src="themes/responsive_npf/img/a2i.png" alt=""></a>
                    </p>

                </div> -->
        <!-- /footer -->
    </div>

    <script>
        function setLanguageCookie(cookieValue) {
            var today = new Date();
            var expire = new Date();
            var cookieName = 'lang';
            //var cookieValue = "bn";
            var nDays = 5;
            expire.setTime(today.getTime() + 3600000 * 24 * nDays);
            document.cookie = cookieName + "=" + escape(cookieValue) + ";expires=" + expire.toGMTString();
        }

        function setLanguage() {
            $("#lang_form").submit();
            return false;
        }

        $(function () {

            // Slideshow 4
            $("#front-image-slider").responsiveSlides({
                auto: true,
                pager: false,
                nav: true,
                speed: 2000,
                maxwidth: 960,
                namespace: "callbacks"
            });
            $("#right-content a").click(function () {
                var url = $(this).attr('href');
                if (isExternal(url) && url != 'javascript:;') {
                    openInNewTab(url);
                    return false;
                }
            });
        });

        function openInNewTab(url) {
            var win = window.open(url, '_blank');
            win.focus();
        }

        function isExternal(url) {
            var match = url.match(/^([^:\/?#]+:)?(?:\/\/([^\/?#]*))?([^?#]+)?(\?[^#]*)?(#.*)?/);
            if (typeof match[1] === "string" && match[1].length > 0 && match[1].toLowerCase() !== location.protocol)
                return true;
            if (typeof match[2] === "string" && match[2].length > 0 && match[2].replace(new RegExp(":(" + {
                "http:": 80,
                "https:": 443
            }[location.protocol] + ")?$"), "") !== location.host)
                return true;
            return false;
        }
    </script>



    <script>
        $(".meganizr .mzr-drop").keyup(function () {

            $(".mzr-content").attr("aria-hidden", "true");
            $(this).find(".mzr-content").attr("aria-hidden", "false");
        });
        // ============ start tile for <a> and alt for img ========
        $('a').each(function () {
            $(this).attr('title', $(this).text());
        });

        var lan = "bn";
        if (lan == 'en') {
            $('.mzr-drop a:first-child').each(function () {
                $(this).attr('title', "Enter to get more menu");
            });
        } else {
            $('.mzr-drop a:first-child').each(function () {
                $(this).attr('title', "সাবমেনুর জন্য ক্লিক করুন");
            });
        }
        $('img').each(function () {
            var str = $(this).attr("src");
            var arr = str.split('index-2.html');
            var strFine = arr[arr.length - 1];

            var str2 = strFine;
            var arr2 = str2.split('.');
            var strFine2 = arr2[arr2.length - 2];
            $(this).attr('alt', strFine2);
        });
        $('a2iLogo').attr('alt', 'Access to information');
        $('.service-box img').each(function () {
            var strTitle = $(this).parent().find('h4').text();
            $(this).attr('alt', strTitle);
        });
        $('.block img').each(function () {
            var strTitleRight = $(this).closest('.block').find('.title').text();
            $(this).attr('alt', strTitleRight);
        });
        $('#notice-board-ticker .btn').attr('title', 'সকল নোটিশ');
        $('#news-ticker .btn').attr('title', 'সকল খবর');
        $('#search').each(function () {
            $(this).attr('alt', 'Search');
        });
        $('.search-btn').each(function () {
            $(this).attr('alt', 'Enter to search');
        });
        $(".mzr-content").mouseout(function () {
            $(this).hide();
        });
        $(".submenu").mouseover(function () {
            $(this).siblings('.mzr-content').show();
        });
        $(".mzr-content").mouseover(function () {
            $(this).show();
        });

        // ============ end tile for <a> and alt for img ========
    </script>

    <script>
        $(document).ready(function () {
            $(".slide-panel-button").click(function () {
                $('#domain-selector-panel').toggle() //animate({height: "toggle"}, 200);
                if ($('#domain-selector-panel').is(":visible")) {
                    $('#div-lang').css('z-index', '200');
                } else {
                    $('#div-lang').css('z-index', '1001');
                }
                $(".slide-panel-button").toggle();
            });

        });
    </script>

    <!-- ============ start accessibility megamenu ============ -->

    <script>
        $(document).ready(function ($) {

            $("#dawgdrops").accessibleMegaMenu({
                /* prefix for generated unique id attributes, which are required
                 to indicate aria-owns, aria-controls and aria-labelledby */
                uuidPrefix: "accessible-megamenu",

                /* css class used to define the megamenu styling */
                menuClass: "meganizr",

                /* css class for a top-level navigation item in the megamenu */
                topNavItemClass: "mzr-drop",

                /* css class for a megamenu panel */
                panelClass: "mzr-content",

                /* css class for a group of items within a megamenu panel */
                panelGroupClass: "mzr-links",

                /* css class for the hover state */
                hoverClass: "hover",

                /* css class for the focus state */
                focusClass: "focus-content",

                /* css class for the open state */
                openClass: "open hover-content"
            });

        });
    </script>

    <script>
        $(document).ready(function () {
            var wi = $(window).width();
            if (wi < 769) {
                $('#printable_area td').removeAttr('style');
                $('#printable_area td p').css("width", "100%");
            }
        });
        $(".meganizr .mzr-drop").keyup(function () {

            $(".mzr-content").attr("aria-hidden", "true");
            $(this).find(".mzr-content").attr("aria-hidden", "false");
        });
        // ============ start tile for <a> and alt for img ========
        $('a').each(function () {
            $(this).attr('title', $(this).text());
        });

        var lan = "bn";
        if (lan == 'en') {
            $('.mzr-drop a:first-child').each(function () {
                $(this).attr('title', "Enter to get more menu");
            });
        } else {
            $('.mzr-drop a:first-child').each(function () {
                $(this).attr('title', "সাবমেনুর জন্য ক্লিক করুন");
            });
        }
        $('img').each(function () {
            var str = $(this).attr("src");
            var arr = str.split('index-2.html');
            var strFine = arr[arr.length - 1];

            var str2 = strFine;
            var arr2 = str2.split('.');
            var strFine2 = arr2[arr2.length - 2];
            $(this).attr('alt', strFine2);
        });
        $('a2iLogo').attr('alt', 'Access to information');
        $('.service-box img').each(function () {
            var strTitle = $(this).parent().find('h4').text();
            $(this).attr('alt', strTitle);
        });
        $('.block img').each(function () {
            var strTitleRight = $(this).closest('.block').find('.title').text();
            $(this).attr('alt', strTitleRight);
        });
        $('#notice-board-ticker .btn').attr('title', 'সকল নোটিশ');
        $('#news-ticker .btn').attr('title', 'সকল খবর');
        $('#search').each(function () {
            $(this).attr('alt', 'Search');
        });
        $('.search-btn').each(function () {
            $(this).attr('alt', 'Enter to search');
        });
        // ============ end tile for <a> and alt for img ========

        // =============== start dropdown design =======
        $(".mzr-content").mouseout(function () {
            // $(this).hide();
        });
        $(".submenu").mouseover(function () {
            //$('.mzr-content').show();
        });
        $(".mzr-content").mouseover(function () {
            //$(this).show();
        });
            // =============== End dropdown design =======
    </script>


    <!-- Template Custom JavaScript File -->
    <script type="text/javascript" src="{{asset('assets/js/angular.js')}}"></script>   
    <script  type="text/javascript" src="{{asset('assets/js/angular-route.min.js')}}"></script>
    <script  type="text/javascript" src="{{asset('assets/js/angular-cookies.min.js')}}"></script>
    <script  type="text/javascript" src="{{asset('assets/js/dirPagination.js')}}"></script>
    <script  type="text/javascript" src="{{asset('js/publicJs/homeController.js')}}"></script>
    <script  type="text/javascript" src="{{asset('js/publicJs/Apps/publicpanelApp.js')}}"></script>

    <a id="scrollUp" href="#" style="display: none; position: fixed; z-index: 2147483647;"><i class="fa fa-arrow-up"></i></a>
</body>
</html>