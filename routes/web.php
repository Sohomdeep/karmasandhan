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

/*Route::get('/', function () {
    return view('welcome');
});*/

Auth::routes();

Route::group(['namespace' => 'admin'], function () {
    Route::get('/cjad', 'dashboard_admin@index')->name('dashboard')->middleware('auth');
    Route::get('/cjad/home', 'dashboard_admin@index')->name('home')->middleware('auth');
    Route::get('/logout', 'dashboard_admin@logout_admin')->name('logout');


    Route::group(['prefix' => 'job','middleware' => 'auth'], function () {
    	Route::get('/list', 'job@job_list')->name('job-list');
    	Route::get('/add', 'job@job_add')->name('job-add');
    	Route::get('/do-add', 'job@do_job_add')->name('do-add-job');
    });

  
});

//Route::get('/home', 'HomeController@index')->name('home');
