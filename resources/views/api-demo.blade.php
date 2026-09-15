<x-app-layout>

    <div class="ig-content">

        <div class="mb-4">
            <h1 class="ig-title">REST API & AJAX Demo</h1>

            <p class="ig-subtitle">
                Live academy data loaded through Laravel REST API endpoints using jQuery AJAX.
            </p>
        </div>

        <div class="ig-card mb-4">

            <div class="ig-card-header">
                <div>
                    <h2>API Endpoints</h2>

                    <div class="small mt-1" style="color: var(--ig-muted);">
                        Select an endpoint to retrieve live academy data.
                    </div>
                </div>
            </div>

            <div class="ig-card-body">

                <div class="d-flex flex-wrap gap-2">

                    <button type="button"
                            id="loadStudents"
                            class="ig-btn ig-btn-primary">
                        Load Students
                    </button>

                    <button type="button"
                            id="loadTeams"
                            class="ig-btn ig-btn-secondary">
                        Load Teams
                    </button>

                    <button type="button"
                            id="loadCourses"
                            class="ig-btn ig-btn-secondary">
                        Load Courses
                    </button>

                    <button type="button"
                            id="loadMatches"
                            class="ig-btn ig-btn-secondary">
                        Load Matches
                    </button>

                </div>

            </div>
        </div>

        <div id="loading"
             class="ig-alert ig-alert-success"
             style="display:none;">
            Loading API data...
        </div>

        <div id="apiResult"></div>

    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function () {

            const $ = window.jQuery;

            if (!$) {
                document.getElementById('apiResult').innerHTML = `
                    <div class="ig-alert ig-alert-error">
                        jQuery is not available. Please rebuild the Vite assets.
                    </div>
                `;

                return;
            }


            function loadApiData(endpoint, type) {

                $('#loading').show();

                $('#apiResult').html('');

                $.ajax({

                    url: endpoint,

                    method: 'GET',

                    dataType: 'json',

                    timeout: 10000,

                    success: function (response) {

                        $('#loading').hide();

                        if (!response.success) {

                            $('#apiResult').html(`
                                <div class="ig-alert ig-alert-error">
                                    API returned an unsuccessful response.
                                </div>
                            `);

                            return;
                        }

                        let html = '';


                        /*
                        |--------------------------------------------------------------------------
                        | STUDENTS
                        |--------------------------------------------------------------------------
                        */

                        if (type === 'students') {

                            html += `
                                <div class="ig-card">

                                    <div class="ig-card-header">
                                        <div>
                                            <h2>Students</h2>

                                            <div class="small mt-1"
                                                 style="color:var(--ig-muted);">
                                                ${response.count} students returned.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="table-responsive">

                                        <table class="ig-table">

                                            <thead>
                                                <tr>
                                                    <th>Student ID</th>
                                                    <th>Name</th>
                                                    <th>Email</th>
                                                    <th>Team</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                            `;

                            response.data.forEach(function (student) {

                                html += `
                                    <tr>

                                        <td>
                                            <span class="ig-badge ig-badge-green">
                                                ${student.student_id}
                                            </span>
                                        </td>

                                        <td>
                                            <strong>
                                                ${student.name ?? '—'}
                                            </strong>
                                        </td>

                                        <td>
                                            ${student.email ?? '—'}
                                        </td>

                                        <td>
                                            ${student.team ?? 'Unassigned'}
                                        </td>

                                    </tr>
                                `;

                            });

                            html += `
                                            </tbody>

                                        </table>

                                    </div>

                                </div>
                            `;
                        }


                        /*
                        |--------------------------------------------------------------------------
                        | TEAMS
                        |--------------------------------------------------------------------------
                        */

                        if (type === 'teams') {

                            html += `
                                <div class="ig-card">

                                    <div class="ig-card-header">
                                        <div>
                                            <h2>Teams</h2>

                                            <div class="small mt-1"
                                                 style="color:var(--ig-muted);">
                                                ${response.count} teams returned.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="ig-card-body">

                                        <div class="row g-3">
                            `;

                            response.data.forEach(function (team) {

                                html += `
                                    <div class="col-md-6">

                                        <div class="ig-management-card">

                                            <div class="ig-management-icon">
                                                ⚽
                                            </div>

                                            <div>

                                                <h3>
                                                    ${team.name}
                                                </h3>

                                                <p>
                                                    ${team.description ?? 'No description'}
                                                </p>

                                                <p class="mt-2">
                                                    Students:
                                                    <strong>
                                                        ${team.students_count}
                                                    </strong>
                                                </p>

                                            </div>

                                        </div>

                                    </div>
                                `;

                            });

                            html += `
                                        </div>

                                    </div>

                                </div>
                            `;
                        }


                        /*
                        |--------------------------------------------------------------------------
                        | COURSES
                        |--------------------------------------------------------------------------
                        */

                        if (type === 'courses') {

                            html += `
                                <div class="ig-card">

                                    <div class="ig-card-header">
                                        <div>
                                            <h2>Courses</h2>

                                            <div class="small mt-1"
                                                 style="color:var(--ig-muted);">
                                                ${response.count} courses returned.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="ig-card-body">

                                        <div class="row g-3">
                            `;

                            response.data.forEach(function (course) {

                                html += `
                                    <div class="col-md-6">

                                        <div class="ig-management-card">

                                            <div class="ig-management-icon">
                                                📚
                                            </div>

                                            <div>

                                                <h3>
                                                    ${course.name}
                                                </h3>

                                                <p>
                                                    Code: ${course.code}
                                                </p>

                                                <p>
                                                    Team: ${course.team ?? 'None'}
                                                </p>

                                                <p class="mt-2">
                                                    Capacity:
                                                    <strong>
                                                        ${course.capacity}
                                                    </strong>
                                                </p>

                                            </div>

                                        </div>

                                    </div>
                                `;

                            });

                            html += `
                                        </div>

                                    </div>

                                </div>
                            `;
                        }


                        /*
                        |--------------------------------------------------------------------------
                        | MATCHES
                        |--------------------------------------------------------------------------
                        */

                        if (type === 'matches') {

                            html += `
                                <div class="ig-card">

                                    <div class="ig-card-header">
                                        <div>
                                            <h2>Practice Matches</h2>

                                            <div class="small mt-1"
                                                 style="color:var(--ig-muted);">
                                                ${response.count} matches returned.
                                            </div>
                                        </div>
                                    </div>

                                    <div class="ig-card-body">

                                        <div class="row g-3">
                            `;

                            if (response.data.length === 0) {

                                html += `
                                    <div class="col-12">

                                        <div class="text-center py-5">

                                            <div style="font-size:42px;">
                                                ⚽
                                            </div>

                                            <h3 style="color:var(--ig-text);">
                                                No Matches Found
                                            </h3>

                                            <p style="color:var(--ig-muted);">
                                                Create a practice match to see it here.
                                            </p>

                                        </div>

                                    </div>
                                `;

                            } else {

                                response.data.forEach(function (match) {

                                    html += `
                                        <div class="col-md-6">

                                            <div class="ig-management-card">

                                                <div class="ig-management-icon">
                                                    🏆
                                                </div>

                                                <div>

                                                    <h3>
                                                        ${match.team ?? 'Team'}
                                                        vs
                                                        ${match.opponent}
                                                    </h3>

                                                    <p>
                                                        Date: ${match.date ?? '—'}
                                                    </p>

                                                    <p>
                                                        Time: ${match.time ?? '—'}
                                                    </p>

                                                    <p>
                                                        Venue: ${match.venue ?? '—'}
                                                    </p>

                                                    <p>
                                                        Coach: ${match.coach ?? 'N/A'}
                                                    </p>

                                                    <p>
                                                        Status: ${match.status ?? '—'}
                                                    </p>

                                                    <p>
                                                        Result: ${match.result ?? 'Not played'}
                                                    </p>

                                                </div>

                                            </div>

                                        </div>
                                    `;

                                });

                            }

                            html += `
                                        </div>

                                    </div>

                                </div>
                            `;
                        }


                        $('#apiResult').html(html);

                    },


                    error: function (xhr, status) {

                        $('#loading').hide();

                        let message = 'Failed to load API data.';

                        if (status === 'timeout') {
                            message = 'The API request timed out.';
                        }

                        if (xhr.status === 404) {
                            message = 'API endpoint was not found.';
                        }

                        if (xhr.status >= 500) {
                            message = 'Laravel returned a server error.';
                        }

                        $('#apiResult').html(`
                            <div class="ig-alert ig-alert-error">

                                <strong>
                                    ${message}
                                </strong>

                                <div class="small mt-2">
                                    Endpoint: ${endpoint}
                                </div>

                            </div>
                        `);

                        console.error(xhr);

                    }

                });

            }


            $('#loadStudents').on('click', function () {
                loadApiData('/api/students', 'students');
            });

            $('#loadTeams').on('click', function () {
                loadApiData('/api/teams', 'teams');
            });

            $('#loadCourses').on('click', function () {
                loadApiData('/api/courses', 'courses');
            });

            $('#loadMatches').on('click', function () {
                loadApiData('/api/matches', 'matches');
            });

        });
    </script>

</x-app-layout>