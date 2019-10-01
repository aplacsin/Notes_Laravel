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
Route::delete('image/{id}/destroy', 'NotesController@destroyImage')->name('image.destroy');

Route::get('notes/export','NotesController@export')->name('notes.export');

Route::get('notes/getexport','NotesController@getexport')->name('notes.getexport');

Route::get('notes/import','NotesController@import')->name('notes.import');

Route::post('notes/import','NotesController@get_import')->name('notes.get_import');

Route::resource('notes','NotesController');

