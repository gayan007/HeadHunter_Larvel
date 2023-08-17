<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VacancyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/clients', 'App\Http\Controllers\ClientController@index')->name('clients.index');
Route::get('/clients/{client}/vacancies', 'App\Http\Controllers\ClientController@vacancies')->name('clients.vacancies');
Route::get('/vacancies', 'App\Http\Controllers\VacancyController@index');
Route::get('/vacancies/{vacancy}/apply', 'App\Http\Controllers\VacancyController@showApplyForm')->name('vacancies.apply');
Route::post('/vacancies/{vacancy}/apply', 'App\Http\Controllers\VacancyController@apply')->name('vacancies.apply.submit');
Route::get('/reports/commission-in-pipeline', 'App\Http\Controllers\ReportController@commissionInPipeline')->name('reports.commissionInPipeline');