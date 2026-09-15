<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Edit Coach
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('coaches.update', $coach) }}">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                        <div>
                            <x-input-label for="name" value="Full Name" />

                            <x-text-input
                                id="name"
                                name="name"
                                type="text"
                                class="block mt-1 w-full"
                                value="{{ old('name', $coach->name) }}"
                                required
                            />

                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="email" value="Email" />

                            <x-text-input
                                id="email"
                                name="email"
                                type="email"
                                class="block mt-1 w-full"
                                value="{{ old('email', $coach->email) }}"
                                required
                            />

                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="phone" value="Phone" />

                            <x-text-input
                                id="phone"
                                name="phone"
                                type="text"
                                class="block mt-1 w-full"
                                value="{{ old('phone', $coach->phone) }}"
                            />

                            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="specialization" value="Specialization" />

                            <x-text-input
                                id="specialization"
                                name="specialization"
                                type="text"
                                class="block mt-1 w-full"
                                value="{{ old('specialization', $coach->specialization) }}"
                            />

                            <x-input-error :messages="$errors->get('specialization')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="department_id" value="Assigned Team" />

                            <select
                                id="department_id"
                                name="department_id"
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
                            >
                                <option value="">Unassigned</option>

                                @foreach($teams as $team)
                                    <option value="{{ $team->id }}"
                                        {{ old('department_id', $coach->department_id) == $team->id ? 'selected' : '' }}>
                                        {{ $team->name }}
                                    </option>
                                @endforeach
                            </select>

                            <x-input-error :messages="$errors->get('department_id')" class="mt-2" />
                        </div>

                        <div>
                            <x-input-label for="status" value="Status" />

                            <select
                                id="status"
                                name="status"
                                class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
                            >
                                <option value="1" {{ old('status', $coach->status ? '1' : '0') == '1' ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="0" {{ old('status', $coach->status ? '1' : '0') == '0' ? 'selected' : '' }}>
                                    Inactive
                                </option>
                            </select>

                            <x-input-error :messages="$errors->get('status')" class="mt-2" />
                        </div>

                    </div>

                    <div class="flex justify-end gap-3 mt-6">
                        <a href="{{ route('coaches.index') }}"
                           class="px-4 py-2 bg-gray-200 rounded-md">
                            Cancel
                        </a>

                        <button type="submit" class="ig-btn ig-btn-primary">
                            Update Coach
                            </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>