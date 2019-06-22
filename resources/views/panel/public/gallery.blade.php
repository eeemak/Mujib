@extends('panel.public.master')
@section('content')
<div class="row">
    <div class="column-3" dir-paginate="x in userFeaturePhotoFileList | itemsPerPage:UserFeaturePhotoFileListSearchParameters.PageSize" current-page="UserFeaturePhotoFileListSearchParameters.PageNo" pagination-id="metaData.name + 'userFeaturePhotoFileList'" total-items='UserFeaturePhotoFileListSearchParameters.Total_Count'>
        <div class="col-lg-3 col-sm-4 col-xs-6"><a title="@{{x.Title}}" href="#"><img class="thumbnail img-responsive" src="@{{x.TempSrc}}" ng-click="showModal(x)"></a></div>
    </div>
</div>
<div tabindex="-1" class="modal fade" id="galleryModal" role="dialog">
    <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
          <button class="close" type="button" data-dismiss="modal">×</button>
          <h3 class="modal-title">@{{imgTitle}}</h3>
      </div>
      <div class="modal-body">
        <a title="Image 1" href="#"><img class="thumbnail img-responsive" src="@{{modalTempSrc}}"></a>
      </div>
      <div class="modal-footer">
          <button class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
     </div>
    </div>
  </div>

@endsection