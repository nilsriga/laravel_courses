@extends('layouts.app')
@section('content')
    <h1>User Courses</h1>
    <ul>
        @foreach ($userCourses as $userCourse)
            <li>{{ $userCourse->user->name }} - {{ $userCourse->course->title }} - {{ $userCourse->status }}</li>
        @endforeach
    </ul>
@endsection
