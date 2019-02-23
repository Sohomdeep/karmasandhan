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

//guest
Route::get('/', 'HomeController@index')->name('home');

//admin routes
Route::get('/cjad/', 'admin\dashboard_admin@index')->name('admin-index')->middleware('auth');
Route::group(['prefix' => 'cjad','namespace' => 'admin','middleware' => 'auth'], function () {
    Route::get('/home', 'dashboard_admin@index')->name('admin-dashboard');
    Route::get('/logout', 'dashboard_admin@logout_admin')->name('logout');

    //job
    Route::group(['prefix' => 'job','middleware' => 'auth'], function () {
    	Route::get('/list', 'job@job_list')->name('job-list');
    	Route::get('/add', 'job@job_add')->name('job-add');
    	Route::post('/do-add', 'job@do_job_add')->name('do-add-job');
        Route::get('/edit/{job_id?}', 'job@job_edit')->name('job-edit');
        Route::post('/do-edit', 'job@do_job_edit')->name('do-edit-job');
    });

    //master skill
    Route::group(['prefix' => 'skill','middleware' => 'auth'], function () {
    	Route::get('/list', 'skill@skill_list')->name('skill-list');
		Route::get('/add', 'skill@add_skill')->name('add-skill');
		Route::post('/do-add', 'skill@do_add_skill')->name('do-add-skill');
		Route::get('/edit/{skill_id?}', 'skill@edit_skill')->name('edit-skill');
		Route::post('/do-edit', 'skill@do_edit_skill')->name('do-edit-skill');		
		Route::get('/delete/{skill_id?}', 'skill@delete_skill')->name('delete-skill');
    	Route::get('/status-update', 'skill@update_status')->name('skill-status-update');
    });

    //master qualification
    Route::group(['prefix' => 'qualification','middleware' => 'auth'], function () {
    	Route::get('/list', 'qualification@qualification_list')->name('qualification-list');
		Route::get('/add', 'qualification@add_qualification')->name('add-qualification');
		Route::post('/do-add', 'qualification@do_add_qualification')->name('do-add-qualification');
		Route::get('/edit/{qualification_id?}', 'qualification@edit_qualification')->name('edit-qualification');
		Route::post('/do-edit', 'qualification@do_edit_qualification')->name('do-edit-qualification');		
		Route::get('/delete/{qualification_id?}', 'qualification@delete_qualification')->name('delete-qualification');
    	Route::get('/status-update', 'qualification@update_status')->name('qualification-status-update');
    });

    //master sector
    Route::group(['prefix' => 'sector','middleware' => 'auth'], function () {
    	Route::get('/list', 'sector@sector_list')->name('sector-list');
		Route::get('/add', 'sector@add_sector')->name('add-sector');
		Route::post('/do-add', 'sector@do_add_sector')->name('do-add-sector');
		Route::get('/edit/{sector_id?}', 'sector@edit_sector')->name('edit-sector');
		Route::post('/do-edit', 'sector@do_edit_sector')->name('do-edit-sector');		
		Route::get('/delete/{sector_id?}', 'sector@delete_sector')->name('delete-sector');
    	Route::get('/status-update', 'sector@update_status')->name('sector-status-update');
    });

    //master location
    Route::group(['prefix' => 'location','middleware' => 'auth'], function () {
    	Route::get('/list', 'location@location_list')->name('location-list');
		Route::get('/add', 'location@add_location')->name('add-location');
		Route::post('/do-add', 'location@do_add_location')->name('do-add-location');
		Route::get('/edit/{location_id?}', 'location@edit_location')->name('edit-location');
		Route::post('/do-edit', 'location@do_edit_location')->name('do-edit-location');		
		Route::get('/delete/{location_id?}', 'location@delete_location')->name('delete-location');
    	Route::get('/status-update', 'location@update_status')->name('location-status-update');
    });
});
