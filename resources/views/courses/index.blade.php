<x-app-layout>
    <div class="ig-content">

        {{-- Page Header --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <h1 class="ig-title">Courses</h1>
                <p class="ig-subtitle">
                    Manage IronGate Football Academy training courses and capacities.
                </p>
            </div>

            <a href="{{ route('courses.create') }}" class="ig-btn ig-btn-primary">
                + Add Course
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
                            Total Courses
                        </div>

                        <div class="mt-2"
                             style="font-size: 30px; font-weight: 800; color: var(--ig-text);">
                            {{ $courses->total() }}
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
                            {{ $courses->count() }}
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Courses Table --}}
        <div class="ig-table-wrap">

            <div class="ig-card-header">
                <div>
                    <h2>Course Directory</h2>
                    <div class="small mt-1" style="color: var(--ig-muted);">
                        Training courses currently available at the academy.
                    </div>
                </div>
            </div>

            @if ($courses->count())

                <div class="table-responsive">
                    <table class="ig-table">

                        <thead>
                            <tr>
                                <th>Course</th>
                                <th>Code</th>
                                <th>Team</th>
                                <th>Capacity</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($courses as $course)

                                <tr>

                                    <td>
                                        <strong>
                                            {{ $course->name }}
                                        </strong>

                                        <div class="small mt-1"
                                             style="color: var(--ig-muted);">
                                            {{ $course->description ?? 'No description' }}
                                        </div>
                                    </td>

                                    <td>
                                        <span class="ig-badge ig-badge-green">
                                            {{ $course->code }}
                                        </span>
                                    </td>

                                    <td>
                                        @if ($course->department)
                                            <span class="ig-badge ig-badge-blue">
                                                {{ $course->department->name }}
                                            </span>
                                        @else
                                            <span style="color: var(--ig-muted);">
                                                Unassigned
                                            </span>
                                        @endif
                                    </td>

                                    <td>
                                        <strong>
                                            {{ $course->capacity }}
                                        </strong>
                                    </td>

                                    <td>
                                        <div class="d-flex justify-content-end gap-2">

                                            <a href="{{ route('courses.show', $course) }}"
                                               class="ig-btn ig-btn-secondary">
                                                View
                                            </a>

                                            <a href="{{ route('courses.edit', $course) }}"
                                               class="ig-btn ig-btn-secondary">
                                                Edit
                                            </a>

                                            <form method="POST"
                                                  action="{{ route('courses.destroy', $course) }}"
                                                  onsubmit="return confirm('Are you sure you want to delete this course? Existing enrollments will also be removed.');">
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
                        No Courses Yet
                    </h3>

                    <p style="color: var(--ig-muted);">
                        Add your first academy course to get started.
                    </p>

                    <a href="{{ route('courses.create') }}"
                       class="ig-btn ig-btn-primary mt-2">
                        + Add Course
                    </a>

                </div>

            @endif

        </div>

        {{-- Pagination --}}
        @if ($courses->hasPages())
            <div class="mt-4">
                {{ $courses->links() }}
            </div>
        @endif

    </div>
</x-app-layout>