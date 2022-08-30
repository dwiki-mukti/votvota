<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Auth;
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


Route::get('/', fn () => redirect()->route('main.index'));
Route::group(['middleware' => 'guest'], function () {
	Route::resource('login', 'AuthController')->only(['index', 'store']);
});

Route::group([
	'middleware' => ['auth', 'roles:Admin'],
	'prefix' => '/admin'
], function () {
	Route::get('/', fn () => redirect()->route('voting.index'));
	Route::post('/voting-action/{id}', 'VotingController@start')->name('voting.start');
	Route::delete('/voting-action/{id}', 'VotingController@end')->name('voting.end');
	Route::post('logout', 'AuthController@logout')->name('logout');

	Route::resource('/voting', 'VotingController');
	Route::resource('/candidate', 'CandidateController')->except(['index', 'show']);
	Route::resource('/riwayat', 'HistoryController')->only(['index', 'show']);
});

Route::group(['middleware' => 'voter:guard'], function () {
	Route::resource('/main', 'ClientController')->only(['show', 'update', 'destroy']);
});

Route::group(['middleware' => 'voter:guest'], function () {
	Route::resource('/main', 'ClientController')->only(['index', 'store']);
});
