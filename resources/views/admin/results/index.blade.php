@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4 text-white">📊 نتائج الطلاب</h2>

    @foreach($exams as $exam)
        <div class="card mb-3">
            <div class="card-header bg-secondary text-white">
                الامتحان: {{ $exam->title }}
            </div>
            <div class="card-body">
                @if ($exam->results->count())
                    <table class="table table-dark table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>اسم الطالب</th>
                                <th>النتيجة</th>
                                <th>من أصل</th>
                                <th>تاريخ التقديم</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($exam->results as $result)
                                <tr>
                                    <td>{{ $result->user->name ?? 'مستخدم غير معروف' }}</td>
                                    <td>{{ $result->score }}</td>
                                    <td>{{ $exam->total_score }}</td>
                                    <td>{{ $result->created_at->format('Y-m-d H:i') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p class="text-white">لا توجد نتائج لهذا الامتحان بعد.</p>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
