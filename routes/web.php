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

//ログイン
Auth::routes();

//トップページ
Route::get('/', 'ItemController@top')->name('top');

//商品一覧
Route::get('/users/exhibitions', 'ItemController@exhibitions')->name('users.exhibitions');

//新規出品
Route::get('/items/create', 'ItemController@itemCreate')->name('items.create');

Route::post('/users/exhibitions', 'ItemController@store')->name('users.store');

//出品編集
Route::get('/items/{id}/edit', 'ItemController@edit')->name('items.edit');

Route::patch('/items/{id}', 'ItemController@update')->name('items.update');

//出品削除
Route::delete('items/{id}', 'ItemController@destroy')->name('items.destroy');

//画像変更処理
Route::get('/items/{id}/edit_image', 'ItemController@editImage')->name('items.edit_image');

Route::patch('/items/{id}/edit_image', 'ItemController@updateImage')->name('items.update_image');

//プロフィール
Route::get('/profiles', 'UserController@index')->name('profiles.index');

Route::get('/profiles/{id}/edit', 'UserController@edit')->name('profiles.edit');

Route::patch('/profiles/{id}', 'UserController@update')->name('profiles.update');

//プロフィール画像
Route::get('/profile/{id}/edit_image', 'UserController@editImage')->name('profiles.edit_image');

Route::patch('/profiles/{id}/edit_image', 'UserController@updateImage')->name('profiles.update_image');

//お気に入り
Route::patch('/items/{id}/toggle_like', 'ItemController@toggleLike')->name('items.toggleLike');

//お気に入り一覧
Route::get('/likes', 'LikeController@index')->name('likes.index');

//商品詳細
Route::get('/items/{id}', 'ItemController@show')->name('items.show');

//商品確認
Route::get('/items/{id}/confirm', 'OrderController@confirm')->name('items.confirm');

Route::post('/items/{id}/store', 'OrderController@store')->name('orders.store');

Route::get('items/{id}/finish', 'OrderController@finish')->name('items.finish');
