<?php

Route::group(['middleware' => 'web', 'prefix' => 'common', 'namespace' => 'App\\Modules\Common\Http\Controllers'], function()
{
    Route::get('/', 'CommonController@index');
});
