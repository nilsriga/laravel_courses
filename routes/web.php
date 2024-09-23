<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\UserCourseController;
use App\Models\User;
use App\Models\Course;
use App\Models\UserCourse;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    $users = User::all();
    $courses = Course::all();
    $userCourses = UserCourse::with('user', 'course')->get();
    return view('dashboard', compact('users', 'courses', 'userCourses'));
})->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/welcome', function () {
    return view('welcome');
});

Route::resource('users', UserController::class);
Route::resource('courses', CourseController::class);
Route::resource('user_courses', UserCourseController::class);

Route::get('/dashboard', function () {
    $users = User::all();
    $courses = Course::all();
    $userCourses = UserCourse::with('user', 'course')->get();
    return view('dashboard', compact('users', 'courses', 'userCourses'));
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
