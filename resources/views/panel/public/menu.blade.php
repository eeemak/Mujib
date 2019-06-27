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
                <li class="col2">
                    <a href="{{ route('komiti') }}">কমিটিসমূহ</a>
                </li>
                <li class="col3">
                    <a href="{{ route('karjokrom') }}">কার্যক্রম</a>
                </li>
                <li class="col4">
                    <a href="{{ route('photoGallery') }}">গ্যালারি</a>
                </li>
                <li class="col5">
                    <a href="{{ route('news') }}">নিউজ</a>
                </li>
                <li class="col6">
                    <a href="{{ route('kroibikroi') }}">ক্রয়-বিক্রয়</a>
                </li>
                <li class="col7">
                    <a href="{{ route('biggopti') }}">বিজ্ঞপ্তি</a>
                </li>
                <li class="col8">
                    <a href="{{ route('motamot') }}">মতামত</a>
                </li>
                <li class="col10">
                    <a href="{{ route('login') }}">লগইন</a>
                </li>
                <li class="col9">
                    <a href="{{  route('register') }}">রেজিস্ট্রেশন</a>
                </li>

            </ul>
        </div>
    </div>
</div>