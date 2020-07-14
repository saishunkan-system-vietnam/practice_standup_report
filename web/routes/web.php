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

// Đăng ký thành viên
// Route::get('register', 'Auth\RegisterController@getRegister');
// Route::post('register', 'Auth\RegisterController@postRegister');

// Đăng nhập và xử lý đăng nhập
Route::get('login', [ 'as' => 'login', 'uses' => 'Auth\LoginController@getLogin']);
Route::post('login', [ 'as' => 'login', 'uses' => 'Auth\LoginController@postLogin']);

// Đăng xuất
Route::get('logout', [ 'as' => 'logout', 'uses' => 'Auth\LogoutController@getLogout']);

Route::group(['prefix' => 'admin'], function () {
    Route::get('member-list', 'Admin\MemberController@listMember');
    Route::get('member-add', 'Admin\MemberController@registerMember');
    Route::post('member-add', 'Admin\MemberController@postRegisterMember');
    Route::get('member-edit', 'Admin\MemberController@editMember');

});

