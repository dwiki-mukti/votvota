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


Route::group(['middleware'=>'guest'], function () {
	Route::resource('login', 'AuthController')->only(['index', 'store']);
});


// 'middleware'=>'auth'
Route::group([], function () {
	Route::resource('/voting', 'VotingController')->except(['show']);
	Route::post('/voting-action/{id}', 'VotingController@start')->name('voting.start');
	Route::delete('/voting-action/{id}', 'VotingController@end')->name('voting.end');
	
	Route::resource('/candidate', 'CandidateController')->except([ 'index', 'show']);


	Route::post('logout', 'AuthController@logout')->name('logout');
});




