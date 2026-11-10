@extends('layouts.app')

@section('styles')
<style>
    body {
        background-image: url('/images/dark-bg.png');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        margin: 0;
        font-family: 'Tajawal', sans-serif;
    }

    .exam-overlay {
        background-color: rgba(255, 255, 255, 0.85);
        border-radius: 15px;
        padding: 30px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        backdrop-filter: blur(10px);
    }
    .card {
    background-color: #f0f0f0 !important; /* تغيير الخلفية إلى رمادي */
    border: none !important;
    border-radius: 15px !important;
    transition: transform 0.3s, box-shadow 0.3s !important;
}

.card:hover {
    transform: translateY(-5px) !important;
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15) !important;
}

    .card-title {
        color: #0a1f44;
        font-weight: bold;
    }

    .card-text {
        color: #334e68;
    }

    .btn-outline-primary {
        border-color: #2f80ed;
        color: #2f80ed;
    }

    .btn-outline-primary:hover {
        background-color: #333333; /* تغيير اللون عند التمرير */
        color: white;
    }
</style>
@endsection

@section('content')
<div class="container exam-overlay mt-5">
    <h2 class="mb-4 text-center text-primary">📚 الامتحانات المتاحة</h2>

    <div class="row">
    @forelse ($exams as $exam)
        <div class="col-md-6 col-lg-4 mb-4">
            <div class="card shadow-sm h-100" style="background-color: #f0f0f0 !important;"> <!-- تغيير الخلفية إلى رمادي -->
                <div class="card-body d-flex flex-column justify-content-between">
                    <h5 class="card-title">{{ $exam->title }}</h5>
                    <p class="card-text">
                        ⏱️ المدة: {{ $exam->duration_minutes }} دقيقة <br>
                        🎯 الدرجة النهائية: {{ $exam->total_score }}
                    </p>
                    <a href="/exams/{{ $exam->id }}" class="btn btn-outline-primary mt-auto">بدء الامتحان ➡️</a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12 text-center">
            <p class="text-muted">لا توجد امتحانات حالياً.</p>
        </div>
    @endforelse

    
</div>
@endsection
