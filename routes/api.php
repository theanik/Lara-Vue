<?php

use Illuminate\Http\Request;


Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResources([
    'user' => 'API\UserConroller'
]);

Route::get('profile','API\UserConroller@profileInfo');
Route::put('profile','API\UserConroller@UpdateProInfo');
Route::get('findUser','API\UserConroller@search');