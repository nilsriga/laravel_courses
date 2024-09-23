@extends('layouts.app')
@section('content')
    <h1>Courses</h1>
    <ul>
        @foreach ($courses as $course)
            <li>{{ $course->title }}</li>
        @endforeach
    </ul>
@endsection
