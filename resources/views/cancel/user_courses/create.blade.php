@extends('layouts.app')
@section('content')
    <h1>Add User Course</h1>
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
