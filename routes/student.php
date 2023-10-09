<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\students\dashboard\ExamController;
use App\Http\Controllers\students\dashboard\LibraryController;
use App\Http\Controllers\students\dashboard\OnlineClassController;
use App\Http\Controllers\students\dashboard\ProfileController;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
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
/*Livewire::setUpdateRoute(function ($handle) {
    return Route::post('/custom/livewire/update', $handle);
});*/
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' , 'auth:student'],
] ,function() {
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Route::get('/student/dashboard', [HomeController::class, 'student_dashboard'])
        ->name('student_dashboard');

// Profile
    Route::group([
        'controller' => ExamController::class,
        'prefix' => 'student/exams',
        'as' => 'student.exams.',
    ],function (){
        Route::get('/','index')
            ->name('index');

        Route::get('/show/{id}','show')
            ->name('show');

    });


    // Profile
    Route::group([
        'controller' => ProfileController::class,
        'prefix' => 'student/profiles',
        'as' => 'student.profiles.',
    ],function () {
        Route::get('/', 'index')
            ->name('index');


        Route::post('/upload_attachment/{student}','upload_attachment')
            ->name('upload_attachment');
        Route::get('/download_attachment/{student_name}/{file_name}','download_attachment')
            ->name('download_attachment');


        Route::patch('/update/{id}', 'update')
            ->name('update');
    });


    //Library
    Route::group([
        'controller' => LibraryController::class,
        'prefix' => 'student.library',
        'as' => 'student.library.',
    ],function (){
        Route::get('/','index')
            ->name('index');

        Route::get('/downloadAttachment/{file_title}/{file_name}','downloadAttachment')
            ->name('downloadAttachment');

    });

// Online-Courses [Zoom]
    Route::group([
        'controller' => OnlineClassController::class,
        'prefix' => 'student/onlineClasses',
        'as' => 'student.onlineClasses.',
    ],function (){
        Route::get('/','index')
            ->name('index');
    });


});
