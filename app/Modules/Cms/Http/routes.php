<?php
use App\Common\Untils\Regular;

Route::group([
    'middleware' => ['web', Regular::PREFIX_GUEST],
    'prefix' => 'cms',
    'namespace' => 'App\\Modules\Cms\Http\Controllers'
], function () {
    Route::get('login', 'Auth\LoginController@gLogin')->name('cms.g.login');
    Route::post('login', 'Auth\LoginController@pLogin')->name('cms.p.login');
});

Route::group([
    'middleware' =>  ['web', Regular::PREFIX_CMS],
    'prefix' => 'cms',
    'namespace' => 'App\\Modules\Cms\Http\Controllers'
], function () {
    Route::get('logout', 'Auth\LoginController@gLogout')->name('cms.logout');
    Route::get('dash', 'Dash\DashboardController@index');


    ################################ GAME ################################
    Route::group([
        'prefix' => 'game',
    ], function () {
        Route::get('list', 'Game\GameController@index')->name('cms.game.list');
        Route::get('add', 'Game\GameController@addGame')->name('cms.g.game.addGame');
        Route::post('add', 'Game\GameController@add')->name('cms.p.game.add');
        Route::get('{id}/edit', 'Game\GameController@editGame')->name('cms.g.game.editGame');
        Route::put('{id}', 'Game\GameController@edit')->name('cms.p.game.edit');
    });

    ################################ USER ################################
    Route::group([
        'prefix' => 'user',
    ], function () {
        Route::get('list', 'User\UserController@index')->name('cms.user.list');
        Route::get('add', 'User\UserController@addUser')->name('cms.g.user.addUser');
        Route::post('add', 'User\UserController@add')->name('cms.p.user.add');
        Route::get('{id}/edit', 'User\UserController@editUser')->name('cms.g.user.editUser');
        Route::put('{id}', 'User\UserController@edit')->name('cms.p.user.edit');
    });

    ################################ CATEGORY ################################
    Route::group([
        'prefix' => 'cate',
    ], function () {
        Route::get('list', 'Cate\CategoryController@index')->name('cms.cate.list');
        Route::get('add', 'Cate\CategoryController@addCate')->name('cms.g.cate.addCate');
        Route::post('add', 'Cate\CategoryController@add')->name('cms.p.cate.add');
        Route::get('{id}/edit', 'Cate\CategoryController@editCate')->name('cms.g.cate.editCate');
        Route::put('{id}', 'Cate\CategoryController@edit')->name('cms.p.cate.edit');
    });

});
