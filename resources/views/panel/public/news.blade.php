@extends('panel.public.master')
@section('content')
<div class="col-md-12" id="left-content">
   <div class="row mainwrapper" loading-pane="isPaneShown">
      <div class="row" id="header_news">
         <div class="col-sm-8">
            <div>
               <img  ng-if="newsTitleOb.file_path !=null" src="@{{newsTitleOb.file_path}}" class="img-responsive" style="width: 100%;height: auto;">
            </div>
            <div style="margin-top: 10px;">
               <a class="" style="font-size: 22px;font-weight: bold;font-family: kalpurushregular !important;" href="/news-detail/@{{newsTitleOb.id}}">@{{newsTitleOb.title}}</a>
            </div>
         </div>
         <div class="col-sm-4">
            <div class="row" ng-repeat="x in newsRightList">
               <div class="col-sm-4" style="padding-left:0;padding-right:0">
                  <img  ng-if="x.file_path !=null" src="@{{x.file_path}}" class="img-responsive" style="width: 120px;height: 67px;">
               </div>
               <div class="col-sm-8">
                  <a class="" href="/news-detail/@{{x.id}}">@{{x.title}}</a>
               </div>
            </div>
         </div>
      </div>
      <div class="row" id="header_news_bottom">
      <div ng-repeat="x in headerNewsBottomList">
      <div class="col-sm-3">
      <div>
      <img  ng-if="x.file_path !=null" src="@{{x.file_path}}" class="img-responsive" style="width: 100%;height: 135px;">
      </div>
      <div class="post-title" style="margin-top: 10px;">
                     <a class="" href="/news-detail/@{{x.id}}">@{{x.title}}</a>
                  </div>
      </div>
      </div>
      </div>
      <div class="row" dir-paginate="x in getAllGeneralNewsPostList | itemsPerPage:PostListSearchParameters.PageSize" current-page="PostListSearchParameters.PageNo" pagination-id="metaData.name + 'getAllPostList'" total-items='PostListSearchParameters.Total_Count'>
         <div class="col-md-12" style="padding-left:0">
            <div class="post-item">
               <div class="col-md-4">
                  <img  ng-if="x.file_path !=null" src="@{{x.file_path}}" class="img-responsive" style="width: 100%;height: 202px;">
               </div>
               <div class="col-md-8">
                  <div class="post-title col-sm-12">
                     <a class="" href="/news-detail/@{{x.id}}">@{{x.title}}</a>
                  </div>
                  <div class="post-date"><span class="fa fa-calendar"></span>  @{{x.created_at}} | @{{x.post_categories[0].name}}</a></div>
                  <div class="post-text">
                     <div class="bangla-font" compile="truncString(x.post_detail,500,'...')"></div>
                  </div>
                  <div class="post-row">
                     <a href="/news-detail/@{{x.id}}" class="btn btn-default btn-rounded pull-right">Read more &RightArrow;</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
@endsection
