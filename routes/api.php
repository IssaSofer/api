<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("register", "RegisterController@register");
Route::post("login", "LoginController@login");

 Route::middleware('auth:api')->group(function() {
    Route::resource("post", "api\postController");
    Route::resource("profile", "api\profileController");
    Route::post("logout", "api\profileController@logout");
    Route::get("post/{id}/donate", "api\donatorController@index");
    Route::post("post/{id}/donate", "api\donatorController@story");
});