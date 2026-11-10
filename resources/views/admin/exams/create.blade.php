@extends('layouts.app')
@section('content')


<div class="container">
  <h2>إضافة امتحان جديد</h2>

  @include('partials.alerts')
  
  <form method="POST" action="/admin/exams">
    @csrf
    <div class="mb-3">
      <label>عنوان الامتحان</label>
      <input type="text" name="title" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>المدة (بالدقائق)</label>
      <input type="number" name="duration_minutes" class="form-control" required>
    </div>
    <div class="mb-3">
      <label>الدرجة النهائية</label>
      <input type="number" name="total_score" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">إنشاء</button>
  </form>
</div>
@endsection