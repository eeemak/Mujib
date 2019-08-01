<?php
//=======All User & Guest =======
Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));
Route::get('komiti', ['as' => 'komiti', 'uses' => 'HomeController@komitishomuho']);
Route::get('karjokrom', ['as' => 'karjokrom', 'uses' => 'HomeController@karjokrom']);
Route::get('news', ['as' => 'news', 'uses' => 'HomeController@news']);
Route::get('kroibikroi', ['as' => 'kroibikroi', 'uses' => 'HomeController@kroibikroi']);
Route::get('biggopti', ['as' => 'biggopti', 'uses' => 'HomeController@biggopti']);
Route::get('motamot', ['as' => 'motamot', 'uses' => 'HomeController@motamot']);
Route::get('news-detail/{id}', 'HomeController@newsdetail');
Route::get('motamot-detail/{id}', 'HomeController@motamotdetail');
Route::group(['prefix' => 'api'], function () {
    Route::get('/GetDistrict', 'HomeController@GetDistrict');
    Route::get('/GetThana', 'HomeController@GetThana');
    Route::get('/GetPoliceStation', 'HomeController@GetPoliceStation');
    Route::get('/GetVillage', 'HomeController@GetVillage');
    Route::get('/GetProfessionTypeCbo', 'HomeController@GetProfessionTypeCbo');
    Route::get('/AdvanceSearchUsers', 'HomeController@AdvanceSearchUsers');
    Route::get('/CheckUserExist', 'HomeController@CheckUserExist');
    Route::get('/GetPublicGallary', 'HomeController@GetPublicGallary');
    Route::get('/GetAllPublicNewsPosts/{take}', 'NewsPostController@GetAllPublicNewsPosts');
    Route::get('/GetAllPublicMotamotPosts/{take}', 'MotamotPostController@GetAllPublicMotamotPosts');
    Route::get('/GetNewsPublicPostById/{id}', 'NewsPostController@GetNewsPostById');
    Route::get('/GetPostCategory', 'AdminDashboardHomeController@GetPostCategory');
    Route::get('/GetAllNewsPosts/{take}', 'NewsPostController@GetAllNewsPosts');
    Route::get('/GetNewsPostById/{id}', 'NewsPostController@GetNewsPostById');
    Route::get('/GetNewsPostByCategoryId/{id}/{take}', 'NewsPostController@GetNewsPostByCategoryId');
    Route::get('/GetCommentListWithPostId', 'NewsPostController@GetCommentListWithPostId');
    Route::get('/GetAllMotamotPostsByUserId/{take}', 'MotamotPostController@GetAllMotamotPostsByUserId');
    Route::get('/GetMotamotPostById/{id}', 'MotamotPostController@GetMotamotPostById');
    Route::get('/GetMotamotPostByCategoryId/{id}/{take}', 'MotamotPostController@GetMotamotPostByCategoryId');
    Route::get('/GetMotamotCommentListWithPostId', 'MotamotPostController@GetCommentListWithPostId');




});
//=======Only Guest=======
Route::group(['middleware' => 'guest'], function () {
    Route::get('login', ['as' => 'login', 'uses' => 'HomeController@login']);
    Route::post('login', ['as' => 'attempt_login', 'uses' => 'HomeController@attemptLogin']);
    Route::get('register', ['as' => 'register', 'uses' => 'HomeController@register']);
    Route::post('register', ['as' => 'attempt_register', 'uses' => 'HomeController@attemptRegister']);
    Route::group(['prefix' => 'api'], function () {
        Route::post('RegisterUser', ['as' => 'attempt_register', 'uses' => 'HomeController@attemptRegister']);
    });
    Route::get('photoGallery', ['as' => 'photoGallery', 'uses' => 'HomeController@publicGallery']);

});
//=======All User=======
Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', ['as' => 'logout', 'uses' => 'HomeController@logout']);
    Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'AdminDashboardHomeController@dashboard']);
    Route::get('profile', ['as' => 'profile', 'uses' => 'AdminDashboardHomeController@viewProfile']);
    Route::get('gallary', ['as' => 'gallary', 'uses' => 'AdminDashboardHomeController@Gallary']);
    Route::get('motamot-management/{id}', 'MotamotPostController@viewDetailMotamot');
    Route::get('motamot-edit/{id}', 'MotamotPostController@viewEditMotamot');
    Route::group(['prefix' => 'api'], function () {
        Route::get('/GetUserById', 'AdminDashboardHomeController@GetUserById');
        Route::get('/GetUserInstructionList', 'HomeController@GetUserInstructionList');
        Route::get('/GetGallaryByUser', 'AdminDashboardHomeController@GetGallaryByUser');
        Route::get('/GetFileType', 'AdminUploadController@GetFileType');
        Route::get('/GetUserFileById', 'AdminUploadController@GetUserFileById');
        Route::get('/GetUserFileAll', 'AdminUploadController@GetUserFileAll');
        Route::post('/UploadFile', 'AdminUploadController@UploadFile');
        Route::post('/UpdateUser', 'AdminDashboardHomeController@UpdateUser');
        Route::post('/UploadProfileImage', 'AdminDashboardHomeController@UploadProfileImage');
        Route::post('/UploadGallary', 'AdminDashboardHomeController@UploadGallary');
        Route::post('/DeleteGallary', 'AdminDashboardHomeController@DeleteGallary');
        Route::post('/DeleteUserFileById/{id}', 'AdminUploadController@DeleteUserFileById');
        Route::post('/SaveNews', 'NewsPostController@SaveNews');
        Route::post('/UpdateNews', 'NewsPostController@UpdateNews');
        Route::post('/CommentInsert', 'NewsPostController@CommentInsert');
        Route::post('/SaveMotamot', 'MotamotPostController@SaveMotamot');
        Route::post('/UpdateNews', 'MotamotPostController@UpdateMotamot');
        Route::post('/CommentInsert', 'MotamotPostController@CommentInsert');


    });
    //=======Admin=======
    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('upload-management', ['as' => 'upload', 'uses' => 'AdminUploadController@viewUpload']);
        Route::get('news-management', ['as' => 'news-panel', 'uses' => 'NewsPostController@viewNews']);
        Route::get('news-management/{id}', 'NewsPostController@viewDetailNews');
        Route::get('news-edit/{id}', 'NewsPostController@viewEditNews');
        Route::get('motamot-management-admin', ['as' => 'motamot-panel-admin', 'uses' => 'MotamotPostController@viewAdminMotamot']);
        Route::get('/GetAllMotamotPosts/{take}', 'MotamotPostController@GetAllMotamotPosts');

    });
    //=======User=======
    Route::group(['middleware' => ['role:user']], function () { 
        Route::get('dwonload-management', ['as' => 'dwonload', 'uses' => 'AdminUploadController@viewUserDwonload']);
        Route::get('motamot-management', ['as' => 'motamot-panel', 'uses' => 'MotamotPostController@viewMotamot']);

    });
});

//Clear configurations:
Route::get('/config-clear', function() {
    $status = Artisan::call('config:clear');
    return '<h1>'. $status .'</h1>';
});

//Clear cache:
Route::get('/cache-clear', function() {
    $status = Artisan::call('cache:clear');
    return '<h1>Cache cleared</h1>';
});

//Clear configuration cache:
Route::get('/config-cache', function() {
    $status = Artisan::call('config:Cache');
    return '<h1>Configurations cache cleared</h1>';
});

//Migration fresh seed:
Route::get('/artisan-migrate-fresh-seed', function() {
    $status = Artisan::call('migrate:fresh --seed');
    return '<h1>Migrate Fresh Seed Successfull</h1>';
});
