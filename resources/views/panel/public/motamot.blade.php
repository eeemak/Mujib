@extends('panel.public.master')
@section('content')
<div class="col-md-12" id="left-content">
        <div class="mainwrapper" loading-pane="isPaneShown">
                <div class="" dir-paginate="x in getAllPersonalmotamotPostList | itemsPerPage:PostListSearchParameters.PageSize" current-page="PostListSearchParameters.PageNo" pagination-id="metaData.name + 'getAllPostList'" total-items='PostListSearchParameters.Total_Count'>
                        <div class="col-md-6">
                            <div class="post-item">
                                <div style="height:202px; overflow:hidden">
                                <img  ng-if="x.file_path !=null" src="@{{x.file_path}}" class="img-responsive img-text" style="max-width: 100%;width: 100%;">
                                </div>
                                        <div class="blog-post-title">
                                                <a class="" href="/motamot-detail/@{{x.id}}">@{{x.title}}</a>
                                            </div>
                                <div class="post-date"><span class="fa fa-calendar"></span>  @{{x.created_at}} | @{{x.post_categories[0].name}}</a></div>
                                <div class="blog-post-text">
                                        <div class="bangla-font" compile="truncString(x.post_detail,500,'...')"></div>
                                    </div>
                                    <div class="post-row">
                                        <a href="/motamot-detail/@{{x.id}}" class="blog-read-more-btn pull-left">বিস্তারিত</a>
                                    </div>
                                </div>
                        </div>
                    </div>
        </div>
</div>
@endsection
