<?php

namespace App\Livewire;

use App\Models\Degree;
use App\Models\Question;
use Livewire\Component;

class ExamQuestion extends Component
{
    public $quiz_id , $student_id , $data ,
        $counter=0 , $total =0 , $questioncount ,
        $timeLimit=30 , $timer; // time to finish quiz automatic

    public function mount(){
        $this->timer = now()->addSeconds($this->timeLimit);
    }

    public function render()
    {
        $this->data = Question::where('quiz_id', $this->quiz_id)->get();
        $this->questioncount = $this->data->count();
        return view('livewire.exam-question');
    }

    public function nextQuestion($question_id , $score , $answer , $right_answer)
    {
        $stuDegree = Degree::where('student_id', $this->student_id)
            ->where('quiz_id', $this->quiz_id)
            ->latest()->first();

        if (now() >= $this->timer) {
            $stuDegree->UpdateOrCreate([
                'quiz_id'     => $this->quiz_id,
                'student_id'  => $this->student_id,
                'question_id' => $question_id,
                'score'       => $this->total,
                'answer'      => $answer,
                'date'        => date('Y-m-d,H:i:s'),
            ]);
            session()->flash(' تم انتهاء الأمتحان لتجاوز المدة المسوحة ');
            return redirect()->route('student.exams.index');
        }
        // insert
        if (strcmp(trim($answer), trim($right_answer)) === 0) {
            $this->total += $score;
        } else {
            $this->total += 0;
        }

        if ($stuDegree == null) {
             Degree::create([
                'quiz_id'     => $this->quiz_id,
                'student_id'  => $this->student_id,
                'question_id' => $question_id,
                'score'       => $this->total,
                'answer'       => $answer,
                'date'        => date('Y-m-d,H:i:s'),
            ]);
        } else {
                    //لو حاول التلاعب فى الأمتحان هيتلغى يمكن للمدرس يخلى الطالب يكمل
           if ($stuDegree->question_id >= $this->data[$this->counter]->id) {
               $stuDegree->update([
                       'score'  => '0' ,
                       'abuse'  => '1',
                   ]);

               session()->flash('تم إلغاء الاختبار لإكتشاف تلاعب بالنظام');
               return redirect()->route('student.exams.index');
           }
              // update
            $stuDegree->create([
                'quiz_id'     => $this->quiz_id,
                'student_id'  => $this->student_id,
                'question_id' => $question_id,
                'score'       => $this->total,
                'answer'      => $answer,
                'date'        => date('Y-m-d,H:i:s'),
            ]);

        }

        //  in array last-element= index-1
        if ($this->counter < $this->questioncount - 1) {
            $this->counter++;
        } else {
            session()->flash('success1', 'تم إجراء الاختبار بنجاح');
            return redirect()->route('student.exams.index');
        }

        // update time after each question
        $this->timer = now()->addSeconds($this->timeLimit);

    }

    public function finishExam()
    {
        // Handle the logic to finish the exam here
        // This could include saving the current progress, displaying results, etc.
        session()->flash('examFinished', 'The exam has ended.');
        // Redirect the student to the index route for student exams
        return redirect()->route('student.exams.index');
    }


}
