<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Auth::routes(['verify' => true]);

Route::get('login/google', 'Auth\SociaAuthController@redirectTogoogleProvider');
Route::get('login/facebook', 'Auth\SociaAuthController@redirectToFacebookProvider');
Route::get('login/google/callback', 'Auth\SociaAuthController@handleProvidergoogleCallback');
Route::get('login/facebook/callback', 'Auth\SociaAuthController@handleProviderFacebookCallback');

Route::group(['middleware' => ['auth', 'role:1']], function () {
    Route::get('home', 'HomeController@index')->middleware('verified');
    Route::get('profile', 'UserProfileController@index')->middleware('verified');
    Route::post('profile/update/{id}', 'UserProfileController@update')->name('p_update');
    Route::get('event/event', 'EventController@e_index')->name('eindex')->middleware('verified');
    Route::post('event/create', 'EventController@create')->name('e_create');
    Route::get('event/view', 'EventController@v_index')->name('vindex')->middleware('verified');
    Route::post('event/update', 'EventController@update')->name('e_update');
    Route::post('event/delete', 'EventController@delete');
    Route::get('event/myjoin', 'EventController@ej_index')->name('ejindex')->middleware('verified');
    Route::post('event/myjoin/delete', 'EventController@ejdelete');
    Route::get('help', function () {
        return view('back.help');
    });
});

Route::group(['middleware' => ['auth', 'role:2']], function () {
    Route::get('dashboard', 'DashboardController@index')->middleware('verified');
    Route::get('event/management', 'EventController@em_index')->name('emindex')->middleware('verified');
    Route::post('event/change', 'EventController@change')->name('e_change');
});

Route::group(['middleware' => ['auth', 'role:3']], function () {
    Route::get('user', 'UserController@index');
    Route::post('user/update', 'UserController@update')->name('u_update');
    Route::post('user/delete', 'UserController@delete');
});

Route::post('event/event/daylist', 'EventController@daylist');

Route::post('event/filter', 'EventController@event_list');
Route::post('map/filter', 'EventController@event_map');
Route::get('event/map', function () {return view('map');});
Route::get('about', function () {return view('about');});
Route::get('event/detail/{ueid}','EventController@event_detail')->name('e_detail');
Route::post('event/join','EventController@join');
Route::get('change/{locale}', function ($locale) {
    Session::put('locale', $locale);

    return Redirect::back();
});
