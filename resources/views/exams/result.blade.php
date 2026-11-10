@extends('layouts.app')
@section('content')

<div class="container mt-4 mb-4">
    <div class="d-flex flex-wrap gap-2 justify-content-center">
        <!-- زر إنشاء امتحان -->
        <a href="{{ url('/admin/exams/create') }}" class="btn btn-success">
            📝 إنشاء امتحان
        </a>

        <!-- زر مشاهدة الامتحانات -->
        <a href="{{ url('/exams') }}" class="btn btn-info text-white">
            📋 مشاهدة الامتحانات
        </a>

        <!-- زر الرجوع للصفحة السابقة -->
        <a href="{{ url()->previous() }}" class="btn btn-secondary">
            ← رجوع
        </a>
    </div>
</div>
<div class="container">
  <h2>نتيجتك في امتحان {{ $exam->title }}</h2>
  <p>الدرجة النهائية: {{ $score }} من {{ $exam->total_score }}</p>
</div>
@endsection
