<?php

Route::group(['middleware' => 'web', 'prefix' => '/', 'namespace' => 'App\\Modules\Client\Http\Controllers'], function()
{
    Route::get('/', 'HomeController@index');
    Route::get('/category/{id}', 'CategoryController@index');
    Route::get('/login/wallet', 'LoginController@wallet');
    Route::get('/logout/{access_token}', 'LogoutController@index');
    Route::get('/game/{slug}', 'PlaygameController@index');
});
