<style>
    .meganizr > li.col1:hover, 
    .meganizr > li.active a,
	.meganizr > li.col1 > a:hover{ background-color: #FF6600;}
	.meganizr > li.col2:hover, 
    .meganizr > li.active a,
	.meganizr > li.col2 > a:hover{ background-color: #C40A2A; color: #fff; }
	.meganizr > li.col3:hover, 
    .meganizr > li.active a,
	.meganizr > li.col3 > a:hover{ background-color: #84154D; color: #fff; }
	.meganizr > li.col4:hover, 
    .meganizr > li.active a,
	.meganizr > li.col4 > a:hover{ background-color: #098346; color: #fff; }
	.meganizr > li.col5:hover, 
    .meganizr > li.active a,
	.meganizr > li.col5 > a:hover{ background-color: #1399BE; color: #fff; }
	.meganizr > li.col6:hover, 
    .meganizr > li.active a,
	.meganizr > li.col6 > a:hover{ background-color: #8768DE; color: #fff; }

	.meganizr > li.col7:hover, 
    .meganizr > li.active a,
	.meganizr > li.col7 > a:hover{ background-color: #C40A2A; color: #fff; }
	.meganizr > li.col8:hover, 
    .meganizr > li.active a,
	.meganizr > li.col8 > a:hover{ background-color: #0000FF; color: #fff; }
	.meganizr > li.col9:hover, 
    .meganizr > li.active a,
	.meganizr > li.col9 > a:hover{ background-color: #84154D; color: #fff; }
	.meganizr > li.col10:hover, 
    .meganizr > li.active a,
	.meganizr > li.col10 > a:hover{ background-color: #098346; color: #fff; }
	
</style>
<script>
    /* Responsive Design*/
    $(document).ready(function() {
        var wi = $(window).width();
        if (wi < 980) {
            $('.mzr-responsive').slideUp();
            $('#jmenu .show-menu').click(function() {
                //$('.mzr-responsive').show();
                $(".mzr-responsive").slideToggle(400, "linear", function() {

                });
            });

            $("#jmenu a.submenu").click(function() {

                $('#jmenu a.submenu').siblings().addClass('sibling-toggle');
                $(this).parent().find(".mzr-content").removeClass('sibling-toggle').addClass('slide-visible').slideToggle(400, "linear", function() {});
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
                    <a title="Home" href="{{ route('home') }}" style="background-image: url('{{asset('assets/assets/themes/Gob/themes/responsive_npf/img/home_dark.png')}}');margin-top:5px;"></a>
                </li>
                <li class="col2 {{ Request::is('komiti') ? 'active':'' }}">
                    <a href="{{ route('komiti') }}">কমিটিসমূহ</a>
                </li>
                <li class="col3 {{ Request::is('karjokrom') ? 'active':'' }}">
                    <a href="{{ route('karjokrom') }}">কার্যক্রম</a>
                </li>
                <li class="col4 {{ Request::is('photoGallery') ? 'active':'' }}">
                    <a href="{{ route('photoGallery') }}">গ্যালারি</a>
                </li>
                <li class="col5 {{ Request::is('news') ? 'active':'' }}">
                    <a href="{{ route('news') }}">নিউজ</a>
                </li>
                <li class="col6 {{ Request::is('kroibikroi') ? 'active':'' }}">
                    <a href="{{ route('kroibikroi') }}">ক্রয়-বিক্রয়</a>
                </li>
                <li class="col7 {{ Request::is('biggopti') ? 'active':'' }}">
                    <a href="{{ route('biggopti') }}">বিজ্ঞপ্তি</a>
                </li>
                <li class="col8 {{ Request::is('motamot') ? 'active':'' }}">
                    <a href="{{ route('motamot') }}">মতামত</a>
                </li>
                @if (Auth::check())
                <li class="col1 {{ Request::is('dashboard') ? 'active':'' }}">
                    <a href="{{  route('dashboard') }}">ড্যাশবোর্ড</a>
                </li>
                <li class="col9 {{ Request::is('logout') ? 'active':'' }}">
                    <a href="{{  route('logout') }}">প্রস্থান</a>
                </li>
                @else
                <li class="col1 {{ Request::is('login') ? 'active':'' }}0">
                    <a href="{{ route('login') }}">লগইন</a>
                </li>
                <li class="col9 {{ Request::is('register') ? 'active':'' }}">
                    <a href="{{  route('register') }}">রেজিস্ট্রেশন</a>
                </li>
                @endif

            </ul>
        </div>
    </div>
</div>