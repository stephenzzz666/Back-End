{{-- resources/views/enrollments/create.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Enroll Student in a Course</h1>

    {{-- Display validation errors --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('enrollments.store') }}" method="POST">
        @csrf

        {{-- Student Selection --}}
        <div class="mb-3">
            <label for="student_id" class="form-label">Student</label>
            <select name="student_id" id="student_id" class="form-select" required>
                <option value="">-- Select Student --</option>
                @foreach($students as $student)
                    <option value="{{ $student->id }}">{{ $student->first_name }} {{ $student->last_name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Course Selection --}}
        <div class="mb-3">
            <label for="course_id" class="form-label">Course</label>
            <select name="course_id" id="course_id" class="form-select" required>
                <option value="">-- Select Course --</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->course_name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Score Input --}}
        <div class="mb-3">
            <label for="score" class="form-label">Score (Optional)</label>
            <input type="number" step="0.01" min="0" max="100" name="score" id="score" class="form-control" value="{{ old('score') }}">
        </div>

        {{-- Grade Input --}}
        <div class="mb-3">
            <label for="grade" class="form-label">Grade (Optional)</label>
            <input type="text" name="grade" id="grade" maxlength="2" class="form-control" value="{{ old('grade') }}">
            <small class="text-muted">Leave blank to auto-generate from score</small>
        </div>

        <button type="submit" class="btn btn-primary">Enroll Student</button>
        <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection