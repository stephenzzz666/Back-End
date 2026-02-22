@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Edit Enrollment</h1>

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

    <form action="{{ route('enrollments.update', $enrollment->id) }}" method="POST">
        @csrf
        @method('PUT')

        {{-- Student Selection --}}
        <div class="mb-3">
            <label for="student_id" class="form-label">Student</label>
            <select name="student_id" id="student_id" class="form-select" required>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ $student->id == $enrollment->student_id ? 'selected' : '' }}>
                        {{ $student->first_name }} {{ $student->last_name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Course Selection --}}
        <div class="mb-3">
            <label for="course_id" class="form-label">Course</label>
            <select name="course_id" id="course_id" class="form-select" required>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ $course->id == $enrollment->course_id ? 'selected' : '' }}>
                        {{ $course->course_name }}
                    </option>
                @endforeach
            </select>
        </div>

        {{-- Score Input --}}
        <div class="mb-3">
            <label for="score" class="form-label">Score (Optional)</label>
            <input type="number" step="0.01" min="0" max="100" name="score" id="score" class="form-control" value="{{ old('score', $enrollment->score) }}">
        </div>

        {{-- Grade Input --}}
        <div class="mb-3">
            <label for="grade" class="form-label">Grade (Optional)</label>
            <input type="text" name="grade" id="grade" maxlength="2" class="form-control" value="{{ old('grade', $enrollment->grade) }}">
            <small class="text-muted">Leave blank to auto-generate from score</small>
        </div>

        <button type="submit" class="btn btn-primary">Update Enrollment</button>
        <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection