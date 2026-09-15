<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use App\Models\Department;
use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Coach;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AcademySeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | Teams
        |--------------------------------------------------------------------------
        | The existing departments table is now used for academy teams.
        */

        $u12 = Department::create([
            'name' => 'U-12 Falcons',
            'description' => 'Under-12 development team.',
        ]);

        $u14 = Department::create([
            'name' => 'U-14 Tigers',
            'description' => 'Under-14 competitive development team.',
        ]);

        $u16 = Department::create([
            'name' => 'U-16 Eagles',
            'description' => 'Under-16 competitive team.',
        ]);

        $senior = Department::create([
            'name' => 'Senior Team',
            'description' => 'Senior academy development team.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | Courses / Training Classes
        |--------------------------------------------------------------------------
        */

        $dribbling = Course::create([
            'department_id' => $u12->id,
            'name' => 'Dribbling',
            'code' => 'IFA-DRB',
            'description' => 'Ball control, close control and one-versus-one dribbling.',
            'capacity' => 25,
        ]);

        $passing = Course::create([
            'department_id' => $u14->id,
            'name' => 'Passing & Ball Control',
            'code' => 'IFA-PBC',
            'description' => 'Passing accuracy, receiving and ball control.',
            'capacity' => 25,
        ]);

        $shooting = Course::create([
            'department_id' => $u14->id,
            'name' => 'Shooting',
            'code' => 'IFA-SHT',
            'description' => 'Finishing, shooting technique and attacking play.',
            'capacity' => 20,
        ]);

        $defending = Course::create([
            'department_id' => $u16->id,
            'name' => 'Defending',
            'code' => 'IFA-DEF',
            'description' => 'Defensive positioning, tackling and one-versus-one defending.',
            'capacity' => 20,
        ]);

        $goalkeeping = Course::create([
            'department_id' => $u16->id,
            'name' => 'Goalkeeping',
            'code' => 'IFA-GK',
            'description' => 'Goalkeeper positioning, handling and shot stopping.',
            'capacity' => 15,
        ]);

        $fitness = Course::create([
            'department_id' => $senior->id,
            'name' => 'Fitness & Conditioning',
            'code' => 'IFA-FIT',
            'description' => 'Football fitness, endurance, speed and conditioning.',
            'capacity' => 25,
        ]);


        /*
        |--------------------------------------------------------------------------
        | Admin Account
        |--------------------------------------------------------------------------
        */

        User::create([
            'name' => 'Academy Administrator',
            'email' => 'exevortex34@gmail.com',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);


        /*
        |--------------------------------------------------------------------------
        | Coach Accounts
        |--------------------------------------------------------------------------
        */

        $coaches = [
            [
                'name' => 'Ahmed Raza',
                'email' => 'coach1@irongate.com',
                'phone' => '03001230001',
                'specialization' => 'Technical Training',
            ],
            [
                'name' => 'Usman Ali',
                'email' => 'coach2@irongate.com',
                'phone' => '03001230002',
                'specialization' => 'Fitness & Conditioning',
            ],
            [
                'name' => 'Bilal Shah',
                'email' => 'coach3@irongate.com',
                'phone' => '03001230003',
                'specialization' => 'Goalkeeping',
            ],
        ];

        foreach ($coaches as $data) {

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'role' => 'coach',
                'password' => Hash::make('password'),
            ]);

            Coach::create([
                'user_id' => $user->id,
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'specialization' => $data['specialization'],
                'status' => true,
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | Students
        |--------------------------------------------------------------------------
        */

        $students = [
            [
                'name' => 'Ali Hassan',
                'email' => 'ali@irongate.com',
                'student_id' => 'IFA-001',
                'phone' => '03001234567',
                'team_id' => $u14->id,
            ],
            [
                'name' => 'Ahmed Khan',
                'email' => 'ahmed@irongate.com',
                'student_id' => 'IFA-002',
                'phone' => '03011234567',
                'team_id' => $u14->id,
            ],
            [
                'name' => 'Hamza Malik',
                'email' => 'hamza@irongate.com',
                'student_id' => 'IFA-003',
                'phone' => '03021234567',
                'team_id' => $u16->id,
            ],
            [
                'name' => 'Usman Tariq',
                'email' => 'usman@irongate.com',
                'student_id' => 'IFA-004',
                'phone' => '03031234567',
                'team_id' => $u12->id,
            ],
            [
                'name' => 'Bilal Ahmed',
                'email' => 'bilal@irongate.com',
                'student_id' => 'IFA-005',
                'phone' => '03041234567',
                'team_id' => $u16->id,
            ],
        ];


        /*
        |--------------------------------------------------------------------------
        | Create Student Accounts + Enrollments
        |--------------------------------------------------------------------------
        */

        foreach ($students as $data) {

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'role' => 'student',
                'password' => Hash::make('password'),
            ]);

            $student = Student::create([
                'user_id' => $user->id,
                'team_id' => $data['team_id'],
                'student_id' => $data['student_id'],
                'phone' => $data['phone'],
                'date_of_birth' => '2012-05-15',
                'address' => 'Sialkot, Pakistan',
            ]);

            Enrollment::create([
                'student_id' => $student->id,
                'course_id' => $passing->id,
                'enrolled_at' => now()->toDateString(),
                'status' => 'active',
            ]);

            Enrollment::create([
                'student_id' => $student->id,
                'course_id' => $dribbling->id,
                'enrolled_at' => now()->toDateString(),
                'status' => 'active',
            ]);
        }
    }
}