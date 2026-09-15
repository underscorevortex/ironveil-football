<x-app-layout>

    <x-slot name="header">

        <div class="flex justify-between items-center">

            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
                Enrollment Details
            </h2>

            <a href="{{ route('enrollments.index') }}"
               class="px-4 py-2 bg-gray-200 rounded-md">
                Back to Enrollments
            </a>

        </div>

    </x-slot>

    <div class="py-8">

        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <div class="border-b border-gray-200 dark:border-gray-700 pb-6">

                    <p class="text-sm text-gray-500">
                        Student
                    </p>

                    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                        {{ $enrollment->student?->user?->name }}
                    </h3>

                    <p class="text-gray-500">
                        {{ $enrollment->student?->student_id }}
                    </p>

                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-8">

                    <div>

                        <p class="text-sm text-gray-500">
                            Team
                        </p>

                        <p class="font-medium text-gray-900 dark:text-gray-100">
                            {{ $enrollment->student?->team?->name ?? 'Unassigned' }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">
                            Course
                        </p>

                        <p class="font-medium text-gray-900 dark:text-gray-100">
                            {{ $enrollment->course?->name }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">
                            Course Code
                        </p>

                        <p class="font-medium text-gray-900 dark:text-gray-100">
                            {{ $enrollment->course?->code }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">
                            Enrollment Date
                        </p>

                        <p class="font-medium text-gray-900 dark:text-gray-100">
                            {{ $enrollment->enrolled_at?->format('F d, Y') }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">
                            Status
                        </p>

                        <p class="font-medium text-gray-900 dark:text-gray-100">
                            {{ ucfirst($enrollment->status) }}
                        </p>

                    </div>

                    <div>

                        <p class="text-sm text-gray-500">
                            Course Capacity
                        </p>

                        <p class="font-medium text-gray-900 dark:text-gray-100">
                            {{ $enrollment->course?->capacity }}
                        </p>

                    </div>

                </div>

                <div class="mt-8">

                    <a href="{{ route('enrollments.edit', $enrollment) }}"
                       class="inline-block px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        Edit Enrollment
                    </a>

                </div>

            </div>

        </div>

    </div>

</x-app-layout>