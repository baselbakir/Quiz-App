@extends('layouts.app')
@section('content')
<div class="container">
  <h2>{{ $exam->title }}</h2>
  <p>مدة الامتحان: {{ $exam->duration_minutes }} دقيقة</p>
  <form method="POST" action="/submit-exam/{{ $exam->id }}" id="examForm">
    @csrf
    <div id="timer"></div>
    @foreach ($questions as $question)
      <div class="mb-4">
        <strong>{{ $question->question_text }}</strong><br>
        @foreach ($question->answers as $answer)
          <label><input type="radio" name="answers[{{ $question->id }}]" value="{{ $answer->id }}"> {{ $answer->answer_text }}</label><br>
        @endforeach
      </div>
    @endforeach
    <button type="submit" class="btn btn-primary">إرسال</button>
  </form>
</div>
<script>
  let duration = {{ $exam->duration_minutes }} * 60;
  let timerDiv = document.getElementById('timer');
  let interval = setInterval(() => {
    let minutes = Math.floor(duration / 60);
    let seconds = duration % 60;
    timerDiv.innerText = `الوقت المتبقي: ${minutes}:${seconds < 10 ? '0' + seconds : seconds}`;
    if (duration <= 0) {
      clearInterval(interval);
      document.getElementById('examForm').submit();
    }
    duration--;
  }, 1000);
</script>
@endsection
