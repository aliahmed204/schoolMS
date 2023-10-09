<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Teachers\dashboard\OnlineClassController;
use App\Http\Controllers\Teachers\dashboard\ProfileController;
use App\Http\Controllers\Teachers\dashboard\QuestionController;
use App\Http\Controllers\Teachers\dashboard\QuizController;
use App\Http\Controllers\Teachers\dashboard\SectionController;
use App\Http\Controllers\Teachers\dashboard\StudentController;
use Illuminate\Http\Request;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Livewire\Livewire;

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
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' , 'auth:teacher'],
] ,function() {
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/
    Route::get('/teacher/dashboard', [HomeController::class, 'teacher_dashboard'])
        ->name('teacher_dashboard');


    // Students
    Route::group([
        'controller' => StudentController::class,
        'prefix' => 'teacher/students',
        'as' => 'teacher.students.',
    ],function (){
        Route::get('/','index')
            ->name('index');

        Route::post('/attendances','attendance')
            ->name('attendances');

        Route::get('/attendance_reports','attendance_report')
            ->name('attendance_reports');

        Route::post('/attendance_search','attendance_search')
            ->name('attendance_search');

    });

    // Sections
    Route::group([
        'controller' => SectionController::class,
        'prefix' => 'teacher/sections',
        'as' => 'teacher.sections.',
    ],function (){
        Route::get('/','index')
            ->name('index');

        Route::get('/{student}/show','show')
            ->name('show');

    });

    // Exams
    Route::group([
        'controller' => quizController::class,
        'prefix' => 'teacher/quizzes',
        'as' => 'teacher.quizzes.',
    ],function (){
        Route::get('/','index')
            ->name('index');

        Route::get('/create','create')
            ->name('create');

        Route::post('/store','store')
            ->name('store');

        Route::get('/edit/{quiz}','edit')
            ->name('edit');

        Route::get('/show/{quiz}','show')
            ->name('show');

        Route::patch('/update/{quiz}','update')
            ->name('update');

        Route::delete('/destroy/{quiz}','destroy')
            ->name('destroy');

            // show Exam Results
        Route::get('/student_finished/{quiz}','student_finished')
            ->name('student_finished');
             // show student answers
        Route::get('/student_answers/{quiz}/{student}','student_answers')
            ->name('student_answers');
         // repeat exam for student
        Route::delete('/repeat_quiz/{quiz}/{student}','repeat_quiz')
            ->name('repeat_quiz');

    });


    // Questions
    Route::group([
        'controller' => QuestionController::class,
        'prefix' => 'teacher/questions',
        'as' => 'teacher.questions.',
    ],function (){
        Route::get('/{id}','index')
            ->name('index');

        Route::get('/create/{id}','create')
            ->name('create');

        Route::post('/store/{id}','store')
            ->name('store');

        Route::get('/edit/{question}','edit')
            ->name('edit');

        Route::patch('/update/{question}','update')
            ->name('update');

        Route::delete('/destroy/{question}','destroy')
            ->name('destroy');
    });

    // Online-Courses [Zoom]
    Route::group([
        'controller' => OnlineClassController::class,
        'prefix' => 'teacher/onlineClasses',
        'as' => 'teacher.onlineClasses.',
    ],function (){
        Route::get('/','index')
            ->name('index');

        Route::get('/create','create')
            ->name('create');

        Route::post('/store','store')
            ->name('store');

        Route::delete('/destroy/{onlineClass}','destroy')
            ->name('destroy');
    });

    // Profile
    Route::group([
        'controller' => ProfileController::class,
        'prefix' => 'teacher/profiles',
        'as' => 'teacher.profiles.',
    ],function (){
        Route::get('/','index')
            ->name('index');

        Route::patch('/update/{id}','update')
            ->name('update');

    });


});
