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

// frontend
Route::get('/', 'frontendController@index')->name('home');
Route::post('/', 'frontendController@vote');
Route::put('/', 'frontendController@validasi');


Auth::routes();
Route::group(['middleware'=>'auth'], function () {

	// akun
	Route::get('/manage-account', 'AuthController@edit');
	Route::post('/manage-account', 'AuthController@prosesedit');

	// home
	Route::get('/admin', 'VotingController@index');
	Route::post('/admin', 'VotingController@create');
	Route::put('/admin', 'VotingController@edit');
	Route::delete('/admin', 'VotingController@delete');
	Route::post('/start-voting', 'VotingController@start');
	Route::post('/stop-voting', 'VotingController@stop');
	Route::get('/{id}/belum-memilih', 'VotingController@golput');

	// kandidat
	Route::get('/kandidat', function(){
		return view('kandidat/create_kandidat');
	});
	Route::get('/live', 'KandidatController@search');
	Route::get('/kandidat/{id}', 'KandidatController@edit');
	Route::post('/kandidat', 'KandidatController@store');
	Route::put('/kandidat', 'KandidatController@prosesedit');
	Route::delete('/kandidat', 'KandidatController@delete');


	// siswa
	Route::get('/siswa', 'StudentController@index');
	Route::get('/tambah_siswa', function () {
	    return view('siswa.create_siswa');
	});
	Route::post('/tambah_siswa', 'StudentController@store');
	Route::get('/edit_siswa/{id}', 'StudentController@edit');
	Route::post('/edit_siswa/{id}', 'StudentController@prosesedit');
	Route::delete('/siswa', 'StudentController@delete')->name('hapus');


	// history
	Route::get('/history', 'HistoryController@index');
	Route::get('/detail_history/{id}', 'HistoryController@detail');


});








// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/aku', function () {
//     return view('coba');
// });

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
