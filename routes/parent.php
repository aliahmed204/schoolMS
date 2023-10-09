<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\parent\dashboard\ChildrenController;
use App\Http\Controllers\parent\dashboard\ProfileController;
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
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' , 'auth:parent'],
] ,function() {
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Route::get('/parent/dashboard', [HomeController::class, 'parent_dashboard'])
        ->name('parent_dashboard');

    // Profile
    Route::group([
        'controller' => ChildrenController::class,
        'prefix' => 'parent/children',
        'as' => 'parent.children.',
    ],function (){
        Route::get('/','index')
            ->name('index');

        Route::get('/show/{student}','show')
            ->name('show');


        Route::post('/upload_attachment/{student}','upload_attachment')
            ->name('upload_attachment');
        Route::get('/download_attachment/{student_name}/{file_name}','download_attachment')
            ->name('download_attachment');

        // show student answers
        Route::get('/student_answers/{quiz}/{student}','student_answers')
            ->name('student_answers');

        // attendance reports
        Route::get('/attendance_reports','attendance_report')
            ->name('attendance_reports');

        Route::post('/attendance_search','attendance_search')
            ->name('attendance_search');


        // Fees
        Route::get('/fees','fees')
            ->name('fees');
        // student receipt
        Route::get('/receipt/{id}','receipt')
            ->name('receipt');

    });

    // Profile
    Route::group([
        'controller' => ProfileController::class,
        'prefix' => 'parent/profiles',
        'as' => 'parent.profiles.',
    ],function (){
        Route::get('/','index')
            ->name('index');

        Route::patch('/update/{id}','update')
            ->name('update');

    });

});
