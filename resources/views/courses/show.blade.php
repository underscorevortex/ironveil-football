<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                Course Details
            </h2>

            <a href="{{ route('courses.index') }}"
               class="px-4 py-2 bg-gray-200 rounded-md">
                Back to Courses
            </a>

        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <div class="border-b border-gray-200 dark:border-gray-700 pb-6">

                    <div class="flex justify-between items-start">

                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                                {{ $course->name }}
                            </h3>

                            <p class="mt-1 text-gray-500">
                                {{ $course->code }}
                            </p>
                        </div>

                        <span class="px-3 py-1 bg-indigo-100 text-indigo-800 rounded-full text-sm">
                            Capacity: {{ $course->capacity }}
                        </span>

                    </div>

                    <p class="mt-4 text-gray-600 dark:text-gray-300">
                        {{ $course->description ?? 'No description provided.' }}
                    </p>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mt-8">

                    <div>

                        <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                            Assigned Team
                        </h4>

                        <div class="border border-gray-200 dark:border-gray-700 rounded-md p-4">

                            <p class="font-medium text-gray-900 dark:text-gray-100">
                                {{ $course->department?->name ?? 'Unassigned' }}
                            </p>

                        </div>

                    </div>

                    <div>

                        <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                            Enrolled Students
                        </h4>

                        @forelse($course->enrollments as $enrollment)

                            <div class="border border-gray-200 dark:border-gray-700 rounded-md p-4 mb-3">

                                <p class="font-medium text-gray-900 dark:text-gray-100">
                                    {{ $enrollment->student?->user?->name ?? 'Unknown Student' }}
                                </p>

                                <p class="text-sm text-gray-500">
                                    {{ $enrollment->student?->student_id ?? 'No ID' }}
                                </p>

                                <span class="inline-block mt-2 px-2 py-1 text-xs rounded-full
                                    {{ $enrollment->status === 'active'
                                        ? 'bg-green-100 text-green-800'
                                        : 'bg-gray-100 text-gray-800' }}">
                                    {{ ucfirst($enrollment->status) }}
                                </span>

                            </div>

                        @empty

                            <p class="text-gray-500">
                                No students enrolled in this course.
                            </p>

                        @endforelse

                    </div>

                </div>

                <div class="mt-8">

                    <a href="{{ route('courses.edit', $course) }}"
                       class="inline-block px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        Edit Course
                    </a>

                </div>

            </div>

        </div>
    </div>
</x-app-layout>