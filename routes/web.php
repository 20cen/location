<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', 'DashController@index')->name('main.index')->middleware('auth');

Route::prefix('categorie')->group(function(){
    Route::get('/','CategorieController@index')->name('categorie.index')->middleware('auth');
    Route::post('store','CategorieController@store')->name('categorie.store')->middleware('auth');
    Route::get('/{id}/edit','CategorieController@edit')->name('categorie.edit')->middleware('auth');
    Route::put('/{id}/update','CategorieController@update')->name('categorie.update')->middleware('auth');
    Route::delete('/{id}/destroy','CategorieController@destroy')->name('categorie.destroy')->middleware('auth');
});

Route::prefix('client')->group(function(){
    Route::get('/','ClientController@index')->name('client.index')->middleware('auth');
    Route::post('store','ClientController@store')->name('client.store')->middleware('auth');
    Route::get('/{id}/edit','ClientController@edit')->name('client.edit')->middleware('auth');
    Route::put('/{id}/update','ClientController@update')->name('client.update')->middleware('auth');
    Route::delete('/{id}/destroy','ClientController@destroy')->name('client.destroy')->middleware('auth');
});

Route::prefix('location')->group(function(){
    Route::get('/','LocationController@index')->name('location.index')->middleware('auth');
    Route::post('store','LocationController@store')->name('location.store')->middleware('auth');
    Route::get('/{id}/edit','LocationController@edit')->name('location.edit')->middleware('auth');
    Route::put('/{id}/update','LocationController@update')->name('location.update')->middleware('auth');
    Route::post('changestate','LocationController@changestate')->name('location.changestate')->middleware('auth');
    Route::delete('/{id}/destroy','LocationController@destroy')->name('location.destroy')->middleware('auth');
});

Route::prefix('historique')->group(function(){
    Route::get('/','LocationController@historique')->name('historique.index')->middleware('auth');
    Route::post('activate','LocationController@activate')->name('historique.activate')->middleware('auth');
});

Route::prefix('materiel')->group(function(){
    Route::get('/','MaterielController@index')->name('materiel.index')->middleware('auth');
    Route::post('store','MaterielController@store')->name('materiel.store')->middleware('auth');
    Route::get('create','MaterielController@create')->name('materiel.create')->middleware('auth');
    Route::get('/{id}/edit','MaterielController@edit')->name('materiel.edit')->middleware('auth');
    Route::put('/{id}/update','MaterielController@update')->name('materiel.update')->middleware('auth');
    Route::delete('/{id}/destroy','MaterielController@destroy')->name('materiel.destroy')->middleware('auth');
});

Route::prefix('perte')->group(function(){
    Route::get('/','PerteController@index')->name('perte.index')->middleware('auth');
    Route::post('store','PerteController@store')->name('perte.store')->middleware('auth');
    Route::get('/{id}/edit','PerteController@edit')->name('perte.edit')->middleware('auth');
    Route::put('/{id}/update','PerteController@update')->name('perte.update')->middleware('auth');
    Route::delete('/{id}/destroy','PerteController@destroy')->name('perte.destroy')->middleware('auth');
});

Route::prefix('stock')->group(function(){
    Route::get('/','StockactuelController@index')->name('stock.index')->middleware('auth');
    Route::post('store','StockactuelController@store')->name('stock.store')->middleware('auth');
    Route::get('/{id}/edit','StockactuelController@edit')->name('stock.edit')->middleware('auth');
    Route::put('/{id}/update','StockactuelController@update')->name('stock.update')->middleware('auth');
    Route::delete('/{id}/destroy','StockactuelController@destroy')->name('stock.destroy')->middleware('auth');
});

Route::prefix('user')->group(function(){
    Route::get('/','UserController@index')->name('user.index')->middleware('auth');
    Route::post('store','UserController@store')->name('user.store')->middleware('auth');
    Route::get('/{id}/edit','UserController@edit')->name('user.edit')->middleware('auth');
    Route::get('/{id}/profil','UserController@profil')->name('user.profil')->middleware('auth');
    Route::put('/{id}/update','UserController@update')->name('user.update')->middleware('auth');
    Route::delete('/{id}/destroy','UserController@destroy')->name('user.destroy')->middleware('auth');
});

Route::prefix('tarif')->group(function(){
    Route::get('/','TarifController@index')->name('tarif.index')->middleware('auth');
    Route::post('store','TarifController@store')->name('tarif.store')->middleware('auth');
    Route::get('/{id}/edit','TarifController@edit')->name('tarif.edit')->middleware('auth');
    Route::put('/{id}/update','TarifController@update')->name('tarif.update')->middleware('auth');
});

Route::prefix('paiement')->group(function(){
    Route::get('/','PaiementController@index')->name('paiement.index')->middleware('auth');
    Route::post('store','PaiementController@store')->name('paiement.store')->middleware('auth');
    Route::get('/{id}/edit','PaiementController@edit')->name('paiement.edit')->middleware('auth');
    Route::put('/{id}/update','PaiementController@update')->name('paiement.update')->middleware('auth');
});

Route::prefix('type')->group(function(){
    Route::get('/','TypelocationController@index')->name('type.index')->middleware('auth');
});

Auth::routes();

Route::get('/home', 'DashController@index')->name('main.index')->middleware('auth');
