<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCourse extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'course_id',
        'status',
        'completed_at',
        'certificate',
    ];

    // Relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relationship with Course
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    // Check if the course is completed
    public function isCompleted()
    {
        return $this->status === 'completed';
    }

    // Get the completion date in a readable format
    public function getCompletionDate()
    {
        return $this->completed_at ? $this->completed_at->format('d-m-Y') : 'Not completed';
    }
}
