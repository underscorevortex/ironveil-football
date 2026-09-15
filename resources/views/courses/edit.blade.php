<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Edit Course
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('courses.update', $course) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <x-input-label for="name" value="Course Name" />

                            <x-text-input
                                id="name"
                                name="name"
                                type="text"
                                class="block mt-1 w-full"
                                value="{{ old('name', $course->name) }}"
                                required
                            />

                            <x-input-error
                                :messages="$errors->get('name')"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <x-input-label for="code" value="Course Code" />

                            <x-text-input
                                id="code"
                                name="code"
                                type="text"
                                class="block mt-1 w-full"
                                value="{{ old('code', $course->code) }}"
                                required
                            />

                            <x-input-error
                                :messages="$errors->get('code')"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <x-input-label for="department_id" value="Team" />

                            <select
                                id="department_id"
                                name="department_id"
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
                                required
                            >
                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}"
                                        {{ old('department_id', $course->department_id) == $team->id ? 'selected' : '' }}>
                                        {{ $team->name }}
                                    </option>
                                @endforeach
                            </select>

                            <x-input-error
                                :messages="$errors->get('department_id')"
                                class="mt-2"
                            />
                        </div>

                        <div>
                            <x-input-label for="capacity" value="Capacity" />

                            <x-text-input
                                id="capacity"
                                name="capacity"
                                type="number"
                                min="1"
                                max="500"
                                class="block mt-1 w-full"
                                value="{{ old('capacity', $course->capacity) }}"
                                required
                            />

                            <x-input-error
                                :messages="$errors->get('capacity')"
                                class="mt-2"
                            />
                        </div>

                    </div>

                    <div class="mt-6">
                        <x-input-label for="description" value="Description" />

                        <textarea
                            id="description"
                            name="description"
                            rows="5"
                            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
                        >{{ old('description', $course->description) }}</textarea>

                        <x-input-error
                            :messages="$errors->get('description')"
                            class="mt-2"
                        />
                    </div>

                    <div class="flex justify-end gap-3 mt-6">

                        <a href="{{ route('courses.index') }}"
                           class="px-4 py-2 bg-gray-200 rounded-md">
                            Cancel
                        </a>

                        <button type="submit" class="ig-btn ig-btn-primary">
                              Update Course
                             </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>