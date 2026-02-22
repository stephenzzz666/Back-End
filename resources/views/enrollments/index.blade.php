@extends('layouts.app')

@section('content')
<div class="container">
    <h1>All Enrollments</h1>

    {{-- Success message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('enrollments.create') }}" class="btn btn-primary mb-3">Enroll New Student</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Student</th>
                <th>Course</th>
                <th>Score</th>
                <th>Grade</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($enrollments as $enrollment)
                <tr>
                    <td>{{ $enrollment->student->first_name }} {{ $enrollment->student->last_name }}</td>
                    <td>{{ $enrollment->course->course_name }}</td>
                    <td>{{ $enrollment->score ?? '-' }}</td>
                    <td>{{ $enrollment->grade ?? '-' }}</td>
                    <td>
                        <a href="{{ route('enrollments.edit', $enrollment->id) }}" class="btn btn-sm btn-warning">Edit</a>
                        <form action="{{ route('enrollments.destroy', $enrollment->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this enrollment?')">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection