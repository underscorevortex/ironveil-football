<x-app-layout>

    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Edit Enrollment
        </h2>
    </x-slot>

    <div class="py-8">

        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <div class="mb-6">

                    <p class="text-sm text-gray-500">
                        Student
                    </p>

                    <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">
                        {{ $enrollment->student?->user?->name }}
                    </p>

                    <p class="text-sm text-gray-500">
                        {{ $enrollment->student?->student_id }}
                    </p>

                </div>

                <form method="POST"
                      action="{{ route('enrollments.update', $enrollment) }}">

                    @csrf
                    @method('PUT')

                    <div>

                        <x-input-label for="course_id" value="Course" />

                        <select
                            id="course_id"
                            name="course_id"
                            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
                            required
                        >

                            @foreach($courses as $course)

                                <option value="{{ $course->id }}"
                                    {{ old('course_id', $enrollment->course_id) == $course->id ? 'selected' : '' }}>

                                    {{ $course->name }}
                                    —
                                    {{ $course->code }}
                                    —
                                    {{ $course->department?->name }}

                                </option>

                            @endforeach

                        </select>

                        <x-input-error
                            :messages="$errors->get('course_id')"
                            class="mt-2"
                        />

                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

                        <div>

                            <x-input-label for="enrolled_at" value="Enrollment Date" />

                            <x-text-input
                                id="enrolled_at"
                                name="enrolled_at"
                                type="date"
                                class="block mt-1 w-full"
                                value="{{ old('enrolled_at', $enrollment->enrolled_at?->format('Y-m-d')) }}"
                                required
                            />

                            <x-input-error
                                :messages="$errors->get('enrolled_at')"
                                class="mt-2"
                            />

                        </div>

                        <div>

                            <x-input-label for="status" value="Status" />

                            <select
                                id="status"
                                name="status"
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
                                required
                            >

                                <option value="active"
                                    {{ old('status', $enrollment->status) === 'active' ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="completed"
                                    {{ old('status', $enrollment->status) === 'completed' ? 'selected' : '' }}>
                                    Completed
                                </option>

                                <option value="cancelled"
                                    {{ old('status', $enrollment->status) === 'cancelled' ? 'selected' : '' }}>
                                    Cancelled
                                </option>

                            </select>

                            <x-input-error
                                :messages="$errors->get('status')"
                                class="mt-2"
                            />

                        </div>

                    </div>

                    <div class="flex justify-end gap-3 mt-6">

                        <a href="{{ route('enrollments.index') }}"
                           class="px-4 py-2 bg-gray-200 rounded-md">
                            Cancel
                        </a>

                        <x-primary-button>
                            Update Enrollment
                        </x-primary-button>

                    </div>

                </form>

            </div>

        </div>

    </div>

</x-app-layout>