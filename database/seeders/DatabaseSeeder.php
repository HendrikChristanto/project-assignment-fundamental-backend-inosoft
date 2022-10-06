<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Score;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Classroom;

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use MongoDB\BSON\ObjectId;

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

        // Create faker
        $faker = Faker::create();

        // Add data to classroom table
        for ($i = 1; $i <= 2; $i++){
            for ($j = 1; $j <= 2; $j++){
                Classroom::create([
                    'name' => 'Class ' . $i . '-' . chr(64 + $j),
                    'capacity' => 40,
                ]);
            }
        }

        // Add data to student table
        $classroomIDs = Classroom::pluck('_id');
        for ($i = 1; $i <= 10; $i++){
            Student::create([
                'name' => $faker->firstName() . ' ' . $faker->lastName(),
                'classroom_id' => new ObjectId($faker->randomElement($classroomIDs)),
            ]);
        }

        // Add data to subject table
        $subjects = [
            ['name' => 'Mathematics'],
            ['name' => 'Science'],
            ['name' => 'History'],
            ['name' => 'Information Technology'],
            ['name' => 'Foreign Language'],
        ];
        foreach ($subjects as $subject){
            Subject::create([
                'name' => $subject['name'],
            ]);
        }
        
        // Add data to score table
        $studentIDs = student::pluck('_id');
        $subjectIDs = Subject::pluck('_id');
        foreach ($subjectIDs as $subjectID){
            Score::create([
                'student_id' => new ObjectId($studentIDs[0]),
                'subject_id' => new ObjectId($subjectID),
                'assignment_1' => (float) $faker->numberBetween(60, 100),
                'assignment_2' => (float) $faker->numberBetween(60, 100),
                'assignment_3' => (float) $faker->numberBetween(60, 100),
                'assignment_4' => (float) $faker->numberBetween(60, 100),
                'daily_test_1' => (float) $faker->numberBetween(60, 100),
                'daily_test_2' => (float) $faker->numberBetween(60, 100),
                'midterm_test' => (float) $faker->numberBetween(60, 100),
                'final_test' => (float) $faker->numberBetween(60, 100),
            ]);
        }
    }
}
