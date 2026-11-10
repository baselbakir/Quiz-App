@extends('layouts.app')

@section('content')
<div class="container mt-4 mb-4">
    <h2>إضافة سؤال لـ "{{ $exam->title }}"</h2>

    @include('partials.alerts')

    <form method="POST" action="/admin/exams/{{ $exam->id }}/questions/store">
        @csrf
        <div class="mb-3">
            <label class="form-label">نص السؤال</label>
            <textarea name="question_text" class="form-control" required></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">درجة السؤال</label>
            <input type="number" name="score" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">الخيارات</label>
            @for ($i = 0; $i < 4; $i++)
                <div class="input-group mb-2">
                    <input type="text" name="answers[]" class="form-control" placeholder="خيار {{ $i + 1 }}" required>
                    <span class="input-group-text">
                        <input type="radio" name="correct_answer" value="{{ $i }}" required>
                        <small class="ms-1">صحيح؟</small>
                    </span>
                </div>
            @endfor
        </div>

        <button type="submit" class="btn btn-success">➕ حفظ السؤال</button>
    </form>

    <hr>

    <h4 class="mt-4">الأسئلة المضافة حاليًا:</h4>
    @foreach($exam->questions as $question)
        <div class="border p-3 mb-2">
            <strong>{{ $question->question_text }}</strong>
            <div class="mt-2">
                <form method="POST" action="/admin/questions/{{ $question->id }}/delete" onsubmit="return confirm('هل أنت متأكد من حذف هذا السؤال؟')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">🗑 حذف</button>
                </form>
            </div>
        </div>
    @endforeach

    <div class="mt-4">
        <a href="{{ url('/exams') }}" class="btn btn-primary">✅ إنهاء إضافة الأسئلة والعودة للامتحانات</a>
    </div>
</div>
@endsection
