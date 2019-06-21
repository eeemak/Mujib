@extends('panel.public.master')
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
            অনুসন্ধান
        </h5>
        <div class="form-horizontal">
            <div class="col-xs-12" style="padding-right:0px">
                <div class="form-group">
                    <div class="col-sm-12">
                        <select class="form-control" ng-model="advanceSearchData.DistrictId"
                                ng-options="item.id as item.name for item in districtList" id="DistrictId"
                                name="District" ng-change="getThana()">
                            <option value="">District</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="col-xs-12" style="padding-right:0px">
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="select-style">
                            <select class="form-control ha-dbbl" ng-model="advanceSearchData.ThanaId"
                                    ng-options="item.id as item.name for item in thanaList" id="ThanaId"
                                    name="Thana" ng-change="getPoliceStation()">
                                <option value="">Thana</option>
                            </select>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-xs-12" style="padding-right:0px">
                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="select-style">
                            <select class="form-control" ng-model="advanceSearchData.PoliceStationId"
                                    ng-options="item.id as item.name for item in policeStationList" id="PoliceStationId"
                                    name="PoliceStation" ng-change="getVillage()">
                                <option value="">Union</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12"style="padding-right:0px">

                <div class="form-group">
                    <div class="col-sm-12">
                        <div class="select-style">
                            <select class="form-control ha-dbbl" ng-model="advanceSearchData.VillageId"
                                    ng-options="item.id as item.name for item in villageList" id="VillageId"
                                    name="Village" required tabindex="1">
                                <option value="">Village</option>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xs-12">
                <div class="form-group">
                    <div class="col-sm-12">
                        <button class="btn btn-danger" style="width:30%;padding:10px;" ng-click="getUserByAdvanceSearch();"><i class="fa fa-search"></i> <span>সার্চ</span></button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style></style>
    <script></script>
    <div class="column block central-eservices">
        <h5 class="bk-org title eservice-title">
            Title
        </h5>
        <div class="fb-page" data-href="https://www.facebook.com/sugary.xoxo/" data-tabs="timeline" data-width="" data-height="" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/bd5000net/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/bd5000net/">bd5000.com</a></blockquote></div>
    </div>
    <style>
        .eservice-title {
            background-color: #c40a2a !important;
            color: #fff;
            font-size: 12px;
            padding: 5px;
        }

        .block ul li {
            background: rgba(0, 0, 0, 0) url('{{asset('themes/responsive_npf/images/bg_block_list.png')}}') no-repeat scroll center bottom;
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
            <!-- @*<div class="modal-header">
                    <h3 class="modal-title"></h3>
                    <button type="button" class="modal-close" data-dismiss="modal">
                        x
                    </button>
                </div>*@ -->
            <div class="modal-body">
                <div class="list-group">
                    <a href="#" id="style-3" dir-paginate="x in advanceSearchUserList | itemsPerPage:UserByAdvanceSearchParameters.PageSize" current-page="UserByAdvanceSearchParameters.PageNo" pagination-id="metaData.name + 'advanceSearchUserList'" total-items='UserByAdvanceSearchParameters.Total_Count' class="list-group-item list-group-item-action flex-column align-items-start list-ha-box" ng-class-odd="'list-ha-left'">
                        <div ng-if="x.PhotoPath==''" class="treatment-icon col-sm-4">
                            <i class="fa fa-user" aria-hidden="true"></i>
                        </div>
                        <div ng-if="x.PhotoPath !=''" class="treatment-icon col-sm-4">
                            <img ng-if="x.PhotoPath!=''" src="@{{x.PhotoPath}}" class="profileImage" />
                        </div>
                        <div class="col-sm-8 ad-list-info">
                            <h3>@{{x.FullName}}</h3>
                            <p>@{{x.Phone}}</p>
                            <p>Village: @{{ x.VillageName !=""?x.VillageName: "Not Given"}}</p>
                            <p>Union:  @{{x.PoliceStationName}}</p>
                            <p>Thana:  @{{x.ThanaName}}</p>
                            <p>District: @{{x.DistrictName}}</p>
                        </div>
                    </a>
                </div>

                <div class="col-sm-12">
                    <dir-pagination-controls max-size="10"
                                             pagination-id="metaData.name + 'advanceSearchUserList'"
                                             direction-links="true"
                                             boundary-links="true"
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
