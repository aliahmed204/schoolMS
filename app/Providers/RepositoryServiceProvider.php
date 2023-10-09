<?php

namespace App\Providers;


use App\Interfaces\Attendance\AttendanceRepositoryInterface;
use App\Interfaces\Class\ClassRoomRepositoryInterface;
use App\Interfaces\Grade\GradeRepositoryInterface;
use App\Interfaces\library\LibraryRepositoryInterface;
use App\Interfaces\onlineClass\OnlineClassRepositoryInterface;
use App\Interfaces\question\questionRepositoryInterface;
use App\Interfaces\Quiz\quizRepositoryInterface;
use App\Interfaces\feesRepositoryInterface;
use App\Interfaces\invoiceFeesRepositoryInterface;
use App\Interfaces\PaymentStudentRepositoryInterface;
use App\Interfaces\ProcessingFeeRepositoryInterface;
use App\Interfaces\ReceiptStudentRepositoryInterface;
use App\Interfaces\Section\SectionRepositoryInterface;
use App\Interfaces\StudentGraduatedRepositoryInterface;
use App\Interfaces\StudentPromotionRepositoryInterface;
use App\Interfaces\StudentRepositoryInterface;
use App\Interfaces\subjects\subjectRepositoryInterface;
use App\Interfaces\TeacherRepositoryInterface;
use App\Repositories\Attendance\AttendanceRepository;
use App\Repositories\Class\ClassRoomRepository;
use App\Repositories\Grade\GradeRepository;
use App\Repositories\library\LibraryRepository;
use App\Repositories\onlineClass\OnlineClassRepository;
use App\Repositories\question\questionRepository;
use App\Repositories\quiz\quizRepository;
use App\Repositories\fees\feesRepository;

use App\Repositories\invoices\invoiceFeesRepository;
use App\Repositories\paymentStudent\PaymentStudentRepository;
use App\Repositories\processing\ProcessingFeeRepository;
use App\Repositories\ReceiptStudentRepository;
use App\Repositories\Section\SectionRepository;
use App\Repositories\StudentGraduatedRepository;
use App\Repositories\StudentPromotionRepository;
use App\Repositories\StudentRepository;
use App\Repositories\subject\subjectRepository;
use App\Repositories\TeacherRepository;

// Teacher Dashboard
use App\Interfaces\teacherDashboard\Quiz\quizRepositoryInterface as TeacherQuizRepositoryInterface;
use App\Repositories\teacher_dashboard\quiz\quizRepository as TeacherQuizRepository;

use App\Interfaces\teacherDashboard\question\questionRepositoryInterface as TeacherQuestionRepositoryInterface ;
use App\Repositories\teacher_dashboard\question\questionRepository as TeacherQuestionRepository ;

use App\Interfaces\teacherDashboard\onlineClass\OnlineClassRepositoryInterface as TeacherOnlineClassRepositoryInterface;
use App\Repositories\teacher_dashboard\onlineClass\OnlineClassRepository as TeacherOnlineClassRepository;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(GradeRepositoryInterface::class , GradeRepository::class);
        $this->app->bind(ClassRoomRepositoryInterface::class , ClassRoomRepository::class);
        $this->app->bind(SectionRepositoryInterface::class , SectionRepository::class);

        $this->app->bind(TeacherRepositoryInterface::class , TeacherRepository::class);
        $this->app->bind(StudentRepositoryInterface::class , StudentRepository::class);
        $this->app->bind(StudentPromotionRepositoryInterface::class , StudentPromotionRepository::class);
        $this->app->bind(StudentGraduatedRepositoryInterface::class , StudentGraduatedRepository::class);
        $this->app->bind(feesRepositoryInterface::class , feesRepository::class);
        $this->app->bind(invoiceFeesRepositoryInterface::class , invoiceFeesRepository::class);
        $this->app->bind(ReceiptStudentRepositoryInterface::class , ReceiptStudentRepository::class);
        $this->app->bind(ProcessingFeeRepositoryInterface::class , ProcessingFeeRepository::class);
        $this->app->bind(PaymentStudentRepositoryInterface::class , PaymentStudentRepository::class);
        $this->app->bind(subjectRepositoryInterface::class , subjectRepository::class);
        $this->app->bind(quizRepositoryInterface::class , quizRepository::class);
        $this->app->bind(questionRepositoryInterface::class , questionRepository::class);
        $this->app->bind(OnlineClassRepositoryInterface::class , OnlineClassRepository::class);
        $this->app->bind(LibraryRepositoryInterface::class , LibraryRepository::class);
        $this->app->bind(AttendanceRepositoryInterface::class , AttendanceRepository::class);
            // Teacher Dashboard
        $this->app->bind(TeacherQuizRepositoryInterface::class , TeacherQuizRepository::class);
        $this->app->bind(TeacherQuestionRepositoryInterface::class ,TeacherQuestionRepository ::class);
        $this->app->bind(TeacherOnlineClassRepositoryInterface::class ,TeacherOnlineClassRepository ::class);


    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
