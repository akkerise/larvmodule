<?php

Route::group(['middleware' => 'web', 'prefix' => 'client', 'namespace' => 'App\\Modules\Client\Http\Controllers'], function()
{
    Route::get('/', 'ClientController@index');
});
