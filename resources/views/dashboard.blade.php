<x-app-layout>

    <x-slot name="header">
        <div>
            <h2 class="ig-title">IronGate Football Academy</h2>
            <p class="ig-subtitle">Management Dashboard</p>
        </div>
    </x-slot>

    <div class="ig-content">

        {{-- Welcome --}}
        <div class="mb-4">
            <h1 class="ig-title">
                Welcome back, {{ Auth::user()->name }}
            </h1>

            <p class="ig-subtitle">
                Here's what's happening at IronGate today.
            </p>
        </div>


        {{-- Statistics --}}
        <div class="row g-4 mb-5">

            {{-- Students --}}
            <div class="col-12 col-sm-6 col-xl-2">
                <div class="ig-card h-100">
                    <div class="ig-card-body">

                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="ig-label">Students</div>

                                <div class="ig-stat-number">
                                    {{ \App\Models\Student::count() }}
                                </div>
                            </div>

                            <div class="ig-stat-icon">
                                👥
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            {{-- Coaches --}}
            <div class="col-12 col-sm-6 col-xl-2">
                <div class="ig-card h-100">
                    <div class="ig-card-body">

                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="ig-label">Coaches</div>

                                <div class="ig-stat-number">
                                    {{ \App\Models\Coach::count() }}
                                </div>
                            </div>

                            <div class="ig-stat-icon">
                                🧑‍🏫
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            {{-- Teams --}}
            <div class="col-12 col-sm-6 col-xl-2">
                <div class="ig-card h-100">
                    <div class="ig-card-body">

                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="ig-label">Teams</div>

                                <div class="ig-stat-number">
                                    {{ \App\Models\Department::count() }}
                                </div>
                            </div>

                            <div class="ig-stat-icon">
                                🏆
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            {{-- Courses --}}
            <div class="col-12 col-sm-6 col-xl-2">
                <div class="ig-card h-100">
                    <div class="ig-card-body">

                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="ig-label">Courses</div>

                                <div class="ig-stat-number">
                                    {{ \App\Models\Course::count() }}
                                </div>
                            </div>

                            <div class="ig-stat-icon">
                                ⚽
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            {{-- Enrollments --}}
            <div class="col-12 col-sm-6 col-xl-2">
                <div class="ig-card h-100">
                    <div class="ig-card-body">

                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="ig-label">Enrollments</div>

                                <div class="ig-stat-number">
                                    {{ \App\Models\Enrollment::count() }}
                                </div>
                            </div>

                            <div class="ig-stat-icon">
                                📋
                            </div>
                        </div>

                    </div>
                </div>
            </div>


            {{-- Matches --}}
            <div class="col-12 col-sm-6 col-xl-2">
                <div class="ig-card h-100">
                    <div class="ig-card-body">

                        <div class="d-flex justify-content-between align-items-center">
                            <div>
                                <div class="ig-label">Matches</div>

                                <div class="ig-stat-number">
                                    {{ \App\Models\PracticeMatch::count() }}
                                </div>
                            </div>

                            <div class="ig-stat-icon">
                                🏟️
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>


        {{-- Academy Management --}}
        <div class="mb-4">

            <div class="mb-4">
                <h2 class="ig-section-title">
                    Academy Management
                </h2>

                <p class="ig-subtitle">
                    Manage the main areas of IronGate Football Academy.
                </p>
            </div>


            {{-- Management Cards --}}
            <div class="row g-4">


                {{-- Students --}}
                <div class="col-12 col-md-6 col-xl-4">

                    <a href="{{ route('students.index') }}"
                       class="ig-management-card">

                        <div class="ig-management-icon">
                            👥
                        </div>

                        <div>
                            <h3>Manage Students</h3>

                            <p>
                                Add, edit and manage academy players.
                            </p>
                        </div>

                        <span class="ig-management-arrow">
                            →
                        </span>

                    </a>

                </div>


                {{-- Coaches --}}
                <div class="col-12 col-md-6 col-xl-4">

                    <a href="{{ route('coaches.index') }}"
                       class="ig-management-card">

                        <div class="ig-management-icon">
                            🧑‍🏫
                        </div>

                        <div>
                            <h3>Manage Coaches</h3>

                            <p>
                                Manage academy coaching staff.
                            </p>
                        </div>

                        <span class="ig-management-arrow">
                            →
                        </span>

                    </a>

                </div>


                {{-- Teams --}}
                <div class="col-12 col-md-6 col-xl-4">

                    <a href="{{ route('teams.index') }}"
                       class="ig-management-card">

                        <div class="ig-management-icon">
                            🏆
                        </div>

                        <div>
                            <h3>Manage Teams</h3>

                            <p>
                                Manage academy squads and teams.
                            </p>
                        </div>

                        <span class="ig-management-arrow">
                            →
                        </span>

                    </a>

                </div>


                {{-- Courses --}}
                <div class="col-12 col-md-6 col-xl-4">

                    <a href="{{ route('courses.index') }}"
                       class="ig-management-card">

                        <div class="ig-management-icon">
                            ⚽
                        </div>

                        <div>
                            <h3>Manage Courses</h3>

                            <p>
                                Manage football training courses.
                            </p>
                        </div>

                        <span class="ig-management-arrow">
                            →
                        </span>

                    </a>

                </div>


                {{-- Enrollments --}}
                <div class="col-12 col-md-6 col-xl-4">

                    <a href="{{ route('enrollments.index') }}"
                       class="ig-management-card">

                        <div class="ig-management-icon">
                            📋
                        </div>

                        <div>
                            <h3>Enrollments</h3>

                            <p>
                                Manage player course enrollment.
                            </p>
                        </div>

                        <span class="ig-management-arrow">
                            →
                        </span>

                    </a>

                </div>


                {{-- Practice Matches --}}
                <div class="col-12 col-md-6 col-xl-4">

                    <a href="{{ route('practice-matches.index') }}"
                       class="ig-management-card">

                        <div class="ig-management-icon">
                            🏟️
                        </div>

                        <div>
                            <h3>Practice Matches</h3>

                            <p>
                                Manage academy practice fixtures.
                            </p>
                        </div>

                        <span class="ig-management-arrow">
                            →
                        </span>

                    </a>

                </div>


            </div>

        </div>


        {{-- Account + API --}}
        <div class="row g-4 mt-2">

            {{-- Account --}}
            <div class="col-12 col-lg-6">

                <div class="ig-card h-100">

                    <div class="ig-card-body">

                        <div class="d-flex align-items-center gap-3">

                            <div class="ig-avatar">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>

                            <div>
                                <h3 class="ig-card-title">
                                    {{ Auth::user()->name }}
                                </h3>

                                <p class="ig-subtitle mb-0">
                                    {{ ucfirst(Auth::user()->role) }}
                                </p>
                            </div>

                        </div>


                        <div class="ig-divider"></div>


                        <div>
                            <div class="ig-label">
                                Account Email
                            </div>

                            <div class="mt-1"
                                 style="color: var(--ig-text);">
                                {{ Auth::user()->email }}
                            </div>
                        </div>


                        <div class="mt-4">
                            <span class="ig-badge ig-badge-green">
                                ● Account Verified
                            </span>
                        </div>

                    </div>

                </div>

            </div>


            {{-- API --}}
            <div class="col-12 col-lg-6">

                <div class="ig-card h-100">

                    <div class="ig-card-body">

                        <div class="d-flex align-items-center justify-content-between">

                            <div>
                                <h3 class="ig-card-title">
                                    REST API & AJAX
                                </h3>

                                <p class="ig-subtitle">
                                    Test the academy API endpoints and jQuery AJAX integration.
                                </p>
                            </div>

                            <div class="ig-management-icon">
                                ⚡
                            </div>

                        </div>

                        <a href="{{ route('api.demo') }}"
                           class="ig-btn ig-btn-primary mt-3">
                            Open API Demo →
                        </a>

                    </div>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>