<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
    ];

    // Relationship with UserCourse
    public function userCourses()
    {
        return $this->hasMany(UserCourse::class);
    }

    // Get the number of users enrolled in the course
    public function enrolledUsersCount()
    {
        return $this->userCourses()->count();
    }

    // Get the list of users enrolled in the course
    public function enrolledUsers()
    {
        return $this->userCourses()->with('user')->get()->pluck('user');
    }
}