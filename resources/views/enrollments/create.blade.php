<x-app-layout>

    <div class="ig-content">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <h1 class="ig-title">New Enrollment</h1>
                <p class="ig-subtitle">
                    Enroll a student in an academy training course.
                </p>
            </div>

            <a href="{{ route('enrollments.index') }}"
               class="ig-btn ig-btn-secondary">
                ← Back to Enrollments
            </a>
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
                    <h2>Enrollment Information</h2>
                    <div class="small mt-1" style="color: var(--ig-muted);">
                        Select the student, course, enrollment date, and status.
                    </div>
                </div>
            </div>

            <div class="ig-card-body">

                <form method="POST" action="{{ route('enrollments.store') }}">
                    @csrf

                    <div class="row g-4">

                        <div class="col-12">
                            <label for="student_id" class="ig-label">
                                Student
                            </label>

                            <select
                                id="student_id"
                                name="student_id"
                                class="ig-select"
                                required
                            >
                                <option value="">Select Student</option>

                                @foreach ($students as $student)
                                    <option
                                        value="{{ $student->id }}"
                                        @selected(old('student_id') == $student->id)
                                    >
                                        {{ $student->student_id }}
                                        — {{ $student->user?->name }}

                                        @if ($student->team)
                                            ({{ $student->team->name }})
                                        @endif
                                    </option>
                                @endforeach
                            </select>

                            @error('student_id')
                                <div class="ig-field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="course_id" class="ig-label">
                                Course
                            </label>

                            <select
                                id="course_id"
                                name="course_id"
                                class="ig-select"
                                required
                            >
                                <option value="">Select Course</option>

                                @foreach ($courses as $course)
                                    <option
                                        value="{{ $course->id }}"
                                        @selected(old('course_id') == $course->id)
                                    >
                                        {{ $course->name }}
                                        — {{ $course->code }}
                                        — {{ $course->department?->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('course_id')
                                <div class="ig-field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="enrolled_at" class="ig-label">
                                Enrollment Date
                            </label>

                            <input
                                id="enrolled_at"
                                name="enrolled_at"
                                type="date"
                                class="ig-input"
                                value="{{ old('enrolled_at', now()->format('Y-m-d')) }}"
                                required
                            >

                            @error('enrolled_at')
                                <div class="ig-field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="status" class="ig-label">
                                Status
                            </label>

                            <select
                                id="status"
                                name="status"
                                class="ig-select"
                                required
                            >
                                <option value="active"
                                    @selected(old('status', 'active') === 'active')>
                                    Active
                                </option>

                                <option value="completed"
                                    @selected(old('status') === 'completed')>
                                    Completed
                                </option>

                                <option value="cancelled"
                                    @selected(old('status') === 'cancelled')>
                                    Cancelled
                                </option>
                            </select>

                            @error('status')
                                <div class="ig-field-error">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">

                        <a href="{{ route('enrollments.index') }}"
                           class="ig-btn ig-btn-secondary">
                            Cancel
                        </a>

                        <button type="submit"
                                class="ig-btn ig-btn-primary">
                            Enroll Student
                        </button>

                    </div>

                </form>

            </div>
        </div>

    </div>

</x-app-layout>