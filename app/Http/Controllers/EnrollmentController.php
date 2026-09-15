<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Enrollment;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class EnrollmentController extends Controller
{
    public function index()
    {
        $enrollments = Enrollment::with([
            'student.user',
            'student.team',
            'course',
        ])
            ->latest()
            ->paginate(10);

        return view('enrollments.index', compact('enrollments'));
    }

    public function create()
    {
        $students = Student::with('user', 'team')
            ->orderBy('student_id')
            ->get();

        $courses = Course::with('department')
            ->orderBy('name')
            ->get();

        return view('enrollments.create', compact('students', 'courses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => [
                'required',
                'exists:students,id',
                Rule::unique('enrollments', 'student_id')
                    ->where(function ($query) use ($request) {
                        return $query->where('course_id', $request->course_id);
                    }),
            ],
            'course_id' => ['required', 'exists:courses,id'],
            'status' => ['required', 'in:active,completed,cancelled'],
            'enrolled_at' => ['required', 'date'],
        ], [
            'student_id.unique' => 'This student is already enrolled in this course.',
        ]);

        $course = Course::findOrFail($validated['course_id']);

        $currentEnrollments = Enrollment::where('course_id', $course->id)
            ->where('status', 'active')
            ->count();

        if (
            $validated['status'] === 'active' &&
            $currentEnrollments >= $course->capacity
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'course_id' => 'This course has reached its capacity.',
                ]);
        }

        Enrollment::create($validated);

        return redirect()
            ->route('enrollments.index')
            ->with('success', 'Student enrolled successfully.');
    }

    public function show(Enrollment $enrollment)
    {
        $enrollment->load([
            'student.user',
            'student.team',
            'course.department',
        ]);

        return view('enrollments.show', compact('enrollment'));
    }

    public function edit(Enrollment $enrollment)
    {
        $enrollment->load([
            'student.user',
            'course',
        ]);

        $courses = Course::with('department')
            ->orderBy('name')
            ->get();

        return view('enrollments.edit', compact('enrollment', 'courses'));
    }

    public function update(Request $request, Enrollment $enrollment)
    {
        $validated = $request->validate([
            'course_id' => ['required', 'exists:courses,id'],
            'status' => ['required', 'in:active,completed,cancelled'],
            'enrolled_at' => ['required', 'date'],
        ]);

        $duplicate = Enrollment::where('student_id', $enrollment->student_id)
            ->where('course_id', $validated['course_id'])
            ->where('id', '!=', $enrollment->id)
            ->exists();

        if ($duplicate) {
            return back()
                ->withInput()
                ->withErrors([
                    'course_id' => 'This student is already enrolled in this course.',
                ]);
        }

        $course = Course::findOrFail($validated['course_id']);

        $currentEnrollments = Enrollment::where('course_id', $course->id)
            ->where('status', 'active')
            ->where('id', '!=', $enrollment->id)
            ->count();

        if (
            $validated['status'] === 'active' &&
            $currentEnrollments >= $course->capacity
        ) {
            return back()
                ->withInput()
                ->withErrors([
                    'course_id' => 'This course has reached its capacity.',
                ]);
        }

        $enrollment->update($validated);

        return redirect()
            ->route('enrollments.index')
            ->with('success', 'Enrollment updated successfully.');
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();

        return redirect()
            ->route('enrollments.index')
            ->with('success', 'Enrollment deleted successfully.');
    }
}