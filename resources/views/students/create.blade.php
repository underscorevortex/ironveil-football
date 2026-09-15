<x-app-layout>

    <div class="ig-content">

        {{-- Page Header --}}
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">

            <div>
                <h1 class="ig-title">Add Student</h1>

                <p class="ig-subtitle">
                    Register a new academy player.
                </p>
            </div>

            <a href="{{ route('students.index') }}"
               class="ig-btn ig-btn-secondary">
                ← Back to Students
            </a>

        </div>


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


        {{-- Student Form --}}
        <div class="ig-card">

            <div class="ig-card-header">
                <div>
                    <h2>Student Information</h2>

                    <div class="small mt-1"
                         style="color: var(--ig-muted);">
                        Enter the player's basic academy information.
                    </div>
                </div>
            </div>


            <div class="ig-card-body">

                <form method="POST"
                      action="{{ route('students.store') }}">

                    @csrf

                    <div class="row g-4">

                        {{-- Name --}}
                        <div class="col-12">

                            <label for="name" class="ig-label">
                                Full Name
                            </label>

                            <input
                                id="name"
                                type="text"
                                name="name"
                                value="{{ old('name') }}"
                                class="ig-input"
                                placeholder="Enter student's full name"
                                required
                                autofocus
                            >

                            @error('name')
                                <div class="small mt-1"
                                     style="color: #f87171;">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Email --}}
                        <div class="col-12 col-md-6">

                            <label for="email" class="ig-label">
                                Email
                            </label>

                            <input
                                id="email"
                                type="email"
                                name="email"
                                value="{{ old('email') }}"
                                class="ig-input"
                                placeholder="student@example.com"
                                required
                            >

                            @error('email')
                                <div class="small mt-1"
                                     style="color: #f87171;">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Student ID --}}
                        <div class="col-12 col-md-6">

                            <label for="student_id" class="ig-label">
                                Student ID
                            </label>

                            <input
                                id="student_id"
                                type="text"
                                name="student_id"
                                value="{{ old('student_id') }}"
                                class="ig-input"
                                placeholder="IFA-006"
                                required
                            >

                            @error('student_id')
                                <div class="small mt-1"
                                     style="color: #f87171;">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Phone --}}
                        <div class="col-12 col-md-6">

                            <label for="phone" class="ig-label">
                                Phone
                            </label>

                            <input
                                id="phone"
                                type="text"
                                name="phone"
                                value="{{ old('phone') }}"
                                class="ig-input"
                                placeholder="+92..."
                            >

                            @error('phone')
                                <div class="small mt-1"
                                     style="color: #f87171;">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Date of Birth --}}
                        <div class="col-12 col-md-6">

                            <label for="date_of_birth" class="ig-label">
                                Date of Birth
                            </label>

                            <input
                                id="date_of_birth"
                                type="date"
                                name="date_of_birth"
                                value="{{ old('date_of_birth') }}"
                                class="ig-input"
                            >

                            @error('date_of_birth')
                                <div class="small mt-1"
                                     style="color: #f87171;">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Team --}}
                        <div class="col-12">

                            <label for="team_id" class="ig-label">
                                Team
                            </label>

                            <select
                                id="team_id"
                                name="team_id"
                                class="ig-select"
                            >

                                <option value="">
                                    Select team
                                </option>

                                @foreach ($teams as $team)

                                    <option
                                        value="{{ $team->id }}"
                                        @selected(old('team_id') == $team->id)
                                    >
                                        {{ $team->name }}
                                    </option>

                                @endforeach

                            </select>

                            @error('team_id')
                                <div class="small mt-1"
                                     style="color: #f87171;">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>


                        {{-- Address --}}
                        <div class="col-12">

                            <label for="address" class="ig-label">
                                Address
                            </label>

                            <textarea
                                id="address"
                                name="address"
                                rows="4"
                                class="ig-textarea"
                                placeholder="Enter student's address"
                            >{{ old('address') }}</textarea>

                            @error('address')
                                <div class="small mt-1"
                                     style="color: #f87171;">
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                    </div>


                    {{-- Account Notice --}}
                    <div class="ig-alert ig-alert-success mt-4 mb-0">

                        <strong>Student account</strong>

                        <div class="mt-1">
                            A login account will automatically be created
                            for this student.
                            The initial password is
                            <strong>password</strong>.
                        </div>

                    </div>


                    {{-- Actions --}}
                    <div class="d-flex justify-content-end gap-2 mt-4">

                        <a href="{{ route('students.index') }}"
                           class="ig-btn ig-btn-secondary">
                            Cancel
                        </a>

                        <button type="submit"
                                class="ig-btn ig-btn-primary">
                            Add Student
                        </button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout> 