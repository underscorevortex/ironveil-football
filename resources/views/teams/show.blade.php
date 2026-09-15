<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Team Details
            </h2>

            <a href="{{ route('teams.index') }}"
               class="px-4 py-2 bg-gray-200 rounded-md">
                Back to Teams
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <div class="border-b border-gray-200 dark:border-gray-700 pb-6">

                    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                        {{ $team->name }}
                    </h3>

                    <p class="mt-2 text-gray-500">
                        {{ $team->description ?? 'No description provided.' }}
                    </p>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">

                    {{-- Students --}}

                    <div>

                        <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                            Students
                        </h4>

                        @forelse($team->students as $student)

                            <div class="border border-gray-200 dark:border-gray-700 rounded-md p-4 mb-3">

                                <p class="font-medium text-gray-900 dark:text-gray-100">
                                    {{ $student->user?->name ?? 'Unknown Student' }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    {{ $student->student_id }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    {{ $student->user?->email ?? 'No email' }}
                                </p>

                            </div>

                        @empty

                            <p class="text-gray-500">
                                No students assigned to this team.
                            </p>

                        @endforelse

                    </div>


                    {{-- Courses --}}

                    <div>

                        <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                            Courses
                        </h4>

                        @forelse($team->courses as $course)

                            <div class="border border-gray-200 dark:border-gray-700 rounded-md p-4 mb-3">

                                <p class="font-medium text-gray-900 dark:text-gray-100">
                                    {{ $course->name }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    Code: {{ $course->code }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    Capacity: {{ $course->capacity }}
                                </p>

                            </div>

                        @empty

                            <p class="text-gray-500">
                                No courses assigned to this team.
                            </p>

                        @endforelse

                    </div>

                </div>

                <div class="mt-8">

                    <a href="{{ route('teams.edit', $team) }}"
                       class="inline-block px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        Edit Team
                    </a>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>