<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', 'Admin\MemberController@index');
Route::get('login', [ 'as' => 'login', 'uses' => 'Auth\LoginController@getLogin']);
Route::post('login', [ 'as' => 'login', 'uses' => 'Auth\LoginController@postLogin']);
Route::get('logout', [ 'as' => 'logout', 'uses' => 'Auth\LogoutController@getLogout']);

Route::group(['prefix' => 'admin'], function () {
    Route::get('member-list', 'Admin\MemberController@listMember');
    Route::get('member-add', 'Admin\MemberController@registerMember');
    Route::post('member-add', 'Admin\MemberController@postRegisterMember');
    Route::get('member-edit/{user_cd}', 'Admin\MemberController@editMember');
    Route::post('member-edit', 'Admin\MemberController@postUpdateMember');
    Route::post('member-del', 'Admin\MemberController@deleteMember');
});

Route::group(['prefix' => 'api'], function () {
    Route::post('login', 'ApiController@postLogin');
    Route::post('save-daily-report', 'ApiController@saveDailyReport');
    Route::post('search-report', 'ApiController@searchReport');
    Route::post('get-data-report', 'ApiController@getDataReport');
    Route::post('get-info-detail-report', 'ApiController@getInfoDetailReport');
});

