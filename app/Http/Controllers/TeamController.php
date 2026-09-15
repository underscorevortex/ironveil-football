<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Department::withCount(['students', 'courses'])
            ->latest()
            ->paginate(10);

        return view('teams.index', compact('teams'));
    }

    public function create()
    {
        return view('teams.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:departments,name'],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        Department::create($validated);

        return redirect()
            ->route('teams.index')
            ->with('success', 'Team added successfully.');
    }

    public function show(Department $team)
    {
        $team->load([
            'students.user',
            'courses',
        ]);

        return view('teams.show', compact('team'));
    }

    public function edit(Department $team)
    {
        return view('teams.edit', compact('team'));
    }

    public function update(Request $request, Department $team)
    {
        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('departments', 'name')->ignore($team->id),
            ],
            'description' => ['nullable', 'string', 'max:1000'],
        ]);

        $team->update($validated);

        return redirect()
            ->route('teams.index')
            ->with('success', 'Team updated successfully.');
    }

    public function destroy(Department $team)
    {
        DB::transaction(function () use ($team) {
            $team->delete();
        });

        return redirect()
            ->route('teams.index')
            ->with('success', 'Team deleted successfully.');
    }
}