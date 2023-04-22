<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Attendance;
use App\Models\User;
use App\Models\Team;
use App\Models\Classroom;
use App\Models\Student;
use App\Models\Institution;
use App\Models\Student_classroom;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        User::factory(12)->create();
        Institution::factory(2)->create();
        Classroom::factory(4)->create();
        Student::factory(30)->create();
        Student_classroom::factory(16)->create();

        Attendance::factory(500)->create();


        Team::factory(3)->create();

    }
}
