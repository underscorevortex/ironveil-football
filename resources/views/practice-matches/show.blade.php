<x-app-layout>
    <div class="ig-content">

        {{-- Header --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

            <div>
                <h1 class="ig-title">Practice Match</h1>

                <p class="ig-subtitle">
                    View complete information about this academy match.
                </p>
            </div>

            <div class="d-flex gap-2">

                <a href="{{ route('practice-matches.edit', $practiceMatch) }}"
                   class="ig-btn ig-btn-secondary">
                    Edit Match
                </a>

                <form method="POST"
                      action="{{ route('practice-matches.destroy', $practiceMatch) }}"
                      onsubmit="return confirm('Are you sure you want to delete this match?');">
                    @csrf
                    @method('DELETE')

                    <button type="submit"
                            class="ig-btn ig-btn-danger">
                        Delete
                    </button>
                </form>

            </div>

        </div>

        {{-- Match Hero Card --}}
        <div class="ig-card mb-4">

            <div class="ig-card-body text-center py-5">

                <div style="font-size: 46px; margin-bottom: 14px;">
                    ⚽
                </div>

                <div class="small text-uppercase fw-bold mb-2"
                     style="color: var(--ig-muted);">
                    Practice Match
                </div>

                <h2 style="color: var(--ig-text); font-size: 28px; font-weight: 800;">
                    {{ $practiceMatch->team?->name ?? 'Academy Team' }}
                    <span style="color: var(--ig-green); margin: 0 8px;">
                        VS
                    </span>
                    {{ $practiceMatch->opponent }}
                </h2>

                @if ($practiceMatch->status === 'scheduled')
                    <span class="ig-badge ig-badge-green mt-2">
                        Scheduled
                    </span>
                @elseif ($practiceMatch->status === 'completed')
                    <span class="ig-badge ig-badge-blue mt-2">
                        Completed
                    </span>
                @else
                    <span class="ig-badge mt-2">
                        Cancelled
                    </span>
                @endif

            </div>

        </div>

        {{-- Match Details --}}
        <div class="row g-4">

            {{-- Date & Time --}}
            <div class="col-md-6">

                <div class="ig-card h-100">

                    <div class="ig-card-header">
                        <h2>Date & Time</h2>
                    </div>

                    <div class="ig-card-body">

                        <div class="mb-3">
                            <div class="ig-label">
                                Match Date
                            </div>

                            <div style="color: var(--ig-text); font-size: 18px; font-weight: 700;">
                                {{ $practiceMatch->match_date?->format('d F Y') ?? '—' }}
                            </div>
                        </div>

                        <div>
                            <div class="ig-label">
                                Match Time
                            </div>

                            <div style="color: var(--ig-text); font-size: 18px; font-weight: 700;">
                                {{ $practiceMatch->match_time
                                    ? \Carbon\Carbon::parse($practiceMatch->match_time)->format('h:i A')
                                    : '—' }}
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            {{-- Team & Coach --}}
            <div class="col-md-6">

                <div class="ig-card h-100">

                    <div class="ig-card-header">
                        <h2>Team & Coach</h2>
                    </div>

                    <div class="ig-card-body">

                        <div class="mb-3">
                            <div class="ig-label">
                                Team
                            </div>

                            <div>
                                @if ($practiceMatch->team)
                                    <span class="ig-badge ig-badge-blue">
                                        {{ $practiceMatch->team->name }}
                                    </span>
                                @else
                                    <span style="color: var(--ig-muted);">
                                        —
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div>
                            <div class="ig-label">
                                Coach
                            </div>

                            <div style="color: var(--ig-text); font-size: 18px; font-weight: 700;">
                                {{ $practiceMatch->coach?->name ?? '—' }}
                            </div>
                        </div>

                    </div>

                </div>

            </div>

            {{-- Venue --}}
            <div class="col-md-6">

                <div class="ig-card h-100">

                    <div class="ig-card-header">
                        <h2>Venue</h2>
                    </div>

                    <div class="ig-card-body">

                        <div class="ig-label">
                            Match Location
                        </div>

                        <div style="color: var(--ig-text); font-size: 18px; font-weight: 700;">
                            {{ $practiceMatch->venue }}
                        </div>

                    </div>

                </div>

            </div>

            {{-- Result --}}
            <div class="col-md-6">

                <div class="ig-card h-100">

                    <div class="ig-card-header">
                        <h2>Result</h2>
                    </div>

                    <div class="ig-card-body">

                        <div class="ig-label">
                            Match Result
                        </div>

                        <div style="color: var(--ig-green); font-size: 30px; font-weight: 800;">
                            {{ $practiceMatch->result ?? 'Not played yet' }}
                        </div>

                    </div>

                </div>

            </div>

        </div>

        {{-- Back --}}
        <div class="mt-4">

            <a href="{{ route('practice-matches.index') }}"
               class="ig-btn ig-btn-secondary">
                ← Back to Matches
            </a>

        </div>

    </div>
</x-app-layout>