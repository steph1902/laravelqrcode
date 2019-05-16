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
	return view('welcome');
});

Route::get('googlechart','GoogleAnalytics@googleChart');

Route::get('downloadcsv','GoogleAnalytics@export');
// Route::get('googlechart/{search}','GoogleAnalytics@googleChart');

Route::post('refreshchart','GoogleAnalytics@refreshChart');

Route::get('dashboard','Controller@dashboard')->middleware('auth');

Route::get('changepasswordpage','Controller@getChangePassPage')->name('Change Password Page')->middleware('auth');
Route::post('changepassword','Controller@changePassword')->name('Change Password')->middleware('auth');

Route::get('editurl/{id}','Controller@getEditUrlPage')->middleware('auth');
Route::post('editurl/{id}','Controller@editUrl')->middleware('auth');
// Route::post('/{id}','Controller@editUrl')->middleware('auth');

Route::get('downloadqr/{id}','Controller@downloadQrCode');


Route::get('statistic','Controller@getStatisticPage')->middleware('auth');

Route::get('googleanalytics','GoogleAnalytics@googleMagic');



Route::get('multiplechart','GoogleAnalytics@googleMultiChart');

// Route::get('googlestatistic','StatisticController@initiateAnalytics');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

// Route::get('dashboard', 
// 	function () {
// 		\QrCode::size(500)
// 		->format('svg')
            
// 		->generate('www.google.com', base_path().'qrcode'.'.svg');

// 		return view('qrCode');
// 	});

Route::get('addurlpage','Controller@getAddUrlPage')->middleware('auth');
Route::post('addurl','Controller@addUrl')->middleware('auth');


