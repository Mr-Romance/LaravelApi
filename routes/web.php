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

// 首页
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('');
});

Route::get('/home', 'HomeController@index')->name('home');

/**
 *  数据库相关辅助路由
 *
 *  修改表，增加初始化数据等
 */
Route::get('seed_category','DBHelperController@seed_category');
Route::get('alert_user','DBHelperController@alert_users_table');

/**
 *  登录和注册
 */
Route::get('/register', 'Auth\RegisterController@showRegister');
Route::post('/register', 'Auth\RegisterController@register')->name('register');
Route::get('/login', 'Auth\LoginController@showLogin');
Route::post('/login', 'Auth\LoginController@login')->name('login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::middleware([ 'auth' ])->group(function () {
    /**
     *  用户相关路由
     */
    Route::prefix('users')->group(function(){
        Route::get('/add_table_column', 'UsersController@upd_users_table');
        Route::get('/show/{user}', 'UsersController@show');
        Route::get('/edit/{user}', 'UsersController@showEditUser');
        Route::post('/edit','UsersController@editUser');
    });

    /**
     *  话题相关路由
     */
    Route::prefix('topics')->group(function(){
        Route::get('/list','TopicsController@topicsList')->name('topics-list');

    });
});

