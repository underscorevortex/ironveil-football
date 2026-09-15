<x-app-layout>
    <div class="ig-content">

        <div class="mb-4">
            <h1 class="ig-title">Add Practice Match</h1>
            <p class="ig-subtitle">
                Schedule a new practice match for the academy.
            </p>
        </div>

        @if ($errors->any())
            <div class="ig-alert ig-alert-error">
                <strong>Please fix the following:</strong>

                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="ig-card">

            <div class="ig-card-header">
                <div>
                    <h2>Match Information</h2>
                    <div class="small mt-1" style="color: var(--ig-muted);">
                        Enter the details for the upcoming practice match.
                    </div>
                </div>
            </div>

            <div class="ig-card-body">

                <form method="POST" action="{{ route('practice-matches.store') }}">
                    @csrf

                    <div class="row g-4">

                        {{-- Coach --}}
                        <div class="col-md-6">
                            <label for="coach_id" class="ig-label">
                                Coach
                            </label>

                            <select name="coach_id"
                                    id="coach_id"
                                    class="ig-input"
                                    required>
                                <option value="">Select Coach</option>

                                @foreach ($coaches as $coach)
                                    <option value="{{ $coach->id }}"
                                        {{ old('coach_id') == $coach->id ? 'selected' : '' }}>
                                        {{ $coach->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('coach_id')
                                <div class="ig-field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Team --}}
                        <div class="col-md-6">
                            <label for="team_id" class="ig-label">
                                Team
                            </label>

                            <select name="team_id"
                                    id="team_id"
                                    class="ig-input"
                                    required>
                                <option value="">Select Team</option>

                                @foreach ($teams as $team)
                                    <option value="{{ $team->id }}"
                                        {{ old('team_id') == $team->id ? 'selected' : '' }}>
                                        {{ $team->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('team_id')
                                <div class="ig-field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Opponent --}}
                        <div class="col-md-6">
                            <label for="opponent" class="ig-label">
                                Opponent
                            </label>

                            <input type="text"
                                   name="opponent"
                                   id="opponent"
                                   class="ig-input"
                                   value="{{ old('opponent') }}"
                                   placeholder="e.g. City Football Academy"
                                   required>

                            @error('opponent')
                                <div class="ig-field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Venue --}}
                        <div class="col-md-6">
                            <label for="venue" class="ig-label">
                                Venue
                            </label>

                            <input type="text"
                                   name="venue"
                                   id="venue"
                                   class="ig-input"
                                   value="{{ old('venue') }}"
                                   placeholder="e.g. IronGate Main Ground"
                                   required>

                            @error('venue')
                                <div class="ig-field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Match Date --}}
                        <div class="col-md-6">
                            <label for="match_date" class="ig-label">
                                Match Date
                            </label>

                            <input type="date"
                                   name="match_date"
                                   id="match_date"
                                   class="ig-input"
                                   value="{{ old('match_date') }}"
                                   required>

                            @error('match_date')
                                <div class="ig-field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Match Time --}}
                        <div class="col-md-6">
                            <label for="match_time" class="ig-label">
                                Match Time
                            </label>

                            <input type="time"
                                   name="match_time"
                                   id="match_time"
                                   class="ig-input"
                                   value="{{ old('match_time') }}"
                                   required>

                            @error('match_time')
                                <div class="ig-field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Status --}}
                        <div class="col-md-6">
                            <label for="status" class="ig-label">
                                Status
                            </label>

                            <select name="status"
                                    id="status"
                                    class="ig-input"
                                    required>

                                <option value="scheduled"
                                    {{ old('status', 'scheduled') === 'scheduled' ? 'selected' : '' }}>
                                    Scheduled
                                </option>

                                <option value="completed"
                                    {{ old('status') === 'completed' ? 'selected' : '' }}>
                                    Completed
                                </option>

                                <option value="cancelled"
                                    {{ old('status') === 'cancelled' ? 'selected' : '' }}>
                                    Cancelled
                                </option>

                            </select>

                            @error('status')
                                <div class="ig-field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- Result --}}
                        <div class="col-md-6">
                            <label for="result" class="ig-label">
                                Result
                            </label>

                            <input type="text"
                                   name="result"
                                   id="result"
                                   class="ig-input"
                                   value="{{ old('result') }}"
                                   placeholder="e.g. 3 - 1">

                            @error('result')
                                <div class="ig-field-error">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="d-flex gap-2 mt-4">

                        <button type="submit"
                                class="ig-btn ig-btn-primary">
                            Create Match
                        </button>

                        <a href="{{ route('practice-matches.index') }}"
                           class="ig-btn ig-btn-secondary">
                            Cancel
                        </a>

                    </div>

                </form>

            </div>
        </div>

    </div>
</x-app-layout>