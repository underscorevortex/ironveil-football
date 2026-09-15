<?php

namespace App\Http\Controllers;

use App\Models\Coach;
use App\Models\Department;
use App\Models\PracticeMatch;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PracticeMatchController extends Controller
{
    public function index()
    {
        $matches = PracticeMatch::with([
            'coach',
            'team',
        ])
            ->latest('match_date')
            ->latest('match_time')
            ->paginate(10);

        return view('practice-matches.index', compact('matches'));
    }

    public function create()
    {
        $coaches = Coach::where('status', true)
            ->orderBy('name')
            ->get();

        $teams = Department::orderBy('name')
            ->get();

        return view('practice-matches.create', compact(
            'coaches',
            'teams'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'coach_id' => [
                'required',
                'exists:coaches,id',
            ],

            'team_id' => [
                'required',
                'exists:departments,id',
            ],

            'opponent' => [
                'required',
                'string',
                'max:255',
            ],

            'match_date' => [
                'required',
                'date',
            ],

            'match_time' => [
                'required',
                'date_format:H:i',
            ],

            'venue' => [
                'required',
                'string',
                'max:255',
            ],

            'status' => [
                'required',
                'in:scheduled,completed,cancelled',
            ],

            'result' => [
                'nullable',
                'string',
                'max:100',
            ],
        ]);

        PracticeMatch::create($validated);

        return redirect()
            ->route('practice-matches.index')
            ->with('success', 'Practice match created successfully.');
    }

    public function show(PracticeMatch $practiceMatch)
    {
        $practiceMatch->load([
            'coach',
            'team',
        ]);

        return view('practice-matches.show', compact(
            'practiceMatch'
        ));
    }

    public function edit(PracticeMatch $practiceMatch)
    {
        $coaches = Coach::where('status', true)
            ->orderBy('name')
            ->get();

        $teams = Department::orderBy('name')
            ->get();

        return view('practice-matches.edit', compact(
            'practiceMatch',
            'coaches',
            'teams'
        ));
    }

    public function update(
        Request $request,
        PracticeMatch $practiceMatch
    ) {
        $validated = $request->validate([
            'coach_id' => [
                'required',
                'exists:coaches,id',
            ],

            'team_id' => [
                'required',
                'exists:departments,id',
            ],

            'opponent' => [
                'required',
                'string',
                'max:255',
            ],

            'match_date' => [
                'required',
                'date',
            ],

            'match_time' => [
                'required',
                'date_format:H:i',
            ],

            'venue' => [
                'required',
                'string',
                'max:255',
            ],

            'status' => [
                'required',
                'in:scheduled,completed,cancelled',
            ],

            'result' => [
                'nullable',
                'string',
                'max:100',
            ],
        ]);

        $practiceMatch->update($validated);

        return redirect()
            ->route('practice-matches.index')
            ->with('success', 'Practice match updated successfully.');
    }

    public function destroy(PracticeMatch $practiceMatch)
    {
        DB::transaction(function () use ($practiceMatch) {
            $practiceMatch->delete();
        });

        return redirect()
            ->route('practice-matches.index')
            ->with('success', 'Practice match deleted successfully.');
    }
}