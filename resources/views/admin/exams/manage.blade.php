@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>إدارة الامتحانات</h2>

    @include('partials.alerts')

    @foreach ($exams as $exam)
        <div class="card mb-3 p-3">
            <h4>{{ $exam->title }}</h4>
            <p>المدة: {{ $exam->duration_minutes }} دقيقة | الدرجة الكلية: {{ $exam->total_score }}</p>

            <div class="d-flex gap-2">
                <!-- زر تعديل الأسئلة -->
                <a href="{{ url('/admin/exams/'.$exam->id.'/questions/create') }}" class="btn btn-warning btn-sm">
                    ✏️ تعديل الأسئلة
                </a>
                <a href="/admin/exams/{{ $exam->id }}/edit" class="btn btn-warning btn-sm">✏️ تعديل الامتحان</a>

                <!-- زر حذف الامتحان -->
                <form method="POST" action="{{ url('/admin/exams/'.$exam->id) }}" onsubmit="return confirm('هل تريد حذف هذا الامتحان؟')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">🗑 حذف الامتحان</button>
                </form>
            </div>
        </div>
    @endforeach
</div>

<div class="mb-4 d-flex justify-content-end">
    <a href="{{ url('/exams') }}" class="btn btn-secondary">
        ← العودة إلى صفحة الامتحانات المتاحة
    </a>
</div>


@endsection
