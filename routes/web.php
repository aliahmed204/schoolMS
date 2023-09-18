<?php

use App\Http\Controllers\ClassRoom\ClassRoomController;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\sections\SectionController;
use App\Livewire\CLicker;
use Illuminate\Support\Facades\Auth;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
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


Auth::routes();

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' , 'auth'],
] ,function() {
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Route::get('/', function () {
        return view('auth.login');
    })->withoutMiddleware('auth')
        ->middleware('guest');

    Route::get('/dashboard',[HomeController::class,'index'])->name('dashboard');

    // Grades
    Route::group([
        'controller' => GradeController::class,
        'prefix' => 'grades',
        'as' => 'grades.',
    ],function (){
        Route::get('/','index')->name('index');

        Route::post('/','store')->name('store');

        //Route::get('/{grade}','show')->name('show');

        Route::get('/{grade}/edit','edit')->name('edit')
            ->whereNumber('grade');
        Route::put('/{grade}','update')->name('update')
            ->whereNumber('grade');

        Route::delete('/{grade}','destroy')->name('destroy')
            ->whereNumber('grade');


    });

    // ClassRooms
    Route::group([
        'controller' => ClassRoomController::class,
        'prefix' => 'classRooms',
        'as' => 'classRooms.',
    ],function (){
        Route::get('/','index')
            ->name('index');
        Route::post('/','store')
            ->name('store');
        //Route::get('/{classRoom}','show')->name('show');
        Route::get('/{classRoom}/edit','edit')
            ->name('edit')
            ->whereNumber('classRoom');
        Route::put('/{classRoom}','update')
            ->name('update')
            ->whereNumber('classRoom');

        Route::delete('/{classRoom}','destroy')
            ->name('destroy')
            ->whereNumber('classRoom');

        Route::get('/filterClasses','filterClasses')
            ->name('filterClasses');

        Route::post('/delete_all','delete_all')
            ->name('delete_all');
    });


    // Sections
    Route::group([
        'controller' => SectionController::class,
        'prefix' => 'sections',
        'as' => 'sections.',
    ],function (){
        Route::get('/','index')
            ->name('index');

        /* FOR AJAX */
        Route::get('/getClasses/{id}','getClasses')
            ->name('getClasses');

        Route::post('/','store')
            ->name('store');
        //Route::get('/{classRoom}','show')->name('show');
        Route::get('/{section}/edit','edit')
            ->name('edit')
            ->whereNumber('classRoom');
        Route::put('/{section}','update')
            ->name('update')
            ->whereNumber('classRoom');

        Route::delete('/{section}','destroy')
            ->name('destroy')
            ->whereNumber('classRoom');

        Route::post('/filterClasses','filterClasses')
            ->name('filterClasses');

        Route::post('/delete_all','delete_all')
            ->name('delete_all');
    });

    Livewire::setUpdateRoute(function ($handle) {
        return Route::post('/custom/livewire/update', $handle);
    });

    Route::view('AddParent','livewire.show_form')
        ->name('AddParent_Form');




});
