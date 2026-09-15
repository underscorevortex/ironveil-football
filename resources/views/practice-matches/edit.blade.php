<x-app-layout>
    <div class="ig-content">

        <div class="mb-4">
            <h1 class="ig-title">Edit Practice Match</h1>
            <p class="ig-subtitle">
                Update the details of this practice match.
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
                        Modify the scheduled match information below.
                    </div>
                </div>
            </div>

            <div class="ig-card-body">

                <form method="POST"
                      action="{{ route('practice-matches.update', $practiceMatch) }}">
                    @csrf
                    @method('PUT')

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
                                        {{ old('coach_id', $practiceMatch->coach_id) == $coach->id ? 'selected' : '' }}>
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
                                        {{ old('team_id', $practiceMatch->team_id) == $team->id ? 'selected' : '' }}>
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
                                   value="{{ old('opponent', $practiceMatch->opponent) }}"
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
                                   value="{{ old('venue', $practiceMatch->venue) }}"
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
                                   value="{{ old('match_date', optional($practiceMatch->match_date)->format('Y-m-d')) }}"
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
                                   value="{{ old('match_time', $practiceMatch->match_time) }}"
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
                                    {{ old('status', $practiceMatch->status) === 'scheduled' ? 'selected' : '' }}>
                                    Scheduled
                                </option>

                                <option value="completed"
                                    {{ old('status', $practiceMatch->status) === 'completed' ? 'selected' : '' }}>
                                    Completed
                                </option>

                                <option value="cancelled"
                                    {{ old('status', $practiceMatch->status) === 'cancelled' ? 'selected' : '' }}>
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
                                   value="{{ old('result', $practiceMatch->result) }}"
                                   placeholder="e.g. 3 - 1">

                            @error('result')
                                <div class="ig-field-error">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="d-flex flex-wrap gap-2 mt-4">

                        <button type="submit"
                                class="ig-btn ig-btn-primary">
                            Save Changes
                        </button>

                        <a href="{{ route('practice-matches.show', $practiceMatch) }}"
                           class="ig-btn ig-btn-secondary">
                            Cancel
                        </a>

                    </div>

                </form>

            </div>
        </div>

    </div>
</x-app-layout>