<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Course;
use App\Models\UserCourse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@email.com',
            'password'=> bcrypt('asdf'),
        ]);

        DB::table('sessions')->insert([
            'id' => Str::uuid(),
            'user_id' => 1,
            'ip_address' => '127.0.0.1',
            'user_agent' => 'Mozilla/5.0',
            'payload' => json_encode(['key' => 'value']),
            'last_activity' => now()->timestamp,
        ]);

        // Seed courses
        $course = Course::create([
            'title' => 'Sample Course',
            'description' => 'This is a sample course description.',
        ]);

        // Seed user_courses
        UserCourse::create([
            'user_id' => 1,
            'course_id' => $course->id,
            'status' => 'completed',
            'completed_at' => now(),
            'certificate' => 'sample_certificate.pdf',
        ]);
    }
}
