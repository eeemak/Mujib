@extends('panel.layout.public.master')
@section('content')
<div class="twelve columns" id="left-content">
    <div class="row mainwrapper">
        <style>
            #notice-board-ticker ul li {
                list-style: none;
            }
        </style>
        <script></script>
        <style>
            .lineheight {
                line-height: 22px;
            }
        </style>
        <script></script>
        <div class="column block">
            <h5 class="bk-org title">
                মুজিব সার্কেলে আপনাকে স্বাগতম
            </h5>

            @*<p>জাতির মর্যাদা ও গৌরবের প্রতীক &lsquo;বঙ্গভবন&rsquo; গণপ্রজাতন্ত্রী বাংলাদেশের মহামান্য রাষ্ট্রপতির কার্যালয় ও বাসভবন। বঙ্গভবনের রয়েছে শতাব্দীকালের বর্ণাঢ্য ইতিহাস। ব্রিটিশ শাসনামলে ১৯০৫ সালের ০১ সেপ্টেম্বর পূর্ববঙ্গ ও আসাম নামে নতুন প্রদেশ সৃষ্টি হলে নবসৃষ্ট প্রদেশের প্রধান শাসনকর্তা তথা লেফটেন্যান্ট গভর্নরের কার্যালয় ও বাসভবনের প্রয়োজনে বঙ্গভবনের যাত্রা। তখন এর নাম ছিল &lsquo;গভর্নমেন্ট হাউজ&rsquo;।</p>

            <p style="text-align:justify">&nbsp;</p>

            <p style="text-align:justify">&nbsp;১৯৪৭ সালের ১৪ আগস্ট পাকিস্তান রাষ্ট্রের জন্ম হলে নতুন প্রাদেশিক শাসনকর্তা তথা &lsquo;গভর্নর&rsquo;-এর দপ্তর ও বাসস্থান নির্বাচিত হয় ব্রিটিশ আমলের গভর্নমেন্ট হাউজ। এ সময় গভর্নমেন্ট হাউজ এর নাম পরিবর্তন করে নতুন নামকরণ করা হয় &lsquo;গভর্নর হাউজ&rsquo;। অনেক চড়াই উৎরাই পেরিয়ে ১৯৭১ সালের ২৬ মার্চ জাতির পিতা বঙ্গবন্ধু শেখ মুজিবুর রহমান স্বাধীনতার ঘোষণা দেন। সৃষ্টি হয় স্বাধীন-সার্বভৌম বাংলাদেশ।</p>

            <p style="text-align:justify">&nbsp;</p>

            <p style="text-align:justify">&nbsp;এরপর দীর্ঘ ন&rsquo;মাস সশস্ত্র মুক্তিযুদ্ধের মাধ্যমে ১৬ ডিসেম্বর বিজয় অর্জনের পর অস্থায়ী রাষ্ট্রপতি সৈয়দ নজরুল ইসলাম, প্রধানমন্ত্রী তাজউদ্দিন আহমেদ এবং মন্ত্রিপরিষদের অন্যান্য সদস্যগণ ১৯৭১ সালের ২৩ ডিসেম্বর গভর্নর হাউজে মন্ত্রিপরিষদের সভা করেন। ঐ সভায় গভর্নর হাউজকে &lsquo;বঙ্গভবন&rsquo; নামে অভিহিত করা হয়। গৌরব ও সম্মানের স্মারক বঙ্গভবন জাতির আশা আকাঙ্ক্ষার&nbsp; প্রতীক।</p>

            <p style="text-align:justify">&nbsp;</p>

            <p style="text-align:justify">মহামান্য রাষ্ট্রপতি গণপ্রজাতন্ত্রী বাংলাদেশের সংবিধান প্রদত্ত ক্ষমতাবলে দায়িত্ব পালন করেন। সাংবিধানিক দায়িত্ব পালন ছাড়াও তিনি রাষ্ট্রীয়, আনুষ্ঠানিক (Ceremonial), শিক্ষা, সামাজিক, সাংস্কৃতিকসহ বিভিন্ন দায়িত্ব পালন করেন। তিনি মাননীয় প্রধানমন্ত্রী, মন্ত্রিপরিষদের সদস্যবর্গ, বাংলাদেশের প্রধান বিচারপতি, সুপ্রীম কোর্টের বিচারপতি, অ্যাটর্নি জেনারেল, সাংবিধানিক প্রতিষ্ঠানে নিযুক্ত ব্যক্তিবর্গের নিয়োগ প্রদান করেন। তাছাড়া জাতীয় সংসদের অধিবেশন আহ্বান ও সমাপ্তি ঘোষণা করেন। মহামান্য রাষ্ট্রপতি সশস্ত্র বাহিনীর সর্বাধিনায়ক ((Supreme Command) এবং বিশ্ববিদ্যালয়সমূহের চ্যান্সেলর। বাংলাদেশে নিযুক্ত রাষ্ট্রদূতগণ মহামান্য রাষ্ট্রপতির নিকট পরিচয়পত্র (Credentials) পেশ করেন। জাতীয় দিবসসমূহে মহামান্য রাষ্ট্রপতি জাতির উদ্দেশ্যে বাণী প্রদান করেন এবং বঙ্গভবনে সংবর্ধনার আয়োজন করেন।</p>

            <p style="text-align:justify">&nbsp;</p>

            <p style="text-align:justify">বঙ্গভবনের মূলভবনে রয়েছে ঐতিহাসিক দরবার হল। রাষ্ট্রপতি, প্রধানমন্ত্রী, প্রধান বিচারপতি, মন্ত্রিপরিষদের সদস্যবৃন্দের শপথ অনুষ্ঠিত হয় এ দরবার হলে। বিদেশী রাষ্ট্রপ্রধানগণ বাংলাদেশ সফরকালীন তাঁদের সম্মানে এখানে নৈশভোজের (Banquet) আয়োজন করা হয়। ঈদ-উল-ফিতর, ঈদ-উল-আযহা, জন্মাষ্টমী, দুর্গাপূজা, বুদ্ধ পূর্ণিমা, বড়দিন, বাংলা নববর্ষসহ সামাজিক, সাংস্কৃতিক ও পারিবারিক অনুষ্ঠানমালা এ দরবার হলে অনুষ্ঠিত হয়। কালের সাক্ষী এ দরবার হল তাই বঙ্গভবনের ঐতিহ্যের স্মারক।</p>

            <p style="text-align:justify">&nbsp;</p>

            <p style="text-align:justify">মহামান্য রাষ্ট্রপতির কাজে সার্বিক সহায়তা প্রদানের লক্ষ্যে রাষ্ট্রপতির কার্যালয়ে জন বিভাগ (Public Division) ও আপন বিভাগ (Personal Division) নামে দু&rsquo;টি বিভাগ রয়েছে। রাষ্ট্রপতির কার্যালয়ের সচিব ও রাষ্ট্রপতির সামরিক সচিবের নেতৃত্বে এ বিভাগ দু&rsquo;টি পরিচালিত হয়। বঙ্গভবন ইতিহাস ও ঐতিহ্যের অবিচ্ছেদ্য অঙ্গ। এ ওয়েবসাইট অবলোকনের মাধ্যমে অনুসন্ধিৎসু পাঠক বঙ্গভবনের ইতিহাস, রাষ্ট্রপতির কার্যাবলীসহ সাবেক রাষ্ট্রপতি ও বঙ্গভবনের বিভিন্ন কার্যক্রম সম্পর্কে জানতে পারবেন।</p>

            <p style="text-align:justify">&nbsp;</p>

            <p style="text-align:justify">বঙ্গভবনের ওয়েবসাইট ব্রাউজ করার জন্য আপনাকে ধন্যবাদ।</p>

            <p style="text-align:justify">&nbsp;</p>
            <p>
            </p>*@
        </div>
        <style>
            #right-content .block {
                display: block !important
            }
        </style>
        <style>
            .ad-image-description span {
                display: none
            }
        </style>
        <style>
            .ad-gallery .ad-info {
                width: 200px
            }

            .ad-thumb-list {
                list-style: none !important
            }

            .ad-gallery {
                width: 100% !important
            }

            .ad-image {
                width: 100% !important;
                top: 0px !important;
                height: 432px !important
            }

                .ad-image img {
                    width: 100% !important;
                    height: 432px !important
                }

                .ad-image .ad-image-description {
                    width: 100% !important
                }

            .ad-gallery .ad-image-wrapper {
                height: 432px;
            }

            .ad-thumbs {
                height: 70px
            }

            .bitac-portal-gov-bd .ad-gallery .ad-image-wrapper {
                height: 300px;
            }

            .bitac-portal-gov-bd .ad-image {
                height: 100% !important
            }

                .bitac-portal-gov-bd .ad-image img {
                    height: 100% !important
                }

            .ad-image-description span {
                display: none
            }
        </style>
        <script></script>
    </div>
</div>
<div class="four columns right-side-bar" id="right-content">
    <style>
        #right-content .block {
            display: block !important
        }
    </style>
    <script></script>
    <div class="column block">
        <h5 class="bk-org title">
            Title
        </h5>
        <ul>

            @*<li><a href="https://mail.bangabhaban.gov.bd/">ওয়েব মেইল</a></li>

            <li><a href="http://nothi.gov.bd/login">জাতীয় ই-সেবা সিস্টেম</a></li>*@
        </ul>
        @*<a href="site/view/internal_eservices.html" style="display:block;text-align:right;text-decoration:underline;">সকল </a>*@

        <!-- <a href="/site/view/internal_eservices" class="btn" style="display:block;text-align:center;">সকল ই-সেবা</a> -->
        <!--<a href="/site/view/internal_eservices" style="display:block;text-align:right;text-decoration:underline;">সকল </a>> -->

    </div>
    <style></style>
    <script></script>
    <div class="column block central-eservices">
        <h5 class="bk-org title eservice-title">
            Title
        </h5>
        <ul>

            @*<li class="item_1"><a href="http://service.gov.bd/">অনলাইনে সেবার আবেদন</a></li>

            <li class="item_2"><a href="http://www.nothi.gov.bd/users/login">নথি</a></li>

            <li class="item_3"><a href="http://bangladesh.gov.bd/site/page/5c238920-a65f-4168-9c2b-70c39dc7cb1c">প্রয়োজনীয় এপস </a></li>

            <li class="item_4"><a href="http://bris.lgd.gov.bd/pub/?pg=application_form">জন্ম ও মৃত্যু নিবন্ধন</a></li>

            <li class="item_5"><a href="http://xn--d5by7bap7cc3ici3m.xn--54b7fta0cc/">উত্তরাধিকার ক্যালকুলেটর</a></li>

            <li class="item_6"><a href="http://pcc.police.gov.bd/en/f?p=500:1:::NO:::">অনলাইন পুলিশ ক্লিয়ারেন্স</a></li>

            <li class="item_7"><a href="http://www.dip.gov.bd/site/page/f2d015a9-1132-4426-8eef-147f1c4bac8a">অনলাইনে পাসপোর্টের আবেদন</a></li>

            <li class="item_8"><a href="https://services.nidw.gov.bd/">জাতীয় পরিচয়পত্রের তথ্য হালনাগাদকরণ</a></li>

            <li class="item_9"><a href="http://www.cga.gov.bd/index.php?option=com_wrapper">অনলাইন চালান যাচাইকরণ</a></li>

            <li class="item_10"><a href="https://www.etaxnbr.gov.bd/tpos/home">অনলাইন আয়কর পরিশোধ</a></li>

            <li class="item_11"><a href="http://www.bmet.gov.bd/BMET/onlinaVisaCheckAction"> ভিসা যাচাই </a></li>

            <li class="item_12"><a href="http://eservice.bkkb.gov.bd/">বিকেকেবি শিক্ষাবৃত্তির আবেদন</a></li>

            <li class="item_13"><a href="http://accessibledictionary.gov.bd/">অভিগম্য অভিধান</a></li>*@
        </ul>
    </div>
    <style>
        .eservice-title {
            background-color: #c40a2a !important;
            color: #fff;
            font-size: 12px;
            padding: 5px;
        }

        .block ul li {
            background: rgba(0, 0, 0, 0) url("themes/responsive_npf/images/bg_block_list.png") no-repeat scroll center bottom;
            font-size: 120%;
            height: auto;
            list-style-type: none;
            margin-bottom: 5px;
            padding-bottom: 8px;
            padding-left: 32px;
            padding-top: 0;
        }

        body.bpsc-portal-gov-bd .wsis_prize {
            display: none
        }
    </style>
    <script></script>
    <style>
        #right-content .block {
            display: block !important
        }
    </style>
    <div class="column block">
        <h5 class="bk-org title">Title </h5>

        @*<a href="https://www.facebook.com/Bangabhaban-182500998818773/?skip_nax_wizard=true" target="_blank" class="share-buttons">
            <img src="themes/responsive_npf/img/social/facebook.png" alt="ফেসবুক" />
        </a>

        <a href="https://www.youtube.com/" target="_blank" class="share-buttons">
            <img src="themes/responsive_npf/img/social/youtube.png" alt="ইউটিউব" />
        </a>*@

    </div>

    <div class="clearfix"></div>
    <style>
        .share-buttons img {
            width: 30px;
            padding: 2px;
            border: 0;
            box-shadow: 0;
            display: inline;
        }
    </style>
    <script></script>
    <script>
        $(document).ready(function () {
            el = $('h5:contains("সেবা সহজিকরণ")');
            text = el.html()
            el.html('').html('<a style="color:#fff" href="/site/view/sps_data">' + text + '<a>');
        });
    </script>
    <style></style>
    <script></script>
    <!-- <div style="" class="column block">

            <h5 style="background-color: #eee;">
                                                                                                দর্শক সংখ্যাঃ
                                    <span style="padding:5px; background-color: #609513; color: #fff; font-weight:bold;">
                                        <span>
            </h5>
        </div> -->
</div>
<div id="thikanaModal" class="modal fade" role="dialog">
    <div class="modal-dialog  modal-lg">
        <div class="modal-content" style="background:#EBEBEB">
            @*<div class="modal-header">
                    <h3 class="modal-title"></h3>
                    <button type="button" class="modal-close" data-dismiss="modal">
                        x
                    </button>
                </div>*@
            <div class="modal-body">
                <div class="list-group">
                    <a href="#" id="style-3" dir-paginate="x in advanceSearchUserList | itemsPerPage:UserByAdvanceSearchParameters.PageSize" current-page="UserByAdvanceSearchParameters.PageNo" pagination-id="metaData.name + 'advanceSearchUserList'" total-items='UserByAdvanceSearchParameters.Total_Count' class="list-group-item list-group-item-action flex-column align-items-start list-ha-box" ng-class-odd="'list-ha-left'">
                        <div ng-if="x.PhotoPath==''" class="treatment-icon col-sm-4">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </div>
                        <div ng-if="x.PhotoPath !=''" class="treatment-icon col-sm-4">
                            <img ng-if="x.PhotoPath!=''" src="{{x.PhotoPath}}" class="profileImage" />
                        </div>
                        <div class="col-sm-8 ad-list-info">
                            <h3>{{x.FullName}}</h3>
                            <p>{{x.Phone}}</p>
                            <p>Village: {{ x.VillageName !=""?x.VillageName: "Not Given"}}</p>
                            <p>Union:  {{x.PoliceStationName}}</p>
                            <p>Thana:  {{x.ThanaName}}</p>
                            <p>District: {{x.DistrictName}}</p>
                        </div>
                    </a>
                </div>

                <div class="col-sm-12">
                    <dir-pagination-controls max-size="10"
                                             pagination-id="metaData.name + 'advanceSearchUserList'"
                                             direction-links="true"
                                             boundary-links="true"
                                             @*template-url="dirPagination.tpl.cshtml"*@
                                             on-page-change="pageChangeHandler(newPageNumber)">
                    </dir-pagination-controls>
                </div>
                <div style="clear: both;"></div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@endsection
