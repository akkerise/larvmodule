<?php

use Illuminate\Http\Request;


Route::group(['middleware' => ['api', 'web'], 'prefix' => 'api/cms/game/', 'namespace' => 'App\Modules\Cms\Http\Controllers'], function()
{
       Route::get('detail/{id}', 'Game\Services\GameController@detail')->name('cms.services.game.detail');
       Route::delete('del/{id}', 'Game\Services\GameController@del')->name('cms.services.game.del');
       Route::get('list', 'Game\Services\GameController@list')->name('cms.services.game.list');
});

Route::group(['middleware' => ['api', 'web'], 'prefix' => 'api/cms/cate/', 'namespace' => 'App\Modules\Cms\Http\Controllers'], function()
{
    Route::get('detail/{id}', 'Cate\Services\CategoryController@detail')->name('cms.services.cate.detail');
    Route::delete('del/{id}', 'Cate\Services\CategoryController@del')->name('cms.services.cate.del');
    Route::get('list', 'Game\Services\GameController@list')->name('cms.services.game.list');
});

Route::group(['middleware' => ['api', 'web'], 'prefix' => 'api/cms/user/', 'namespace' => 'App\Modules\Cms\Http\Controllers'], function()
{
    Route::get('detail/{id}', 'User\Services\UserController@detail')->name('cms.services.cate.detail');
    Route::delete('del/{id}', 'User\Services\UserController@del')->name('cms.services.cate.del');
    Route::get('list', 'User\Services\UserController@list')->name('cms.services.game.list');
});

