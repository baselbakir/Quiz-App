<?php

namespace App\Http\Controllers;

use App\Models\Exam;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function createExam() {
        return view('admin.exams.create');
    }

    public function storeExam(Request $request) {
        $exam = Exam::create($request->only('title', 'duration_minutes', 'total_score'));
        return redirect("/admin/exams/{$exam->id}/questions/create");
    }

    public function createQuestion(Exam $exam) {
        $questions = $exam->questions()->with('answers')->get();
        return view('admin.questions.create', compact('exam', 'questions'));
    }
    

    public function storeQuestion(Request $request, Exam $exam)
    {
        $request->validate([
            'question_text' => 'required|string',
            'score' => 'required|numeric|min:1',
            'answers' => 'required|array|min:2',
            'correct_answer' => 'required|integer'
        ]);
    
        // حساب مجموع درجات الأسئلة الحالية
        $currentTotal = $exam->questions->sum('score');
    
        // تحقق أن مجموع الدرجات الجديدة لا يتجاوز الدرجة الكلية
        if ($currentTotal + $request->score > $exam->total_score) {
            return back()->with('error', 'درجة هذا السؤال تجعل مجموع درجات الامتحان يتجاوز الدرجة النهائية المحددة!');
        }
    
        // إنشاء السؤال
        $question = $exam->questions()->create([
            'question_text' => $request->question_text,
            'score' => $request->score
        ]);
    
        // حفظ الإجابات
        foreach ($request->answers as $index => $text) {
            $question->answers()->create([
                'answer_text' => $text,
                'is_correct' => $index == $request->correct_answer
            ]);
        }
    
        return back()->with('success', 'تم إضافة السؤال بنجاح!');
    }

    public function deleteQuestion(Question $question) {
        $question->answers()->delete();
        $question->delete();
        return back()->with('success', 'تم حذف السؤال بنجاح.');
    }
    
    public function manageExams()
    {
        $exams = Exam::withCount('questions')->get();
        return view('admin.exams.manage', compact('exams'));
    }
    
    public function editQuestions(Exam $exam)
    {
        $exam->load('questions.answers');
        return view('admin.questions.edit', compact('exam'));
    }
    
    public function updateQuestion(Request $request, Question $question)
    {
        $request->validate([
            'question_text' => 'required|string',
            'answers' => 'required|array|min:2',
            'correct_answer' => 'required|integer',
            'score' => 'required|numeric|min:1',
        ]);
    
        $exam = $question->exam;
    
        // احسب مجموع درجات الامتحان بدون هذا السؤال
        $currentTotal = $exam->questions->where('id', '!=', $question->id)->sum('score');
    
        // تحقق من أن الدرجة الجديدة لا تجعل المجموع يتجاوز الحد
        if ($currentTotal + $request->score > $exam->total_score) {
            return back()->with('error', 'درجة هذا السؤال تجعل مجموع درجات الامتحان يتجاوز الدرجة النهائية المحددة!');
        }
    
        // تحديث نص السؤال والدرجة
        $question->update([
            'question_text' => $request->question_text,
            'score' => $request->score,
        ]);
    
        // تحديث الإجابات
        foreach ($question->answers as $index => $answer) {
            $answer->update([
                'answer_text' => $request->answers[$index],
                'is_correct' => $index == $request->correct_answer
            ]);
        }
    
        return back()->with('success', 'تم تعديل السؤال بنجاح!');
    }
    
    public function deleteExam(Exam $exam)
    {
        $exam->delete();
        return back()->with('success', 'تم حذف الامتحان بنجاح');
    }
    
    public function editExam(Exam $exam)
{
    return view('admin.exams.edit', compact('exam'));
}

public function updateExam(Request $request, Exam $exam)
{
    $request->validate([
        'title' => 'required|string',
        'duration_minutes' => 'required|integer|min:1',
        'total_score' => 'required|numeric|min:1',
    ]);

    $exam->update([
        'title' => $request->title,
        'duration_minutes' => $request->duration_minutes,
        'total_score' => $request->total_score,
    ]);

    return redirect()->route('admin.exams.manage')->with('success', 'تم تحديث الامتحان بنجاح!');
}
public function editSingleQuestion(Question $question)
{
    $question->load('answers');
    return view('admin.questions.single_edit', compact('question'));
}

public function showResults()
{
    $exams = \App\Models\Exam::with(['users', 'results'])->get();
    return view('admin.results.index', compact('exams'));
}


public function createAdminForm()
{
    return view('admin.create_admin');
}

public function createAdmin(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:6',
    ]);

    \App\Models\User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 'admin',
    ]);

    return redirect()->back()->with('success', 'تم إنشاء المدير بنجاح');
}

public function createStudentForm()
{
    return view('admin.create_student');
}

public function createStudent(Request $request)
{
    $request->validate([
        'name' => 'required|string',
        'email' => 'required|email|unique:users',
        'password' => 'required|string|min:6',
    ]);

    \App\Models\User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => bcrypt($request->password),
        'role' => 'student',
    ]);

    return redirect()->back()->with('success', 'تم إنشاء الطالب بنجاح');
}

public function listStudents()
{
    $students = \App\Models\User::where('role', 'student')->get();
    return view('admin.students.index', compact('students'));
}
public function dashboard()
{
    // يمكن إضافة بيانات معروضات هنا
    return view('admin.dashboard');
}


}
