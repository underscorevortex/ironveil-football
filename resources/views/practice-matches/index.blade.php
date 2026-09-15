<x-app-layout>
    <div class="ig-content">

        {{-- Page Header --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <h1 class="ig-title">Practice Matches</h1>
                <p class="ig-subtitle">
                    Manage academy practice matches, opponents, venues, and results.
                </p>
            </div>

            <a href="{{ route('practice-matches.create') }}" class="ig-btn ig-btn-primary">
                + Add Match
            </a>
        </div>

        {{-- Success Message --}}
        @if (session('success'))
            <div class="ig-alert ig-alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Validation Errors --}}
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

        {{-- Statistics --}}
        <div class="row g-3 mb-4">

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="ig-card h-100">
                    <div class="ig-card-body">
                        <div class="text-uppercase small fw-bold"
                             style="color: var(--ig-muted);">
                            Total Matches
                        </div>

                        <div class="mt-2"
                             style="font-size: 30px; font-weight: 800; color: var(--ig-text);">
                            {{ $matches->total() }}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-sm-6 col-xl-3">
                <div class="ig-card h-100">
                    <div class="ig-card-body">
                        <div class="text-uppercase small fw-bold"
                             style="color: var(--ig-muted);">
                            Showing
                        </div>

                        <div class="mt-2"
                             style="font-size: 30px; font-weight: 800; color: var(--ig-green);">
                            {{ $matches->count() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Matches Table --}}
        <div class="ig-table-wrap">

            <div class="ig-card-header">
                <div>
                    <h2>Match Schedule</h2>

                    <div class="small mt-1" style="color: var(--ig-muted);">
                        Practice matches currently registered in the academy.
                    </div>
                </div>
            </div>

            @if ($matches->count())

                <div class="table-responsive">
                    <table class="ig-table">

                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Team</th>
                                <th>Opponent</th>
                                <th>Coach</th>
                                <th>Venue</th>
                                <th>Status</th>
                                <th>Result</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($matches as $match)

                                <tr>

                                    <td>
                                        <strong>
                                            {{ $match->match_date?->format('d M Y') ?? '—' }}
                                        </strong>

                                        @if ($match->match_time)
                                            <div class="small" style="color: var(--ig-muted);">
                                                {{ \Carbon\Carbon::parse($match->match_time)->format('h:i A') }}
                                            </div>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($match->team)
                                            <span class="ig-badge ig-badge-blue">
                                                {{ $match->team->name }}
                                            </span>
                                        @else
                                            <span style="color: var(--ig-muted);">
                                                —
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        <strong>
                                            {{ $match->opponent }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $match->coach?->name ?? '—' }}
                                    </td>

                                    <td>
                                        {{ $match->venue }}
                                    </td>

                                    <td>
                                        @if ($match->status === 'scheduled')
                                            <span class="ig-badge ig-badge-green">
                                                Scheduled
                                            </span>
                                        @elseif ($match->status === 'completed')
                                            <span class="ig-badge ig-badge-blue">
                                                Completed
                                            </span>
                                        @else
                                            <span class="ig-badge">
                                                Cancelled
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ $match->result ?? '—' }}
                                    </td>

                                    <td>
                                        <div class="d-flex justify-content-end gap-2">

                                            <a href="{{ route('practice-matches.show', $match) }}"
                                               class="ig-btn ig-btn-secondary">
                                                View
                                            </a>

                                            <a href="{{ route('practice-matches.edit', $match) }}"
                                               class="ig-btn ig-btn-secondary">
                                                Edit
                                            </a>

                                            <form method="POST"
                                                  action="{{ route('practice-matches.destroy', $match) }}"
                                                  onsubmit="return confirm('Are you sure you want to delete this match?');">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit"
                                                        class="ig-btn ig-btn-danger">
                                                    Delete
                                                </button>
                                            </form>

                                        </div>
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>
                </div>

            @else

                <div class="ig-card-body text-center py-5">

                    <div style="font-size: 42px; margin-bottom: 12px;">
                        ⚽
                    </div>

                    <h3 style="color: var(--ig-text); font-weight: 750;">
                        No Practice Matches Yet
                    </h3>

                    <p style="color: var(--ig-muted);">
                        Create your first practice match to get started.
                    </p>

                    <a href="{{ route('practice-matches.create') }}"
                       class="ig-btn ig-btn-primary mt-2">
                        + Add Match
                    </a>

                </div>

            @endif

        </div>

        {{-- Pagination --}}
        @if ($matches->hasPages())
            <div class="mt-4">
                {{ $matches->links() }}
            </div>
        @endif

    </div>
</x-app-layout>