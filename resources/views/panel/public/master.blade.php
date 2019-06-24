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
    <title>মুজিব সার্কেল</title>
    <!-- Mobile Specific Metas
    ================================================== -->
    <meta name="viewport" content="width=device-width, initial-scale=1"> {{--
    <meta http-equiv="X-Frame-Options" content="deny"> --}}
    <meta name="description" content="">

    <!-- =============== tt canonical End =============================== -->
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('assets/css/bootstrap/bootstrap.min.css')}}" />
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('assets/assets/themes/Gob/themes/responsive_npf/stylesheets/base.css')}}" />
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('assets/assets/themes/Gob/themes/responsive_npf/stylesheets/skeleton.css')}}" />
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('assets/assets/themes/Gob/themes/responsive_npf/stylesheets/style.css')}}" />
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('assets/assets/themes/Gob/themes/responsive_npf/stylesheets/meganizr.css')}}" />
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('assets/assets/themes/Gob/themes/responsive_npf/stylesheets/demo.css')}}" />
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('assets/assets/themes/Gob/themes/responsive_npf/templates/ministry/style.css')}}" />
    <script type="text/javascript" src="{{asset('assets/assets/themes/Gob/themes/responsive_npf/js/jquery-1.11.1.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/plugins/bootstrap/bootstrap.min.js')}}"></script>
    <!-- include the jquery-accessibleMegaMenu plugin script -->
    <script type="text/javascript" src="{{asset('assets/assets/themes/Gob/themes/responsive_npf/js/jquery-accessibleMegaMenu.js')}}"></script>

    <link rel="stylesheet" type="text/css" id="theme" href="{{ asset('assets/assets/themes/Gob/themes/responsive_npf/stylesheets/responsiveslides.css')}}" />
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('assets/assets/themes/Gob/themes/responsive_npf/templates/ministry/responsive.css')}}" />
    <link rel="stylesheet" type="text/css" id="theme" href="{{asset('assets/assets/themes/Gob/themes/responsive_npf/templates/ministry/accessibility.css')}}" />

    <script type="text/javascript" src="{{asset('assets/assets/themes/Gob/themes/responsive_npf/js/responsiveslides.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/assets/themes/Gob/themes/responsive_npf/js/jquery.vticker.js')}}"></script>
    {{-- Select2 --}}
    <link href="{{ asset('assets/vendor/select2/select2.min.css') }}" rel="stylesheet" />
    <script src="{{ asset('assets/vendor/select2/select2.min.js') }}"></script>
    
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
            return false; // cancels the default copy operation
        }
    </script>
</head>

<body class="bangabhaban-portal-gov-bd" oncopy="return OnCopy()" ng-controller="{{$ControllerName}}">
    <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
    <!-- Add your site or application content here -->
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v3.3&appId=124282877582285&autoLogAppEvents=1"></script>
    <div class="container">
        @isset($hasSlider)
            @if ($hasSlider)
                @include('panel.public.slider')
            @endif
        @else
        @include('panel.public.slider')
        @endisset 
        @isset($hasMenu)
            @if ($hasMenu)
            @include('panel.public.menu')
            @endif
        @else
        @include('panel.public.menu')
        @endisset 

        <script>
            $(document).ready(function() {
                $('.col6 a').on('click', function() {
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

        $(function() {

            // Slideshow 4
            $("#front-image-slider").responsiveSlides({
                auto: true,
                pager: false,
                nav: true,
                speed: 2000,
                maxwidth: 960,
                namespace: "callbacks"
            });
            $("#right-content a").click(function() {
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
        $(".meganizr .mzr-drop").keyup(function() {

            $(".mzr-content").attr("aria-hidden", "true");
            $(this).find(".mzr-content").attr("aria-hidden", "false");
        });
        // ============ start tile for <a> and alt for img ========
        $('a').each(function() {
            $(this).attr('title', $(this).text());
        });

        var lan = "bn";
        if (lan == 'en') {
            $('.mzr-drop a:first-child').each(function() {
                $(this).attr('title', "Enter to get more menu");
            });
        } else {
            $('.mzr-drop a:first-child').each(function() {
                $(this).attr('title', "সাবমেনুর জন্য ক্লিক করুন");
            });
        }
        $('img').each(function() {
            var str = $(this).attr("src");
            var arr = str.split('index-2.html');
            var strFine = arr[arr.length - 1];

            var str2 = strFine;
            var arr2 = str2.split('.');
            var strFine2 = arr2[arr2.length - 2];
            $(this).attr('alt', strFine2);
        });
        $('a2iLogo').attr('alt', 'Access to information');
        $('.service-box img').each(function() {
            var strTitle = $(this).parent().find('h4').text();
            $(this).attr('alt', strTitle);
        });
        $('.block img').each(function() {
            var strTitleRight = $(this).closest('.block').find('.title').text();
            $(this).attr('alt', strTitleRight);
        });
        $('#notice-board-ticker .btn').attr('title', 'সকল নোটিশ');
        $('#news-ticker .btn').attr('title', 'সকল খবর');
        $('#search').each(function() {
            $(this).attr('alt', 'Search');
        });
        $('.search-btn').each(function() {
            $(this).attr('alt', 'Enter to search');
        });
        $(".mzr-content").mouseout(function() {
            $(this).hide();
        });
        $(".submenu").mouseover(function() {
            $(this).siblings('.mzr-content').show();
        });
        $(".mzr-content").mouseover(function() {
            $(this).show();
        });

        // ============ end tile for <a> and alt for img ========
    </script>

    <script>
        $(document).ready(function() {
            $(".slide-panel-button").click(function() {
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
        $(document).ready(function($) {

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
        $(document).ready(function() {
            var wi = $(window).width();
            if (wi < 769) {
                $('#printable_area td').removeAttr('style');
                $('#printable_area td p').css("width", "100%");
            }
            $('.select2').select2();
        });
        $(".meganizr .mzr-drop").keyup(function() {

            $(".mzr-content").attr("aria-hidden", "true");
            $(this).find(".mzr-content").attr("aria-hidden", "false");
        });
        // ============ start tile for <a> and alt for img ========
        $('a').each(function() {
            $(this).attr('title', $(this).text());
        });

        var lan = "bn";
        if (lan == 'en') {
            $('.mzr-drop a:first-child').each(function() {
                $(this).attr('title', "Enter to get more menu");
            });
        } else {
            $('.mzr-drop a:first-child').each(function() {
                $(this).attr('title', "সাবমেনুর জন্য ক্লিক করুন");
            });
        }
        $('img').each(function() {
            var str = $(this).attr("src");
            var arr = str.split('index-2.html');
            var strFine = arr[arr.length - 1];

            var str2 = strFine;
            var arr2 = str2.split('.');
            var strFine2 = arr2[arr2.length - 2];
            $(this).attr('alt', strFine2);
        });
        $('a2iLogo').attr('alt', 'Access to information');
        $('.service-box img').each(function() {
            var strTitle = $(this).parent().find('h4').text();
            $(this).attr('alt', strTitle);
        });
        $('.block img').each(function() {
            var strTitleRight = $(this).closest('.block').find('.title').text();
            $(this).attr('alt', strTitleRight);
        });
        $('#notice-board-ticker .btn').attr('title', 'সকল নোটিশ');
        $('#news-ticker .btn').attr('title', 'সকল খবর');
        $('#search').each(function() {
            $(this).attr('alt', 'Search');
        });
        $('.search-btn').each(function() {
            $(this).attr('alt', 'Enter to search');
        });
        // ============ end tile for <a> and alt for img ========

        // =============== start dropdown design =======
        $(".mzr-content").mouseout(function() {
            // $(this).hide();
        });
        $(".submenu").mouseover(function() {
            //$('.mzr-content').show();
        });
        $(".mzr-content").mouseover(function() {
            //$(this).show();
        });
        // =============== End dropdown design =======
    </script>

    <!-- Template Custom JavaScript File -->
    <script type="text/javascript" src="{{asset('assets/js/angular.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/angular-route.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/angular-cookies.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('assets/js/dirPagination.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/publicJs/homeController.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/publicJs/accountController.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/adminDashboard/gallaryController.js')}}"></script>
    <script type="text/javascript" src="{{asset('js/publicJs/Apps/publicpanelApp.js')}}"></script>

    <a id="scrollUp" href="#" style="display: none; position: fixed; z-index: 2147483647;"><i class="fa fa-arrow-up"></i></a>
</body>

</html>