<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NewsCategoryController;
use App\Http\Controllers\NewsController;
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

Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticate']);
Route::get('/home', [DashboardController::class, 'index']);

//news
Route::get('/listNews', [NewsController::class, 'newsList']);
Route::get('/addNews', [NewsController::class, 'addNews']);

//news category
Route::get('/newsCategory', [NewsCategoryController::class, 'index']);
Route::get('/newsCategory/getListDatatable', [NewsCategoryController::class, 'getListDatatable']);
Route::get('/newsCategory/getTable', [NewsCategoryController::class, 'getTable']);
