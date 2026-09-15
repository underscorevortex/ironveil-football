<x-app-layout>
    <div class="ig-content">

        {{-- Page Header --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <h1 class="ig-title">Coaches</h1>
                <p class="ig-subtitle">
                    Manage IronGate Football Academy coaches and team assignments.
                </p>
            </div>

            <a href="{{ route('coaches.create') }}" class="ig-btn ig-btn-primary">
                + Add Coach
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
                            Total Coaches
                        </div>

                        <div class="mt-2"
                             style="font-size: 30px; font-weight: 800; color: var(--ig-text);">
                            {{ $coaches->total() }}
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
                            {{ $coaches->count() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Coaches Table --}}
        <div class="ig-table-wrap">

            <div class="ig-card-header">
                <div>
                    <h2>Coach Directory</h2>
                    <div class="small mt-1" style="color: var(--ig-muted);">
                        Coaches currently registered with the academy.
                    </div>
                </div>
            </div>

            @if ($coaches->count())

                <div class="table-responsive">
                    <table class="ig-table">

                        <thead>
                            <tr>
                                <th>Coach</th>
                                <th>Email</th>
                                <th>Specialization</th>
                                <th>Team</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($coaches as $coach)

                                <tr>

                                    <td>
                                        <strong>
                                            {{ $coach->name }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $coach->email }}
                                    </td>

                                    <td>
                                        {{ $coach->specialization ?? '—' }}
                                    </td>

                                    <td>
                                        @if ($coach->team)
                                            <span class="ig-badge ig-badge-blue">
                                                {{ $coach->team->name }}
                                            </span>
                                        @else
                                            <span style="color: var(--ig-muted);">
                                                Unassigned
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        @if ($coach->status)
                                            <span class="ig-badge ig-badge-green">
                                                Active
                                            </span>
                                        @else
                                            <span class="ig-badge ig-badge-red">
                                                Inactive
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        <div class="d-flex justify-content-end gap-2">

                                            <a href="{{ route('coaches.show', $coach) }}"
                                               class="ig-btn ig-btn-secondary">
                                                View
                                            </a>

                                            <a href="{{ route('coaches.edit', $coach) }}"
                                               class="ig-btn ig-btn-secondary">
                                                Edit
                                            </a>

                                            <form method="POST"
                                                  action="{{ route('coaches.destroy', $coach) }}"
                                                  onsubmit="return confirm('Are you sure you want to delete this coach?');">
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
                        No Coaches Yet
                    </h3>

                    <p style="color: var(--ig-muted);">
                        Add your first academy coach to get started.
                    </p>

                    <a href="{{ route('coaches.create') }}"
                       class="ig-btn ig-btn-primary mt-2">
                        + Add Coach
                    </a>

                </div>

            @endif

        </div>

        {{-- Pagination --}}
        @if ($coaches->hasPages())
            <div class="mt-4">
                {{ $coaches->links() }}
            </div>
        @endif

    </div>
</x-app-layout>