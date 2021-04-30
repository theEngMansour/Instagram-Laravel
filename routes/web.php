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

Route::get('/', function () {
	if(Auth::check())
		return redirect('/');
	else
	    return view('auth/login');
});

Auth::routes();



Route::group(['middleware' => ['auth']], function() {  // اي عملية توجيه تتم بعد عملية تسجيل الدخول للمصادقة المستخدم 
	
	/* Auth */

	Route::get('user/profile','UserController@edit');

	Route::patch('user','UserController@update');

	/* Posts */

	Route::get('/home', 'PostController@index')->name('home');
	
	Route::resource('post','PostController');

	Route::get('user/posts','PostController@userPosts');
	
	Route::get('user/{id}/posts','PostController@userFriendPosts');

	/* Like */

	Route::resource('like','LikeController');

	/* Comment */

	Route::resource('comment','CommentController');

	/* Users */

	Route::get('users','UserController@index');

	Route::get('user_info/{id}/{name}','UserController@user_info');

	/* Follow */

	Route::resource('follow', 'FollowController');

	Route::get('user/followers','FollowController@index');

	/* Search */
	
	Route::get('search','UserController@autocomplete');

	Route::get('post/{id}/{name}','PostController@show');
});