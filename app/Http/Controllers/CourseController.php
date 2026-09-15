<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class CourseController extends Controller
{
    public function index()
    {
        $courses = Course::with('department')
            ->latest()
            ->paginate(10);

        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        $teams = Department::orderBy('name')->get();

        return view('courses.create', compact('teams'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => ['required', 'string', 'max:50', 'unique:courses,code'],
            'description' => ['nullable', 'string', 'max:1000'],
            'capacity' => ['required', 'integer', 'min:1', 'max:500'],
            'department_id' => ['required', 'exists:departments,id'],
        ]);

        Course::create($validated);

        return redirect()
            ->route('courses.index')
            ->with('success', 'Course added successfully.');
    }

    public function show(Course $course)
    {
        $course->load([
            'department',
            'enrollments.student.user',
        ]);

        return view('courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        $teams = Department::orderBy('name')->get();

        return view('courses.edit', compact('course', 'teams'));
    }

    public function update(Request $request, Course $course)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'code' => [
                'required',
                'string',
                'max:50',
                Rule::unique('courses', 'code')->ignore($course->id),
            ],
            'description' => ['nullable', 'string', 'max:1000'],
            'capacity' => ['required', 'integer', 'min:1', 'max:500'],
            'department_id' => ['required', 'exists:departments,id'],
        ]);

        $course->update($validated);

        return redirect()
            ->route('courses.index')
            ->with('success', 'Course updated successfully.');
    }

    public function destroy(Course $course)
    {
        DB::transaction(function () use ($course) {
            $course->delete();
        });

        return redirect()
            ->route('courses.index')
            ->with('success', 'Course deleted successfully.');
    }
}