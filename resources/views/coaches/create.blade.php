<x-app-layout>

    <div class="ig-content">

        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
            <div>
                <h1 class="ig-title">Add Coach</h1>
                <p class="ig-subtitle">Register a new academy coach.</p>
            </div>

            <a href="{{ route('coaches.index') }}" class="ig-btn ig-btn-secondary">
                ← Back to Coaches
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
                    <h2>Coach Information</h2>
                    <div class="small mt-1" style="color: var(--ig-muted);">
                        Enter the coach's academy and contact information.
                    </div>
                </div>
            </div>

            <div class="ig-card-body">

                <form method="POST" action="{{ route('coaches.store') }}">
                    @csrf

                    <div class="row g-4">

                        <div class="col-12 col-md-6">
                            <label for="name" class="ig-label">Full Name</label>
                            <input
                                id="name"
                                name="name"
                                type="text"
                                class="ig-input"
                                value="{{ old('name') }}"
                                placeholder="Enter coach name"
                                required
                            >

                            @error('name')
                                <div class="ig-field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="email" class="ig-label">Email</label>
                            <input
                                id="email"
                                name="email"
                                type="email"
                                class="ig-input"
                                value="{{ old('email') }}"
                                placeholder="coach@example.com"
                                required
                            >

                            @error('email')
                                <div class="ig-field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="phone" class="ig-label">Phone</label>
                            <input
                                id="phone"
                                name="phone"
                                type="text"
                                class="ig-input"
                                value="{{ old('phone') }}"
                                placeholder="+92..."
                            >

                            @error('phone')
                                <div class="ig-field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="specialization" class="ig-label">
                                Specialization
                            </label>

                            <input
                                id="specialization"
                                name="specialization"
                                type="text"
                                class="ig-input"
                                value="{{ old('specialization') }}"
                                placeholder="e.g. Goalkeeping"
                            >

                            @error('specialization')
                                <div class="ig-field-error">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-12 col-md-6">
                            <label for="department_id" class="ig-label">
                                Assigned Team
                            </label>

                            <select
                                id="department_id"
                                name="department_id"
                                class="ig-select"
                            >
                                <option value="">Unassigned</option>

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
                            <label for="status" class="ig-label">Status</label>

                            <select
                                id="status"
                                name="status"
                                class="ig-select"
                                required
                            >
                                <option value="1"
                                    @selected(old('status', '1') == '1')>
                                    Active
                                </option>

                                <option value="0"
                                    @selected(old('status') === '0')>
                                    Inactive
                                </option>
                            </select>

                            @error('status')
                                <div class="ig-field-error">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <div class="ig-alert ig-alert-success mt-4 mb-0">
                        <strong>Coach account</strong>

                        <div class="mt-1">
                            A login account will automatically be created.
                            The initial password is
                            <strong>password</strong>.
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-4">

                        <a href="{{ route('coaches.index') }}"
                           class="ig-btn ig-btn-secondary">
                            Cancel
                        </a>

                        <button type="submit"
                                class="ig-btn ig-btn-primary">
                            Add Coach
                        </button>

                    </div>

                </form>

            </div>
        </div>

    </div>

</x-app-layout>