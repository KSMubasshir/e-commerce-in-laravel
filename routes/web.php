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
//FrontEnd Site
Route::get('/', 'HomeController@index');











//BackEnd Site
Route::get('/logout', 'SuperAdminController@logout');
Route::get('/admin', 'AdminController@index');
Route::get('/dashboard', 'AdminController@showDashboard');
Route::post('/admin-dashboard', 'AdminController@dashboard');




//Category
Route::get('/add-category', 'CategoryController@index');
Route::get('/all-category', 'CategoryController@all_category');
Route::post('/save-category', 'CategoryController@save_category');
Route::get('/inactive_category/{category_id}', 'CategoryController@inactive_category');
Route::get('/active_category/{category_id}', 'CategoryController@active_category');
