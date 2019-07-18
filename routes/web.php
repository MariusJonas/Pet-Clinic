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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'doctors'], function(){
    Route::get('', 'DoctorController@index')->name('doctor.index');
    Route::get('create', 'DoctorController@create')->name('doctor.create');
    Route::post('store', 'DoctorController@store')->name('doctor.store');
    Route::get('edit/{doctor}', 'DoctorController@edit')->name('doctor.edit');
    Route::post('update/{doctor}', 'DoctorController@update')->name('doctor.update');
    Route::post('delete/{doctor}', 'DoctorController@destroy')->name('doctor.destroy');
    Route::get('show/{doctor}', 'DoctorController@show')->name('doctor.show');
 });


 Route::group(['prefix' => 'pets'], function(){
    Route::get('', 'PetController@index')->name('pet.index');

    Route::post('', 'PetController@ajax')->name('pet.index');

    Route::get('sort/{order}', 'PetController@index')->name('pet.sort');

    Route::get('create', 'PetController@create')->name('pet.create');
    Route::post('store', 'PetController@store')->name('pet.store');
    Route::get('edit/{pet}', 'PetController@edit')->name('pet.edit');
    Route::post('update/{pet}', 'PetController@update')->name('pet.update');
    Route::post('delete/{pet}', 'PetController@destroy')->name('pet.destroy');
    Route::get('show/{pet}', 'PetController@show')->name('pet.show');
 });
 
