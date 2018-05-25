<?php

use Illuminate\Http\Request;


Route::group(['middleware' => 'api', 'prefix' => 'cms', 'namespace' => 'Modules\Cms\Http\Controllers'], function()
{
//    Route::get('/', 'CmsController@index');
    Route::middleware('auth:api')->get('/api', function (Request $request) {
        return $request->user();
    });

    Route::get('/services/post', function (Request $request){
        dd('post');
    });
});
