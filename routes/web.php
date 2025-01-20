<?php

use App\Http\Controllers\ChartDataController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TableDataController;
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

Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');


Route::get('/get-row1col1-data/{year}/{month}', [ChartDataController::class, 'row1col1Data']);
Route::get('/get-row1col2-data/{year}/{month}', [ChartDataController::class, 'row1col2Data']);
Route::get('/get-row3col1-data/{year}/{month}/{day}', [ChartDataController::class, 'row3col1Data']);
Route::get('/get-row3col2-data/{year}/{month}', [ChartDataController::class, 'row3col2Data']);
Route::get('/get-row4col1-data/{year}/{month}/{day}', [ChartDataController::class, 'row4col1']);



Route::get('/get-row2col1-data/{year}/{month}/{day}', [TableDataController::class, 'row2col1Data']);
Route::get('/get-row2col2-data/{year}/{month}/{day}', [TableDataController::class, 'row2col2Data']);
Route::get('/get-row2col3-data/{year}/{month}/{day}', [TableDataController::class, 'row2col3Data']);




