<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Department;
use App\Models\PracticeMatch;
use App\Models\Student;

class AcademyController extends Controller
{
    public function students()
    {
        $students = Student::with(['user', 'team'])
            ->latest()
            ->get()
            ->map(function ($student) {
                return [
                    'id' => $student->id,
                    'student_id' => $student->student_id,
                    'name' => $student->user?->name,
                    'email' => $student->user?->email,
                    'team' => $student->team?->name,
                    'phone' => $student->phone,
                ];
            });

        return response()->json([
            'success' => true,
            'count' => $students->count(),
            'data' => $students,
        ]);
    }

    public function teams()
    {
        $teams = Department::withCount('students')
            ->orderBy('name')
            ->get()
            ->map(function ($team) {
                return [
                    'id' => $team->id,
                    'name' => $team->name,
                    'description' => $team->description,
                    'students_count' => $team->students_count,
                ];
            });

        return response()->json([
            'success' => true,
            'count' => $teams->count(),
            'data' => $teams,
        ]);
    }

    public function courses()
    {
        $courses = Course::with('department')
            ->orderBy('name')
            ->get()
            ->map(function ($course) {
                return [
                    'id' => $course->id,
                    'name' => $course->name,
                    'code' => $course->code,
                    'team' => $course->department?->name,
                    'capacity' => $course->capacity,
                ];
            });

        return response()->json([
            'success' => true,
            'count' => $courses->count(),
            'data' => $courses,
        ]);
    }

    public function matches()
    {
        $matches = PracticeMatch::with(['coach', 'team'])
            ->orderBy('match_date')
            ->get()
            ->map(function ($match) {
                return [
                    'id' => $match->id,
                    'opponent' => $match->opponent,
                    'team' => $match->team?->name,
                    'coach' => $match->coach?->name,
                    'date' => $match->match_date?->format('Y-m-d'),
                    'time' => $match->match_time,
                    'venue' => $match->venue,
                    'status' => $match->status,
                    'result' => $match->result,
                ];
            });

        return response()->json([
            'success' => true,
            'count' => $matches->count(),
            'data' => $matches,
        ]);
    }
}