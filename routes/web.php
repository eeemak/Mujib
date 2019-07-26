<?php
//=======All User & Guest =======
Route::get('/', array('as' => 'home', 'uses' => 'HomeController@index'));
Route::group(['prefix' => 'api'], function () {
    Route::get('/GetDistrict', 'HomeController@GetDistrict');
    Route::get('/GetThana', 'HomeController@GetThana');
    Route::get('/GetPoliceStation', 'HomeController@GetPoliceStation');
    Route::get('/GetVillage', 'HomeController@GetVillage');
    Route::get('/GetProfessionTypeCbo', 'HomeController@GetProfessionTypeCbo');
    Route::get('/AdvanceSearchUsers', 'HomeController@AdvanceSearchUsers');
    Route::get('/CheckUserExist', 'HomeController@CheckUserExist');
    Route::get('/GetPublicGallary', 'HomeController@GetPublicGallary');
});
//=======Guest=======
Route::group(['middleware' => 'guest'], function () {
    Route::get('komiti', ['as' => 'komiti', 'uses' => 'HomeController@komitishomuho']);
    Route::get('karjokrom', ['as' => 'karjokrom', 'uses' => 'HomeController@karjokrom']);
    Route::get('news', ['as' => 'news', 'uses' => 'HomeController@news']);
    Route::get('kroibikroi', ['as' => 'kroibikroi', 'uses' => 'HomeController@kroibikroi']);
    Route::get('biggopti', ['as' => 'biggopti', 'uses' => 'HomeController@biggopti']);
    Route::get('motamot', ['as' => 'motamot', 'uses' => 'HomeController@motamot']);
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
        Route::get('/GetPostCategory', 'AdminDashboardHomeController@GetPostCategory');
        Route::post('/SaveNews', 'NewsPostController@SaveNews');
        Route::get('/GetAllNewsPosts/{take}', 'NewsPostController@GetAllNewsPosts');
        Route::get('/GetNewsPostById/{id}', 'NewsPostController@GetNewsPostById');
        Route::get('/GetNewsPostByCategoryId/{id}/{take}', 'NewsPostController@GetNewsPostByCategoryId');


    });
    //=======Admin=======
    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('upload-management', ['as' => 'upload', 'uses' => 'AdminUploadController@viewUpload']);
        Route::get('news-management', ['as' => 'news-panel', 'uses' => 'NewsPostController@viewNews']);
        Route::get('news-detail/{id}', 'NewsPostController@viewDetailNews');
    });
    //=======User=======
    Route::group(['middleware' => ['role:user']], function () { 
        Route::get('dwonload-management', ['as' => 'dwonload', 'uses' => 'AdminUploadController@viewUserDwonload']);
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
