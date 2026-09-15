<x-app-layout>
    <div class="ig-content">

        {{-- Page Header --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <h1 class="ig-title">Enrollments</h1>
                <p class="ig-subtitle">
                    Manage student course enrollments and enrollment status.
                </p>
            </div>

            <a href="{{ route('enrollments.create') }}" class="ig-btn ig-btn-primary">
                + New Enrollment
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
                            Total Enrollments
                        </div>

                        <div class="mt-2"
                             style="font-size: 30px; font-weight: 800; color: var(--ig-text);">
                            {{ $enrollments->total() }}
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
                            {{ $enrollments->count() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Enrollments Table --}}
        <div class="ig-table-wrap">

            <div class="ig-card-header">
                <div>
                    <h2>Enrollment Directory</h2>
                    <div class="small mt-1" style="color: var(--ig-muted);">
                        Student course enrollments currently registered in the academy.
                    </div>
                </div>
            </div>

            @if ($enrollments->count())

                <div class="table-responsive">
                    <table class="ig-table">

                        <thead>
                            <tr>
                                <th>Student</th>
                                <th>Team</th>
                                <th>Course</th>
                                <th>Enrolled</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($enrollments as $enrollment)

                                <tr>

                                    <td>
                                        <strong>
                                            {{ $enrollment->student?->user?->name ?? 'Unknown Student' }}
                                        </strong>

                                        <div class="small mt-1"
                                             style="color: var(--ig-muted);">
                                            {{ $enrollment->student?->student_id ?? 'No ID' }}
                                        </div>
                                    </td>

                                    <td>
                                        @if ($enrollment->student?->team)
                                            <span class="ig-badge ig-badge-blue">
                                                {{ $enrollment->student->team->name }}
                                            </span>
                                        @else
                                            <span style="color: var(--ig-muted);">
                                                Unassigned
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        <strong>
                                            {{ $enrollment->course?->name ?? 'Unknown Course' }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $enrollment->enrolled_at?->format('M d, Y') ?? '—' }}
                                    </td>

                                    <td>

                                        @if ($enrollment->status === 'active')

                                            <span class="ig-badge ig-badge-green">
                                                Active
                                            </span>

                                        @elseif ($enrollment->status === 'completed')

                                            <span class="ig-badge ig-badge-blue">
                                                Completed
                                            </span>

                                        @else

                                            <span class="ig-badge ig-badge-red">
                                                Cancelled
                                            </span>

                                        @endif

                                    </td>

                                    <td>
                                        <div class="d-flex justify-content-end gap-2">

                                            <a href="{{ route('enrollments.show', $enrollment) }}"
                                               class="ig-btn ig-btn-secondary">
                                                View
                                            </a>

                                            <a href="{{ route('enrollments.edit', $enrollment) }}"
                                               class="ig-btn ig-btn-secondary">
                                                Edit
                                            </a>

                                            <form method="POST"
                                                  action="{{ route('enrollments.destroy', $enrollment) }}"
                                                  onsubmit="return confirm('Are you sure you want to delete this enrollment?');">
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
                        No Enrollments Yet
                    </h3>

                    <p style="color: var(--ig-muted);">
                        Create the first student course enrollment to get started.
                    </p>

                    <a href="{{ route('enrollments.create') }}"
                       class="ig-btn ig-btn-primary mt-2">
                        + New Enrollment
                    </a>

                </div>

            @endif

        </div>

        {{-- Pagination --}}
        @if ($enrollments->hasPages())
            <div class="mt-4">
                {{ $enrollments->links() }}
            </div>
        @endif

    </div>
</x-app-layout>