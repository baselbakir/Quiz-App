@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>مرحبًا في لوحة تحكم المدير</h1>
        <!-- أضف المحتوى الذي تريد عرضه هنا -->
       <a href="{{ route('admin.exams.manage') }}" class="btn btn-primary">إدارة الامتحانات</a>
       <a href="{{ route('admin.results.index') }}" class="btn btn-secondary">عرض النتائج</a>
    </div>
@endsection
