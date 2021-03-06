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
    return redirect()->route('products.index');
});
Route::get('/item', function (){
   return view('frontend.products.index');
});
Route::resource('users', 'UserController');
Route::resource('roles', 'RoleController');
Route::resource('products', 'ProductController');
Route::resource('permissions','PermissionController');
Route::resource('countries','CountryController');
Route::resource('categories','CategoryController');
Route::get('/search', ['uses' => 'ProductController@search', 'as' => 'search']);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
