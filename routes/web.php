<?php

use App\Http\Controllers\CountryListController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/countries',[CountryListController::class,'Chart1']);
Route::get('/continents',[CountryListController::class,'Chart2']);
Route::get('/continents2',[CountryListController::class,'Chart3']);

Route::get('/universities/{name}',[CountryListController::class,'Table1']);
Route::get('/univeofContinent',[CountryListController::class,'Table2']);
Route::get('/univeofall',[CountryListController::class,'Table3']);
