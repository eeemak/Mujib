@extends('panel.public.master')
@section('content')
<div class="twelve columns" id="left-content">
        <div class="row mainwrapper">
                {{-- <img src="{{URL::asset('assets/assets/themes/Gob/images/caution.png')}}" alt="" style="width:101%"> --}}
                <div class="row" dir-paginate="x in getAllPersonalnewsPostList | itemsPerPage:PostListSearchParameters.PageSize" current-page="PostListSearchParameters.PageNo" pagination-id="metaData.name + 'getAllPostList'" total-items='PostListSearchParameters.Total_Count'>
                        <div class="col-md-12">
                            <div class="post-item">
                                <div class="post-title col-sm-12">
                                    <a class="" href="/news-detail/@{{x.id}}">@{{x.title}}</a>
                                </div>
                                <div class="post-date"><span class="fa fa-calendar"></span>  @{{x.created_at}} / @{{x.post_categories[0].name}}</a></div>
                                <div class="post-text">
                                        <img  ng-if="x.file_path !=null" src="@{{x.file_path}}" class="img-responsive img-text" width="304" height="236">
                                    <div class="bangla-font" compile="truncString(x.post_detail,800,'...')"></div>
                                </div>
                                <div class="post-row">
                                    <a href="/news-detail/@{{x.id}}" class="btn btn-default btn-rounded pull-right">Read more &RightArrow;</a>
                                </div>

                            </div>
                        </div>
                    </div>
        </div>
</div>
@endsection
