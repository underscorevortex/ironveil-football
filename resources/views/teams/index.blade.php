<x-app-layout>
    <div class="ig-content">

        {{-- Page Header --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <h1 class="ig-title">Teams</h1>
                <p class="ig-subtitle">
                    Manage IronGate Football Academy teams and their training structure.
                </p>
            </div>

            <a href="{{ route('teams.create') }}" class="ig-btn ig-btn-primary">
                + Add Team
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
                            Total Teams
                        </div>

                        <div class="mt-2"
                             style="font-size: 30px; font-weight: 800; color: var(--ig-text);">
                            {{ $teams->total() }}
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
                            {{ $teams->count() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Teams Table --}}
        <div class="ig-table-wrap">

            <div class="ig-card-header">
                <div>
                    <h2>Team Directory</h2>
                    <div class="small mt-1" style="color: var(--ig-muted);">
                        Teams currently registered in the academy.
                    </div>
                </div>
            </div>

            @if ($teams->count())

                <div class="table-responsive">
                    <table class="ig-table">

                        <thead>
                            <tr>
                                <th>Team</th>
                                <th>Description</th>
                                <th>Students</th>
                                <th>Courses</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($teams as $team)

                                <tr>

                                    <td>
                                        <span class="ig-badge ig-badge-blue">
                                            {{ $team->name }}
                                        </span>
                                    </td>

                                    <td>
                                        {{ $team->description ?? '—' }}
                                    </td>

                                    <td>
                                        <strong>
                                            {{ $team->students_count }}
                                        </strong>
                                    </td>

                                    <td>
                                        <strong>
                                            {{ $team->courses_count }}
                                        </strong>
                                    </td>

                                    <td>
                                        <div class="d-flex justify-content-end gap-2">

                                            <a href="{{ route('teams.show', $team) }}"
                                               class="ig-btn ig-btn-secondary">
                                                View
                                            </a>

                                            <a href="{{ route('teams.edit', $team) }}"
                                               class="ig-btn ig-btn-secondary">
                                                Edit
                                            </a>

                                            <form method="POST"
                                                  action="{{ route('teams.destroy', $team) }}"
                                                  onsubmit="return confirm('Are you sure you want to delete this team? Students assigned to it will become unassigned.');">
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
                        No Teams Yet
                    </h3>

                    <p style="color: var(--ig-muted);">
                        Add your first academy team to get started.
                    </p>

                    <a href="{{ route('teams.create') }}"
                       class="ig-btn ig-btn-primary mt-2">
                        + Add Team
                    </a>

                </div>

            @endif

        </div>

        {{-- Pagination --}}
        @if ($teams->hasPages())
            <div class="mt-4">
                {{ $teams->links() }}
            </div>
        @endif

    </div>
</x-app-layout>