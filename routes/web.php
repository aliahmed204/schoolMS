<?php

use App\Http\Controllers\Attendance\AttendanceController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClassRoom\ClassRoomController;
use App\Http\Controllers\Fee\FeeController;
use App\Http\Controllers\FeeInvoices\FeeInvoiceController;
use App\Http\Controllers\Grades\GradeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\library\LibraryController;
use App\Http\Controllers\onlineClasses\OnlineClassController;
use App\Http\Controllers\PaymentStudent\PaymentStudentController;
use App\Http\Controllers\ProcessingFee\ProcessingFeeController;
use App\Http\Controllers\question\QuestionController;
use App\Http\Controllers\quiz\QuizController;
use App\Http\Controllers\Receipt\ReceiptStudentController;
use App\Http\Controllers\sections\SectionController;
use App\Http\Controllers\settings\SettingController;
use App\Http\Controllers\students\GraduatedController;
use App\Http\Controllers\students\PromotionController;
use App\Http\Controllers\students\StudentController;
use App\Http\Controllers\subject\SubjectController;
use App\Http\Controllers\Teachers\TeacherController;

use Illuminate\Support\Facades\Auth;
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
/*Auth::routes();*/

/*Route::group(['middleware' => 'guest'], function (){
    Route::get('/login', 'LoginController@index');
});*/

/*Route::get('/', function () {
    return view('auth.login');
})->withoutMiddleware('auth')
    ->middleware('guest');*/

Route::get('/',[HomeController::class,'index'])->name('selection')->middleware('guest');


// this route For LiveWire Calendar
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' , 'auth:web,teacher'],
] ,function() {
    Livewire::setUpdateRoute(function ($handle) {
        return Route::post('/custom/livewire/update', $handle);
    });
});


Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' , 'auth'],
] ,function() {
    /** ADD ALL LOCALIZED ROUTES INSIDE THIS GROUP **/

    Route::get('/',[HomeController::class,'index'])->name('selection')->withoutMiddleware('auth')->middleware('guest');
    Route::group([
        'controller' => LoginController::class,
    ],function (){
        Route::get('/login/{type}','loginForm')->name('login.loginForm')->withoutMiddleware('auth')->middleware('guest');
        Route::post('/login/{type}','login')->name('login')->withoutMiddleware('auth')->middleware('guest');
    });

    Route::get('/dashboard',[HomeController::class,'dashboard'])->name('dashboard');
    Route::post('/logout/{type}',[LoginController::class,'logout'])
        ->name('logout')
        ->withoutMiddleware('auth');


    // Grades
    Route::group([
        'controller' => GradeController::class,
        'prefix' => 'grades',
        'as' => 'grades.',
    ],function (){
        Route::get('/','index')->name('index');

        Route::post('/','store')->name('store');

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

        Route::post('/','store')
            ->name('store');

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

    // Student_parents - [using liveWire] for localization
    /*Livewire::setUpdateRoute(function ($handle) {
        return Route::post('/custom/livewire/update', $handle);
    });*/

    // Parents live-wire
    Route::view('AddParent','livewire.show_form')
        ->name('AddParent_Form');

// Teachers
    Route::group([
        'controller' => TeacherController::class,
        'prefix' => 'teachers',
        'as' => 'teachers.',
    ],function (){
        Route::get('/','index')
            ->name('index');

        Route::get('/create','create')
            ->name('create');

        Route::post('/','store')
            ->name('store');

        Route::get('/{teacher}/edit','edit')
            ->name('edit')
            ->whereNumber('teacher');
        Route::patch('/{teacher}','update')
            ->name('update')
            ->whereNumber('teacher');

        Route::delete('/{teacher}','destroy')
            ->name('destroy')
            ->whereNumber('teacher');

    });

    // Students
    Route::group([
        'controller' => StudentController::class,
        'prefix' => 'students',
        'as' => 'students.',
    ],function (){
        Route::get('/','index')
            ->name('index');


        Route::get('/create','create')
            ->name('create');

        Route::post('/','store')
            ->name('store');

        Route::get('/{student}/show','show')
            ->name('show');

        Route::post('/upload_attachment/{student}','upload_attachment')
            ->name('upload_attachment');
        Route::get('/download_attachment/{student_name}/{file_name}','download_attachment')
            ->name('download_attachment');
        Route::delete('/delete_attachment/{image}','delete_attachment')
            ->name('delete_attachment');

        Route::get('/{student}/edit','edit')
            ->name('edit')
            ->whereNumber('teacher');
        Route::patch('/{student}','update')
            ->name('update')
            ->whereNumber('teacher');

        Route::delete('/{student}','destroy')
            ->name('destroy')
            ->whereNumber('teacher');

    });

    // Promotions
    Route::group([
        'controller' => PromotionController::class,
        'prefix' => 'promotions',
        'as' => 'promotions.',
    ],function (){
        Route::get('/','index')
            ->name('index');

        Route::get('/showAll','showAll')
            ->name('showAll');

        Route::delete('/rollbackPromotion','rollbackPromotion')
            ->name('rollbackPromotion');
        Route::delete('/rollbackStudentPromotion/{promotion}','rollbackStudentPromotion')
            ->name('rollbackStudentPromotion');

        Route::post('/','store')
            ->name('store');

    });
    // Graduated
    Route::group([
        'controller' => GraduatedController::class,
        'prefix' => 'graduated',
        'as' => 'graduated.',
    ],function (){
        Route::get('/','index')
            ->name('index');

        Route::get('/create','create')
            ->name('create');

        //Graduate Group Of Student
        Route::delete('/softDelete','softDelete')
            ->name('softDelete');

        Route::delete('/studentSoftDelete/{student}','studentSoftDelete')
            ->name('studentSoftDelete');

        Route::delete('/destroy/{id}','destroy')
            ->name('destroy');
        Route::patch('/restore/{id}','restore')
            ->name('restore');
    });

    // Fees
    Route::group([
        'controller' => FeeController::class,
        'prefix' => 'fees',
        'as' => 'fees.',
    ],function (){
        Route::get('/','index')
            ->name('index');

        Route::get('/create','create')
            ->name('create');

        Route::post('/store','store')
                    ->name('store');

        Route::get('/edit{fee}','edit')
                    ->name('edit');

        Route::patch('/update{fee}','update')
                    ->name('update');

        Route::delete('/destroy/{id}','destroy')
            ->name('destroy');

    });
    // Fee-Invoices
    Route::group([
        'controller' => FeeInvoiceController::class,
        'prefix' => 'feeInvoices',
        'as' => 'feeInvoices.',
    ],function (){
        Route::get('/','index')
            ->name('index');

        Route::get('/invoice_create/{id}','invoice_create')
            ->name('invoice_create');

       Route::post('/store','store')
            ->name('store');

        Route::get('/edit/{feeInvoice}','edit')
           ->name('edit');

       Route::patch('/update/{feeInvoice}','update')
           ->name('update');

       Route::delete('/destroy/{feeInvoice}','destroy')
           ->name('destroy');

    });

    // Receipt-student
    Route::group([
        'controller' => ReceiptStudentController::class,
        'prefix' => 'receiptStudents',
        'as' => 'receiptStudents.',
    ],function (){
        Route::get('/','index')
            ->name('index');

        Route::get('/create/{id}','create')
            ->name('create');

        Route::post('/store','store')
            ->name('store');

        Route::get('/edit/{receiptStudent}','edit')
            ->name('edit');

        Route::patch('/update/{receiptStudent}','update')
            ->name('update');

        Route::delete('/destroy/{receiptStudent}','destroy')
            ->name('destroy');

    });

    // ProcessingFee
    Route::group([
        'controller' => ProcessingFeeController::class,
        'prefix' => 'processingFees',
        'as' => 'processingFees.',
    ],function (){
        Route::get('/','index')
            ->name('index');

        Route::get('/create/{id}','create')
            ->name('create');

        Route::post('/store','store')
            ->name('store');

        Route::get('/edit/{processingFee}','edit')
            ->name('edit');

        Route::patch('/update/{processingFee}','update')
            ->name('update');

        Route::delete('/destroy/{processingFee}','destroy')
            ->name('destroy');

    });
    // Payment
    Route::group([
        'controller' => PaymentStudentController::class,
        'prefix' => 'paymentStudents',
        'as' => 'paymentStudents.',
    ],function (){
        Route::get('/','index')
            ->name('index');

        Route::get('/create/{id}','create')
            ->name('create');

        Route::post('/store','store')
            ->name('store');

        Route::get('/edit/{paymentStudent}','edit')
            ->name('edit');

        Route::patch('/update/{paymentStudent}','update')
            ->name('update');

        Route::delete('/destroy/{paymentStudent}','destroy')
            ->name('destroy');

    });

    // Subjects
    Route::group([
        'controller' => SubjectController::class,
        'prefix' => 'subjects',
        'as' => 'subjects.',
    ],function (){
        Route::get('/','index')
            ->name('index');

        Route::get('/create','create')
            ->name('create');

        Route::post('/store','store')
            ->name('store');

        Route::get('/edit/{subject}','edit')
            ->name('edit');

        Route::patch('/update/{subject}','update')
            ->name('update');

        Route::delete('/destroy/{subject}','destroy')
            ->name('destroy');
    });

    // Exams
    Route::group([
        'controller' => quizController::class,
        'prefix' => 'quizzes',
        'as' => 'quizzes.',
    ],function (){
        Route::get('/','index')
            ->name('index');

        Route::get('/create','create')
            ->name('create');

        Route::post('/store','store')
            ->name('store');

        Route::get('/edit/{quiz}','edit')
            ->name('edit');

        Route::patch('/update/{quiz}','update')
            ->name('update');

        Route::delete('/destroy/{quiz}','destroy')
            ->name('destroy');
    });

    // Questions
    Route::group([
        'controller' => QuestionController::class,
        'prefix' => 'questions',
        'as' => 'questions.',
    ],function (){
        Route::get('/','index')
            ->name('index');

        Route::get('/create','create')
            ->name('create');

        Route::post('/store','store')
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
        'prefix' => 'onlineClasses',
        'as' => 'onlineClasses.',
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

    //Library
    Route::group([
        'controller' => LibraryController::class,
        'prefix' => 'library',
        'as' => 'library.',
    ],function (){
        Route::get('/','index')
            ->name('index');

        Route::get('/create','create')
            ->name('create');

        Route::post('/store','store')
            ->name('store');

        Route::get('/edit/{library}','edit')
            ->name('edit');

        Route::patch('/update/{library}','update')
            ->name('update');

        Route::get('/downloadAttachment/{file_title}/{file_name}','downloadAttachment')
            ->name('downloadAttachment');

        Route::delete('/destroy/{library}','destroy')
            ->name('destroy');

    });

    //Attendance
    Route::group([
        'controller' =>AttendanceController::class,
        'prefix' => 'attendances',
        'as' => 'attendances.',
    ],function (){

        Route::get('/','index')
            ->name('index');

        // show section and it's students
        Route::get('/show/{id}','show')
            ->name('show');

        Route::post('/store/{id}','store')
            ->name('store');

        Route::get('/edit/{attendance}','edit')
            ->name('edit');

        Route::patch('/update/{attendance}','update')
            ->name('update');


        Route::delete('/destroy/{attendance}','destroy')
            ->name('destroy');

    });

    //Setting
    Route::group([
        'controller' => SettingController::class,
        'prefix' => 'settings',
        'as' => 'settings.',
    ],function (){
        Route::get('/','index')
            ->name('index');

        Route::patch('/update','update')
            ->name('update');

    });

});
