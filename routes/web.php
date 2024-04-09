<?php

use Illuminate\Support\Facades\Route;

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



require __DIR__.'/auth.php';


 //==============================Translate all pages============================
 Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth']
    ], function () {



    Route::group(['namespace' => 'App\Http\Controllers\Companies'], function () {
        Route::resource('companies', 'CompanyController');
        Route::post('getCompanies', 'CompanyController@getCompanies')->name('getCompanies');    });

    Route::group(['namespace' => 'App\Http\Controllers\Employees'], function () {
        Route::resource('employees', 'EmployeeController');
        Route::post('getEmployees', 'EmployeeController@getEmployees')->name('getEmployees');    });

    });


    
