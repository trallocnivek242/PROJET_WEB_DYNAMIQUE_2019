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
    //$req = DB::table('test')->where('id', 2)->first();
    //$db = $req->nom;
    $db1 = DB::table('test')->where('id', 1)->first();
    $db2 = DB::table('test')->where('id', 2)->first();
    $db = [$db2->id . ' => ' . $db2->nom, $db1->id . ' => '. $db1->nom];
    return view('welcome', ['db_kc' => $db]);
});
Route::get('/', function () {
    return view('labo');
});
Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('users', 'GestUserController@view')->name('GestUsers.view');
    Route::get('users/Add', 'GestUserController@create')->name('GestUsers.create');
    Route::post('users/Add', 'GestUserController@store')->name('GestUsers.store');
    Route::resource('ville', 'VilleController');
    Route::resource('user', 'UserController');
});


Route::get('/home', 'HomeController@index')->name('home');
