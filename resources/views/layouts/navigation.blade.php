<nav class="ig-nav">
    <div class="ig-nav-inner">

        <a href="{{ route('dashboard') }}" class="ig-brand">
            <div class="ig-brand-mark">IG</div>

            <div class="ig-brand-text">
                <span>IRON<span>GATE</span></span>
                <small>FOOTBALL ACADEMY</small>
            </div>
        </a>

        <div class="ig-nav-links">

            <a href="{{ route('dashboard') }}"
               class="ig-nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Dashboard
            </a>

            <a href="{{ route('students.index') }}"
               class="ig-nav-link {{ request()->routeIs('students.*') ? 'active' : '' }}">
                Students
            </a>

            <a href="{{ route('coaches.index') }}"
               class="ig-nav-link {{ request()->routeIs('coaches.*') ? 'active' : '' }}">
                Coaches
            </a>

            <a href="{{ route('teams.index') }}"
               class="ig-nav-link {{ request()->routeIs('teams.*') ? 'active' : '' }}">
                Teams
            </a>

            <a href="{{ route('courses.index') }}"
               class="ig-nav-link {{ request()->routeIs('courses.*') ? 'active' : '' }}">
                Courses
            </a>

            <a href="{{ route('enrollments.index') }}"
               class="ig-nav-link {{ request()->routeIs('enrollments.*') ? 'active' : '' }}">
                Enrollments
            </a>

            <a href="{{ route('practice-matches.index') }}"
               class="ig-nav-link {{ request()->routeIs('practice-matches.*') ? 'active' : '' }}">
                Matches
            </a>

            <a href="{{ route('api.demo') }}"
               class="ig-nav-link {{ request()->routeIs('api.demo') ? 'active' : '' }}">
                API Demo
            </a>

        </div>

        <div class="ig-user-area">

            <a href="{{ route('profile.edit') }}" class="ig-user">
                <div class="ig-avatar">
                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                </div>

                <div class="ig-user-info">
                    <strong>{{ auth()->user()->name }}</strong>
                    <span>{{ ucfirst(auth()->user()->role ?? 'student') }}</span>
                </div>
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf

                <button type="submit" class="ig-logout">
                    Logout
                </button>
            </form>

        </div>

    </div>
</nav>