<?php

namespace App\Http\Controllers;
use App\Models\Exam;
use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{
    public function index()
    {
        // تحميل الامتحانات مع النتائج والطلاب المرتبطين بكل نتيجة
        $exams = Exam::with('results.user')->get();
    
        return view('admin.results.index', compact('exams'));
    }
}

