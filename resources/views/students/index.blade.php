<x-app-layout>
    <div class="ig-content">

        {{-- Page Header --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <h1 class="ig-title">Students</h1>
                <p class="ig-subtitle">
                    Manage IronGate Football Academy students and team assignments.
                </p>
            </div>

            <a href="{{ route('students.create') }}" class="ig-btn ig-btn-primary">
                + Add Student
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
                            Total Students
                        </div>

                        <div class="mt-2"
                             style="font-size: 30px; font-weight: 800; color: var(--ig-text);">
                            {{ $students->total() }}
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
                            {{ $students->count() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Students Table --}}
        <div class="ig-table-wrap">

            <div class="ig-card-header">
                <div>
                    <h2>Student Directory</h2>
                    <div class="small mt-1" style="color: var(--ig-muted);">
                        Student records currently registered in the academy.
                    </div>
                </div>
            </div>

            @if ($students->count())

                <div class="table-responsive">
                    <table class="ig-table">

                        <thead>
                            <tr>
                                <th>Student ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Team</th>
                                <th>Phone</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($students as $student)

                                <tr>

                                    <td>
                                        <span class="ig-badge ig-badge-green">
                                            {{ $student->student_id }}
                                        </span>
                                    </td>

                                    <td>
                                        <strong>
                                            {{ $student->user?->name ?? '—' }}
                                        </strong>
                                    </td>

                                    <td>
                                        {{ $student->user?->email ?? '—' }}
                                    </td>

                                    <td>
                                        @if ($student->team)
                                            <span class="ig-badge ig-badge-blue">
                                                {{ $student->team->name }}
                                            </span>
                                        @else
                                            <span style="color: var(--ig-muted);">
                                                No team
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        {{ $student->phone ?? '—' }}
                                    </td>

                                    <td>
                                        <div class="d-flex justify-content-end gap-2">

                                            <a href="{{ route('students.show', $student) }}"
                                               class="ig-btn ig-btn-secondary">
                                                View
                                            </a>

                                            <a href="{{ route('students.edit', $student) }}"
                                               class="ig-btn ig-btn-secondary">
                                                Edit
                                            </a>

                                            <form method="POST"
                                                  action="{{ route('students.destroy', $student) }}"
                                                  onsubmit="return confirm('Are you sure you want to delete this student?');">
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
                        No Students Yet
                    </h3>

                    <p style="color: var(--ig-muted);">
                        Add your first academy student to get started.
                    </p>

                    <a href="{{ route('students.create') }}"
                       class="ig-btn ig-btn-primary mt-2">
                        + Add Student
                    </a>

                </div>

            @endif

        </div>

        {{-- Pagination --}}
        @if ($students->hasPages())
            <div class="mt-4">
                {{ $students->links() }}
            </div>
        @endif

    </div>
</x-app-layout>