<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserCourse;
use App\Models\Course;
use App\Models\User;

class UserCourseController extends Controller
{
    public function index()
    {

        $users = User::all();
        $courses = Course::all();
        $userCourses = UserCourse::with('user', 'course')->get();
        // return view('user_courses.index', compact('userCourses'));
        return view('index', compact('users', 'courses', 'userCourses'));
    }
    public function create()
    {
        $users = User::all();
        $courses = Course::all();
        return view('dashboard', compact('users', 'courses'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'course_id' => 'required|exists:courses,id',
            'status' => 'required|in:completed,discontinued',
            'certificate' => 'nullable|file|mimes:pdf,jpg,png',
        ]);
        $userCourse = new UserCourse($request->all());
        if ($request->hasFile('certificate')) {
            $path = $request->file('certificate')->store('public');
            $userCourse->certificate = str_replace('public/', '', $path);
        }
        $userCourse->save();
        return redirect()->route('dashboard');
    }
}

