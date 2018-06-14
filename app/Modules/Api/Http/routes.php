<?php

Route::group(['middleware' => 'web', 'prefix' => 'api/v1', 'namespace' => 'App\\Modules\Api\Http\Controllers'], function()
{
    Route::any('/track/score', 'TrackController@score');
    Route::any('/categories', 'CategoryController@categories');
    Route::any('/games', 'GameController@games');
    Route::any('/user/login_wallet', 'LoginController@wallet');
    Route::any('/user/logout', 'LogoutController@logout');
});

