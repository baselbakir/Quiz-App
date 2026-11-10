
@extends('layouts.app')

@section('content')
<div class="container mt-4 mb-4">
    <h2>✏️ تعديل السؤال</h2>

    @include('partials.alerts')

    <form method="POST" action="{{ url('/admin/questions/' . $question->id . '/update') }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">نص السؤال</label>
            <textarea name="question_text" class="form-control" required>{{ $question->question_text }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">درجة السؤال</label>
            <input type="number" name="score" class="form-control" value="{{ $question->score }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">الخيارات</label>
            @foreach ($question->answers as $index => $answer)
                <div class="input-group mb-2">
                    <input type="text" name="answers[]" class="form-control" value="{{ $answer->answer_text }}" required>
                    <span class="input-group-text">
                        <input type="radio" name="correct_answer" value="{{ $index }}" {{ $answer->is_correct ? 'checked' : '' }}>
                        <small class="ms-1">صحيح؟</small>
                    </span>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">💾 حفظ التعديلات</button>
        <a href="{{ url('/admin/exams/' . $question->exam_id . '/questions/create') }}" class="btn btn-secondary ms-2">← الرجوع</a>
    </form>
</div>
@endsection
