<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
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


Route::get('/', [App\Http\Controllers\UserController::class,'index']);
Route::resource('user', UserController::class);

Route::get('lang/{lang}', ['as' => 'lang.switch', 'uses' => 'App\Http\Controllers\LanguageController@switchLang']);
Auth::routes();

//Route::get('/languageDemo', [App\Http\Controllers\UserController::class,'languageDemo']);

//Route::get('/languageDemo', 'App\Http\Controllers\UserController@languageDemo');
