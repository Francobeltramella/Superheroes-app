<?php

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

//Import Superheroes
Route::post('/importSuperheroes', [App\Http\Controllers\SuperheroeController::class, 'import'])->name('importExcelSuperheroes');

//Get all Superheroes API
Route::get('/superheroes', [App\Http\Controllers\SuperheroeController::class, 'getAllSuperheroes']);
Route::get('/superhero-fatest', [App\Http\Controllers\SuperheroeController::class, 'geThreeFastestSuperheroes']);
Route::get('/superhero-{race}', [App\Http\Controllers\SuperheroeController::class, 'getRaceSuperheroe']);
Route::get('/superhero-power', [App\Http\Controllers\SuperheroeController::class, 'getPowerfulSuperheroe']);



