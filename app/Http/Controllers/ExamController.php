<?php

namespace App\Http\Controllers;
use App\Models\Result;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Answer;
use App\Models\UserAnswer;
use Illuminate\Http\Request;


class ExamController extends Controller
{
    public function index() {
        $exams = Exam::all();
        return view('exams.index', compact('exams'));
    }

    public function show(Exam $exam) {
        $questions = $exam->questions()->with('answers')->get();
        return view('exams.show', compact('exam', 'questions'));
    }

    public function submit(Request $request, Exam $exam)
    {
        $score = 0;
    
        foreach ($exam->questions as $question) {
            $selectedAnswerId = $request->input("answers")[$question->id] ?? null;
    
            if ($selectedAnswerId) {
                $selectedAnswer = Answer::where('id', $selectedAnswerId)
                                        ->where('question_id', $question->id)
                                        ->first();
    
                if ($selectedAnswer && $selectedAnswer->is_correct) {
                    $score += $question->score;
                }
    
                UserAnswer::create([
                    'user_id' => auth()->check() ? auth()->id() : null,
                    'exam_id' => $exam->id,
                    'question_id' => $question->id,
                    'answer_id' => $selectedAnswerId
                ]);
            }
        }
    
        // لا تتجاوز الدرجة الكلية
        $score = min($score, $exam->total_score);
    
        // ✅ تسجيل النتيجة
        if (auth()->check()) {
            Result::create([
                'user_id' => auth()->id(),
                'exam_id' => $exam->id,
                'score' => $score,
            ]);
        }
    
        return view('exams.result', compact('exam', 'score'));
    }
    
}
