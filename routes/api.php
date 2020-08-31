<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::middleware('pages:api')->get('/user', function (Request $request) {
    return $request->user();
});

//会員登録API
Route::post('/register', 'Auth\RegisterController@register')->name('register');
//ログインAPI
Route::post('/login', 'Auth\LoginController@login')->name('login');
//ログアウトAPI
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');
//ログインしているユーザー情報を取得するAPI
Route::get('/user', fn() => Auth::user())->name('user');

//レポートを新規投稿するAPI
Route::post('/reports', 'ReportController@create')->name('report.create');

//レポート一覧を取得するAPI
Route::get('/reports', 'ReportController@index')->name('report.index');

//レポートを削除するAPI
// Route::delete('/reports', 'ReportController@delete')->name('report.delete');

//レポート詳細取得
Route::get('/reports/{report_id}', 'ReportController@show')->name('report.show');
