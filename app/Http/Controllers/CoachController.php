<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use App\Models\Department;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class CoachController extends Controller
{
    public function index()
    {
        $coaches = Coach::with(['user', 'team'])
            ->latest()
            ->paginate(10);

        return view('coaches.index', compact('coaches'));
    }

    public function create()
    {
        $teams = Department::orderBy('name')->get();

        return view('coaches.create', compact('teams'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email', 'unique:coaches,email'],
            'phone' => ['nullable', 'string', 'max:30'],
            'specialization' => ['nullable', 'string', 'max:255'],
            'department_id' => ['nullable', 'exists:departments,id'],
            'status' => ['required', 'boolean'],
        ]);

        DB::transaction(function () use ($validated) {
            $user = User::create([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'role' => 'coach',
                'password' => Hash::make('password'),
            ]);

            Coach::create([
                'user_id' => $user->id,
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'specialization' => $validated['specialization'] ?? null,
                'department_id' => $validated['department_id'] ?? null,
                'status' => $validated['status'],
            ]);
        });

        return redirect()
            ->route('coaches.index')
            ->with('success', 'Coach added successfully.');
    }

    public function show(Coach $coach)
    {
        $coach->load(['user', 'team', 'practiceMatches']);

        return view('coaches.show', compact('coach'));
    }

    public function edit(Coach $coach)
    {
        $teams = Department::orderBy('name')->get();

        return view('coaches.edit', compact('coach', 'teams'));
    }

    public function update(Request $request, Coach $coach)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($coach->user_id),
                Rule::unique('coaches', 'email')->ignore($coach->id),
            ],
            'phone' => ['nullable', 'string', 'max:30'],
            'specialization' => ['nullable', 'string', 'max:255'],
            'department_id' => ['nullable', 'exists:departments,id'],
            'status' => ['required', 'boolean'],
        ]);

        DB::transaction(function () use ($validated, $coach) {
            if ($coach->user) {
                $coach->user->update([
                    'name' => $validated['name'],
                    'email' => $validated['email'],
                ]);
            }

            $coach->update([
                'name' => $validated['name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'] ?? null,
                'specialization' => $validated['specialization'] ?? null,
                'department_id' => $validated['department_id'] ?? null,
                'status' => $validated['status'],
            ]);
        });

        return redirect()
            ->route('coaches.index')
            ->with('success', 'Coach updated successfully.');
    }

    public function destroy(Coach $coach)
    {
        DB::transaction(function () use ($coach) {
            $user = $coach->user;

            $coach->delete();

            if ($user) {
                $user->delete();
            }
        });

        return redirect()
            ->route('coaches.index')
            ->with('success', 'Coach deleted successfully.');
    }
}