<!DOCTYPE html>
<html lang="en" ng-app="adminPanelApp">
    <head>        
        <!-- META SECTION -->
        <title>মুজিব সার্কেল- Dashboard</title>            
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="icon" href="favicon.ico" type="image/x-icon" />
        <!-- END META SECTION -->
                        
        <!-- CSS INCLUDE -->        
        <link rel="stylesheet" type="text/css" id="theme" href="{{asset('assets/css/theme-default.css')}}"/>
            <link rel="stylesheet" type="text/css" id="theme" href="{{asset('assets/css/dashBoardCustom.css')}}"/>
        <link href="{{ asset('assets/vendor/waitMe/waitMe.min.css') }}" rel="stylesheet" />

        <!-- EOF CSS INCLUDE -->      

    <style>
        #pageloading {
            display: none;
        }
        .waitMe_container{
            height: 100vh;
        }
    </style>           
    </head>
    <body id="page-top" class="loader" ng-controller="{{$ControllerName}}" onload="hideLoader()">
        <!-- START PAGE CONTAINER -->
        <div class="page-container">
            
            <!-- START PAGE SIDEBAR -->
            @include('panel.layout.adminDashboard.sidebar')
            <!-- END PAGE SIDEBAR -->
            
            <!-- PAGE CONTENT -->
            <div class="page-content">
                
                <!-- START X-NAVIGATION VERTICAL -->
                @include('panel.layout.adminDashboard.header')
                <!-- END X-NAVIGATION VERTICAL -->                   
                
                @yield('content')
                    
                <!-- END PAGE CONTENT WRAPPER -->                                                
            </div>            
            <!-- END PAGE CONTENT -->
        </div>
        <!-- END PAGE CONTAINER -->
        
        

        <!-- START PRELOADS -->
        <audio id="audio-alert" src="{{asset('assets/audio/alert.mp3')}}" preload="auto"></audio>
        <audio id="audio-fail" src="{{asset('assets/audio/fail.mp3')}}" preload="auto"></audio>
        <!-- END PRELOADS -->             
        
    <!-- START SCRIPTS -->
        <!-- START PLUGINS -->
        <script type="text/javascript" src="{{asset('assets/js/plugins/jquery/jquery.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/plugins/jquery/jquery-ui.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/plugins/bootstrap/bootstrap.min.js')}}"></script>    
        <script src="{{ asset('assets/vendor/waitMe/waitMe.min.js') }}"></script> 
        <script type="text/javascript">
            $('.loader').waitMe({
             effect : 'bounce',
             text : '',
             bg : 'rgba(255,255,255,1)',
             // color : #000,
             maxSize : '',
             waitTime : -1,
             textPos : 'vertical',
             fontSize : '',
             source : '',
             onClose : function() {
                 $('.page-container').show();
             }
         });
         function hideLoader(){
             $('.loader').waitMe("hide");
         }
     </script>           
        <script type="text/javascript" src="{{asset('assets/js/angular.js')}}"></script>                
        <!-- END PLUGINS -->
        
        <!-- THIS PAGE PLUGINS -->
        <script type='text/javascript' src="{{asset('assets/js/plugins/icheck/icheck.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/plugins/mcustomscrollbar/jquery.mCustomScrollbar.min.js')}}"></script>
        
        <script type="text/javascript" src="{{asset('assets/js/plugins/bootstrap/bootstrap-datepicker.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/plugins/bootstrap/bootstrap-timepicker.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/plugins/bootstrap/bootstrap-colorpicker.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/plugins/bootstrap/bootstrap-file-input.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/plugins/bootstrap/bootstrap-select.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/plugins/tagsinput/jquery.tagsinput.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/plugins/noty/jquery.noty.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/plugins/noty/layouts/topRight.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/plugins/noty/themes/default.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/plugins/summernote/summernote.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('assets/js/plugins/summernote/angular-summernote.min.js')}}"></script>
        <!-- END THIS PAGE PLUGINS -->       
        
        <!-- START TEMPLATE -->
        <script type="text/javascript" src="{{asset('assets/js/settings.js')}}"></script>
        
        <script type="text/javascript" src="{{asset('assets/js/plugins.js')}}"></script>        
        <script type="text/javascript" src="{{asset('assets/js/actions.js')}}"></script>        
        <!-- END TEMPLATE -->
        <!--Start Angular Ctrl-->
    <script  type="text/javascript" src="{{asset('assets/js/angular-route.min.js')}}"></script>
    <script  type="text/javascript" src="{{asset('assets/js/angular-cookies.min.js')}}"></script>
     <script  type="text/javascript" src="{{asset('assets/js/dirPagination.js')}}"></script>
    <script  type="text/javascript" src="{{asset('js/adminDashboard/adminDashboardController.js')}}"></script>
    <script  type="text/javascript" src="{{asset('js/adminDashboard/userManageController.js')}}"></script>
    <script  type="text/javascript" src="{{asset('js/adminDashboard/addManageController.js')}}"></script>
    <script  type="text/javascript" src="{{asset('js/adminDashboard/adminVideoAlbumController.js')}}"></script>
    <script  type="text/javascript" src="{{asset('js/adminDashboard/gallaryController.js')}}"></script>
    <script  type="text/javascript" src="{{asset('js/adminDashboard/adminPhotoAlbumController.js')}}"></script>
    <script  type="text/javascript" src="{{asset('js/adminDashboard/adminUploadController.js')}}"></script>
    <script  type="text/javascript" src="{{asset('js/adminDashboard/newsPostController.js')}}"></script>
    <script  type="text/javascript" src="{{asset('js/adminDashboard/detailNewsPostController.js')}}"></script>
    <script  type="text/javascript" src="{{asset('js/adminDashboard/editNewsPostController.js')}}"></script>
    
    <script  type="text/javascript" src="{{asset('js/adminDashboard/motamotPostController.js')}}"></script>
    <script  type="text/javascript" src="{{asset('js/adminDashboard/detailMotamotPostController.js')}}"></script>
    <script  type="text/javascript" src="{{asset('js/adminDashboard/editMotamotPostController.js')}}"></script>
    <script  type="text/javascript" src="{{asset('js/adminDashboard/Apps/adminPanelApp.js')}}"></script>

    <!--End Angular Ctrl-->
    @yield('script')
    <!-- END SCRIPTS -->                   
    </body>
</html>






