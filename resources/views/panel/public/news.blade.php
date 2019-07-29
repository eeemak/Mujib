@extends('panel.public.master')
@section('content')
<div class="col-md-12" id="left-content">
        <div class="row mainwrapper" loading-pane="isPaneShown">
                <div class="row" dir-paginate="x in getAllPersonalnewsPostList | itemsPerPage:PostListSearchParameters.PageSize" current-page="PostListSearchParameters.PageNo" pagination-id="metaData.name + 'getAllPostList'" total-items='PostListSearchParameters.Total_Count'>
                        <div class="col-md-12">
                            <div class="post-item">
                                <div class="col-md-4">
                                        <img  ng-if="x.file_path !=null" src="@{{x.file_path}}" class="img-responsive img-text" style="width: 100%;height: 202px;">
                                </div>
                                <div class="col-md-8">
                                        <div class="post-title col-sm-12">
                                                <a class="" href="/news-detail/@{{x.id}}">@{{x.title}}</a>
                                            </div>
                                <div class="post-date"><span class="fa fa-calendar"></span>  @{{x.created_at}} / @{{x.post_categories[0].name}}</a></div>
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
