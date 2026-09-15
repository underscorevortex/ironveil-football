<x-app-layout>

    <div class="ig-content">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <h1 class="ig-title">Add Course</h1>
                <p class="ig-subtitle">Create a new academy training course.</p>
            </div>

            <a href="{{ route('courses.index') }}" class="ig-btn ig-btn-secondary">
                ← Back to Courses
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
                    <h2>Course Information</h2>
                    <div class="small mt-1" style="color: var(--ig-muted);">
                        Define the course, team, and training capacity.
                    </div>
                </div>
            </div>

            <div class="ig-card-body">

                <form method="POST" action="{{ route('courses.store') }}">
                    @csrf

                    <div class="row g-4">

                        <div class="col-12 col-md-6">
                            <label for="name" class="ig-label">
                                Course Name
                            </label>

                            <input
                                id="name"
                                name="name"
                                type="text"
                                class="ig-input"
                                value="{{ old('name') }}"
                                placeholder="e.g. Ball Control"
                                required
                            >

                            @error('name')
                                <div class="ig-field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="code" class="ig-label">
                                Course Code
                            </label>

                            <input
                                id="code"
                                name="code"
                                type="text"
                                class="ig-input"
                                value="{{ old('code') }}"
                                placeholder="e.g. IFA-BC"
                                required
                            >

                            @error('code')
                                <div class="ig-field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="department_id" class="ig-label">
                                Team
                            </label>

                            <select
                                id="department_id"
                                name="department_id"
                                class="ig-select"
                                required
                            >
                                <option value="">Select Team</option>

                                @foreach ($teams as $team)
                                    <option
                                        value="{{ $team->id }}"
                                        @selected(old('department_id') == $team->id)
                                    >
                                        {{ $team->name }}
                                    </option>
                                @endforeach
                            </select>

                            @error('department_id')
                                <div class="ig-field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="capacity" class="ig-label">
                                Capacity
                            </label>

                            <input
                                id="capacity"
                                name="capacity"
                                type="number"
                                min="1"
                                max="500"
                                class="ig-input"
                                value="{{ old('capacity', 20) }}"
                                required
                            >

                            @error('capacity')
                                <div class="ig-field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12">
                            <label for="description" class="ig-label">
                                Description
                            </label>

                            <textarea
                                id="description"
                                name="description"
                                rows="5"
                                class="ig-textarea"
                                placeholder="Describe the training course..."
                            >{{ old('description') }}</textarea>

                            @error('description')
                                <div class="ig-field-error">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">

                        <a href="{{ route('courses.index') }}"
                           class="ig-btn ig-btn-secondary">
                            Cancel
                        </a>

                        <button type="submit"
                                class="ig-btn ig-btn-primary">
                            Add Course
                        </button>

                    </div>

                </form>

            </div>
        </div>

    </div>

</x-app-layout>