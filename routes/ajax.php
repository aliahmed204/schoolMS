<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' , 'auth:web,teacher'],
] ,function() {
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/

    Route::group([
        'controller' => AjaxController::class,
        'prefix' => 'ajax',
        'as' => 'ajax.',
    ],function (){

        /* FOR AJAX */
        Route::get('/getClasses/{id}','getClasses')
            ->name('getClasses');
        /* FOR AJAX */
        Route::get('/getSections/{id}','getSections')
            ->name('getSections');

    });

});
