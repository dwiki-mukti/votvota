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

Route::group(['middleware' => 'guest'], function () {
	Route::resource('login', 'AuthController')->only(['index', 'store']);
	Route::resource('/main', 'ClientController')->only(['index', 'store']);
});

Route::group([
	'middleware' => 'auth',
], function () {
	# all
	Route::post('logout', 'AuthController@logout')->name('logout');

	# admin
	Route::group([
		'middleware' => ['roles:Admin'],
		'prefix' => '/admin'
	], function () {
		Route::get('/', fn () => redirect()->route('voting.index'));
		Route::post('/voting-action/{id}', 'VotingController@start')->name('voting.start');
		Route::delete('/voting-action/{id}', 'VotingController@end')->name('voting.end');

		Route::resource('/voting', 'VotingController')->except(['show']);
		Route::resource('/candidate', 'CandidateController')->except(['index', 'show']);
		Route::resource('/riwayat', 'HistoryController')->only(['index', 'show']);
	});

	# client
	Route::group(['middleware' => ['roles:Siswa']], function () {
		Route::resource('/main', 'ClientController')->only(['show', 'update']);
	});
});




Route::get('/', function () {
	switch (Auth::user()->role ?? null) {
		case 'Admin':
			return redirect()->route('voting.index');
			break;
		case 'Siswa':
			return redirect()->route('main.show', 'voting');
			break;
		default:
			Auth::logout();
			return redirect()->route('main.index');
			break;
	}
})->name('home');