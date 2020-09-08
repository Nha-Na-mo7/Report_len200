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
//指定のユーザーIDの情報を取得するAPI
Route::get('/user/{user_id}', 'UserController@getUser')->name('userProf.getuser');
//ログインしているユーザー情報を取得するAPI
Route::get('/user', fn() => Auth::user())->name('user');

//レポートを新規投稿するAPI
Route::post('/reports', 'ReportController@create')->name('report.create');

//レポート一覧を取得するAPI
Route::get('/reports', 'ReportController@index')->name('report.index');

//指定ユーザーのレポート一覧を取得するAPI
Route::get('/mypage/reports/{user_id}', 'ReportController@index')->name('report.mypage_index');

//レポート詳細取得
Route::get('/reports/{report_id}', 'ReportController@show')->name('report.show');
// レポートを削除
Route::delete('/reports/{report_id}', 'ReportController@destroy')->name('report.destroy');


//コメントの投稿
Route::post('/reports/{report}/comments', 'ReportController@addComment')->name('report.comment');



//トークンリフレッシュ
Route::get('/reflesh-token', function (Illuminate\Http\Request $request) {
  $request->session()->regenerateToken();
  
  return response()->json();
});
