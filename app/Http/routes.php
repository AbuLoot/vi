<?php

// Pages
Route::get('p/{page}', ['uses' => 'PagesController@page']);

// Board
Route::get('/', ['as' => 'index', 'uses' => 'BoardController@getCall']);
Route::get('uslugi_vyzova', ['as' => 'call', 'uses' => 'BoardController@getCall']);
Route::get('uslugi_vyzova/{section}/{id}', ['as' => 'show-call', 'uses' => 'BoardController@showCall']);
Route::get('1/{post}/{id}', ['as' => 'show-post-call', 'uses' => 'BoardController@showPostCall']);

Route::get('uslugi_remonta', ['as' => 'repair', 'uses' => 'BoardController@getRepair']);
Route::get('uslugi_remonta/{section}/{id}', ['as' => 'show-repair', 'uses' => 'BoardController@showRepair']);
Route::get('2/{post}/{id}', ['as' => 'show-post-repair', 'uses' => 'BoardController@showPostRepair']);

Route::get('stroymaterialy', ['as' => 'materials', 'uses' => 'BoardController@getMaterials']);
Route::get('stroymaterialy/{section}/{id}', ['as' => 'show-materials', 'uses' => 'BoardController@showMaterials']);
Route::get('3/{post}/{id}', ['as' => 'show-post-materials', 'uses' => 'BoardController@showPostMaterials']);

// Search tools
Route::get('search', ['uses' => 'BoardController@searchPosts']);
Route::get('filter', ['uses' => 'BoardController@filterPosts']);

// Profile
Route::get('profile/{id}', ['uses' => 'ProfileController@getProfile']);
Route::get('profiles', ['uses' => 'ProfileController@getProfiles']);

// Comment
Route::post('review', ['uses' => 'CommentController@saveReview']);
Route::post('comment', ['uses' => 'CommentController@saveComment']);

Route::group(['middleware' => 'auth'], function()
{
	Route::resource('posts', 'PostsController');

	Route::get('my_profile', ['uses' => 'ProfileController@getMyProfile']);
	Route::get('my_profile/edit', ['uses' => 'ProfileController@editMyProfile']);
	Route::post('my_profile/{id}', ['uses' => 'ProfileController@updateMyProfile']);

	Route::get('my_posts', ['uses' => 'ProfileController@getMyPosts']);

	Route::get('my_reviews', ['uses' => 'ProfileController@getMyReviews']);

	Route::get('my_setting', ['uses' => 'ProfileController@getMySetting']);
	Route::post('update_password', ['uses' => 'ProfileController@updatePassword']);
	Route::post('delete_account', ['uses' => 'ProfileController@deleteAccount']);
});

Route::group(['prefix' => 'admin', 'middleware' => 'role:admin'], function()
{
    Route::resource('users', 'AdminUsersController');
    Route::resource('section', 'AdminSectionController');
    Route::resource('posts', 'AdminPostsController');
    Route::resource('pages', 'AdminPagesController');
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\CustomAuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\CustomAuthController@postRegister');
Route::get('auth/confirm/{token}', 'Auth\CustomAuthController@confirm');

// Repeat confirm
Route::get('auth/repeat_confirm', 'Auth\CustomAuthController@getRepeat');
Route::post('auth/repeat_confirm', 'Auth\CustomAuthController@postRepeat');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');

// Route::get('create/roles', 'AdminController@createRoles');
// Route::post('post/admin', 'AdminController@postAdmin');