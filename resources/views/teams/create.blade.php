<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Add Team
        </h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('teams.store') }}">
                    @csrf

                    <div>
                        <x-input-label for="name" value="Team Name" />

                        <x-text-input
                            id="name"
                            name="name"
                            type="text"
                            class="block mt-1 w-full"
                            value="{{ old('name') }}"
                            placeholder="e.g. U-18 Lions"
                            required
                        />

                        <x-input-error
                            :messages="$errors->get('name')"
                            class="mt-2"
                        />
                    </div>

                    <div class="mt-6">
                        <x-input-label for="description" value="Description" />

                        <textarea
                            id="description"
                            name="description"
                            rows="5"
                            class="block mt-1 w-full border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 rounded-md shadow-sm"
                            placeholder="Enter team description..."
                        >{{ old('description') }}</textarea>

                        <x-input-error
                            :messages="$errors->get('description')"
                            class="mt-2"
                        />
                    </div>

                    <div class="flex justify-end gap-3 mt-6">

                        <a href="{{ route('teams.index') }}"
                           class="px-4 py-2 bg-gray-200 rounded-md">
                            Cancel
                        </a>

                        <x-primary-button>
                            Add Team
                        </x-primary-button>

                    </div>

                </form>

            </div>

        </div>
    </div>
</x-app-layout>