@extends('layouts.app')

@section('content')

<div class="container mt-4 mb-4">
    <div class="d-flex flex-wrap gap-2 justify-content-center">
        <a href="{{ url('/admin/exams/create') }}" class="btn btn-success">
            📝 إنشاء امتحان
        </a>
        <a href="{{ url('/exams') }}" class="btn btn-info text-white">
            📋 مشاهدة الامتحانات
        </a>
        <a href="{{ url('/admin/exams/manage') }}" class="btn btn-dark">
              🛠️ إدارة الامتحانات
         </a>

        <a href="{{ url()->previous() }}" class="btn btn-secondary">
            ← رجوع
        </a>
    </div>
</div>

<div class="container">
    <h2>إضافة سؤال لـ "{{ $exam->title }}"</h2>

    @include('partials.alerts')

    {{-- نموذج إضافة السؤال --}}
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

        <button type="submit" class="btn btn-success">💾 حفظ السؤال</button>
    </form>

    <hr>

    {{-- عرض الأسئلة الحالية --}}
    <h4>الأسئلة الحالية:</h4>
    @if($questions->isEmpty())
        <p>لا توجد أسئلة مضافة حتى الآن.</p>
    @else
    @foreach($questions as $question)
    <div class="border rounded p-3 mb-2">
        <strong>{{ $question->question_text }}</strong> (الدرجة: {{ $question->score }})
        <ul>
            @foreach ($question->answers as $answer)
                <li>{{ $answer->answer_text }} @if($answer->is_correct) ✅ @endif</li>
            @endforeach
        </ul>

        <div class="d-flex gap-2">
            <!-- زر تعديل السؤال -->
            <a href="{{ url("/admin/questions/{$question->id}/edit") }}" class="btn btn-warning btn-sm">
                ✏️ تعديل السؤال
            </a>

            <!-- زر حذف السؤال -->
            <form method="POST" action="{{ url("/admin/questions/{$question->id}/delete") }}" onsubmit="return confirm('هل أنت متأكد من حذف هذا السؤال؟')">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm">🗑 حذف السؤال</button>
            </form>
        </div>
    </div>
@endforeach

    @endif

    <a href="{{ url('/exams') }}" class="btn btn-primary mt-3">✅ إنهاء إضافة الأسئلة</a>
</div>

@endsection
