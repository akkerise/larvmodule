<?php

Route::group(['middleware' => 'web', 'prefix' => 'api', 'namespace' => 'App\\Modules\Api\Http\Controllers'], function()
{
    Route::get('/', 'ApiController@index');
});
