@extends('layouts.app')

@section('content')


<h1>Welcome to Course Tracker</h1>

<h2>Users</h2>
<ul>
    @foreach($users as $user)
        <li>{{ $user->name }}</li>
    @endforeach
</ul>

<h2>Courses</h2>
<ul>
    @foreach ($courses as $course)
        <li>{{ $course->title }}</li>
    @endforeach
</ul>

<h2>User Courses</h2>
<ul>
    @foreach ($userCourses as $userCourse)
        <li>
            {{ $userCourse->user->name }} - {{ $userCourse->course->title }} - {{ $userCourse->status }}
            @if ($userCourse->certificate)
                <a href="{{ asset('storage/' . $userCourse->certificate) }}" target="_blank">View Certificate</a>
            @endif
        </li>
    @endforeach
</ul>

<h2>Add User Course</h2>
<form action="{{ route('user_courses.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div>
        <label for="user_id">User</label>
        <select name="user_id" id="user_id">
            @foreach ($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="course_id">Course</label>
        <select name="course_id" id="course_id">
            @foreach ($courses as $course)
                <option value="{{ $course->id }}">{{ $course->title }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label for="status">Status</label>
        <select name="status" id="status">
            <option value="completed">Completed</option>
            <option value="discontinued">Discontinued</option>
        </select>
    </div>
    <div>
        <label for="certificate">Certificate</label>
        <input type="file" name="certificate" id="certificate">
    </div>
    <button type="submit">Add</button>
</form>
@endsection