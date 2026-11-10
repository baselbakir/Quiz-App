@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>تعديل معلومات الامتحان</h2>

    @include('partials.alerts')

    <form method="POST" action="/admin/exams/{{ $exam->id }}/update">
        @csrf
        <div class="mb-3">
            <label class="form-label">عنوان الامتحان</label>
            <input type="text" name="title" class="form-control" value="{{ $exam->title }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">مدة الامتحان (بالدقائق)</label>
            <input type="number" name="duration_minutes" class="form-control" value="{{ $exam->duration_minutes }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">الدرجة النهائية</label>
            <input type="number" name="total_score" class="form-control" value="{{ $exam->total_score }}" required>
        </div>

        <button type="submit" class="btn btn-primary">💾 تحديث</button>
        <a href="{{ url('/admin/exams/manage') }}" class="btn btn-secondary">← رجوع</a>
    </form>
</div>
@endsection
