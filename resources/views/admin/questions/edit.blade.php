@extends('layouts.app')

@section('content')
<div class="container mt-4 mb-4">
    <h2>تعديل الأسئلة لامتحان "{{ $exam->title }}"</h2>

    @include('partials.alerts')

    @foreach ($exam->questions as $question)
        <form method="POST" action="{{ url('/admin/questions/' . $question->id . '/update') }}" class="border p-3 mb-4">
            @csrf
            @method('PUT')

            <div class="mb-2">
                <label>نص السؤال:</label>
                <textarea name="question_text" class="form-control" required>{{ $question->question_text }}</textarea>
            </div>

            <div class="mb-2">
                <label>درجة السؤال:</label>
                <input type="number" name="score" class="form-control" value="{{ $question->score }}" required>
            </div>

            <div class="mb-2">
                <label>الخيارات:</label>
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

            <div class="d-flex justify-content-between">
                <button type="submit" class="btn btn-primary">💾 تعديل السؤال</button>

                <!-- زر الحذف -->
                <form method="POST" action="/admin/questions/{{ $question->id }}/delete" onsubmit="return confirm('هل أنت متأكد من حذف هذا السؤال؟')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">🗑 حذف</button>
                </form>
            </div>
        </form>
    @endforeach

    <!-- زر الرجوع -->
    <a href="{{ url('/admin/exams') }}" class="btn btn-secondary">⬅ الرجوع لإدارة الامتحانات</a>
</div>
@endsection
