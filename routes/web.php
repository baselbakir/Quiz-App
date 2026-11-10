<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\ResultController;

Route::get('/', function () {
    return redirect()->route('login');
});

// -----------------------------
// للمستخدمين العاديين (طلاب)
// -----------------------------

Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

Route::get('/exams', [ExamController::class, 'index'])->name('exams.index');
Route::get('/exams/{exam}', [ExamController::class, 'show']);
Route::post('/submit-exam/{exam}', [ExamController::class, 'submit']);
Route::get('/exam/{exam}/result', [ExamController::class, 'showResult']);

// -----------------------------
// للمشرفين فقط (admin)
// -----------------------------

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

// الامتحانات
Route::get('/admin/exams', [AdminController::class, 'indexExam'])->name('admin.exams.index');
Route::get('/admin/exams/create', [AdminController::class, 'createExam'])->name('admin.exams.create');
Route::post('/admin/exams', [AdminController::class, 'storeExam'])->name('admin.exams.store');
Route::get('/admin/exams/{exam}/edit', [AdminController::class, 'editExam'])->name('admin.exams.edit');
Route::put('/admin/exams/{exam}', [AdminController::class, 'updateExam'])->name('admin.exams.update');
Route::delete('/admin/exams/{exam}', [AdminController::class, 'deleteExam'])->name('admin.exams.delete');
Route::get('/admin/exams/manage', [AdminController::class, 'manageExams'])->name('admin.exams.manage');
Route::get('/admin/exams/{exam}/edit-questions', [AdminController::class, 'editQuestions'])->name('admin.exams.edit-questions');

// الأسئلة
Route::get('/admin/exams/{exam}/questions/create', [AdminController::class, 'createQuestion'])->name('admin.questions.create');
Route::post('/admin/exams/{exam}/questions/store', [AdminController::class, 'storeQuestion'])->name('admin.questions.store');
Route::get('/admin/questions/{question}/edit', [AdminController::class, 'editSingleQuestion'])->name('admin.questions.edit');
Route::put('/admin/questions/{question}/update', [AdminController::class, 'updateQuestion'])->name('admin.questions.update');
Route::delete('/admin/questions/{question}/delete', [AdminController::class, 'deleteQuestion'])->name('admin.questions.delete');

// النتائج
Route::get('/admin/results', [ResultController::class, 'index'])->name('admin.results.index');

// إنشاء مسؤول / طالب
Route::get('/admin/create', [AdminController::class, 'createAdminForm'])->name('admin.create.form');
Route::post('/admin/create', [AdminController::class, 'createAdmin'])->name('admin.create');
Route::get('/admin/create-student', [AdminController::class, 'createStudentForm'])->name('admin.student.create.form');
Route::post('/admin/create-student', [AdminController::class, 'createStudent'])->name('admin.student.create');

// عرض الطلاب
Route::get('/admin/students', [AdminController::class, 'listStudents'])->name('admin.students.index');

require __DIR__.'/auth.php';
