<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                Coach Details
            </h2>

            <a href="{{ route('coaches.index') }}"
               class="px-4 py-2 bg-gray-200 rounded-md">
                Back to Coaches
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <div class="border-b border-gray-200 dark:border-gray-700 pb-6">
                    <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100">
                        {{ $coach->name }}
                    </h3>

                    <p class="text-gray-500 mt-1">
                        {{ $coach->specialization ?? 'Football Coach' }}
                    </p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">

                    <div>
                        <p class="text-sm text-gray-500">Email</p>
                        <p class="font-medium text-gray-900 dark:text-gray-100">
                            {{ $coach->email }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Phone</p>
                        <p class="font-medium text-gray-900 dark:text-gray-100">
                            {{ $coach->phone ?? 'Not provided' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Specialization</p>
                        <p class="font-medium text-gray-900 dark:text-gray-100">
                            {{ $coach->specialization ?? 'Not specified' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Assigned Team</p>
                        <p class="font-medium text-gray-900 dark:text-gray-100">
                            {{ $coach->team?->name ?? 'Unassigned' }}
                        </p>
                    </div>

                    <div>
                        <p class="text-sm text-gray-500">Status</p>

                        @if($coach->status)
                            <span class="inline-block mt-1 px-3 py-1 text-sm rounded-full bg-green-100 text-green-800">
                                Active
                            </span>
                        @else
                            <span class="inline-block mt-1 px-3 py-1 text-sm rounded-full bg-red-100 text-red-800">
                                Inactive
                            </span>
                        @endif
                    </div>

                </div>

                <div class="mt-8">
                    <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">
                        Practice Matches
                    </h4>

                    @forelse($coach->practiceMatches as $match)
                        <div class="border border-gray-200 dark:border-gray-700 rounded-md p-4 mb-3">
                            <p class="font-medium text-gray-900 dark:text-gray-100">
                                vs {{ $match->opponent }}
                            </p>

                            <p class="text-sm text-gray-500">
                                {{ $match->match_date?->format('M d, Y') }}
                                at
                                {{ $match->match_time }}
                                —
                                {{ $match->venue }}
                            </p>
                        </div>
                    @empty
                        <p class="text-gray-500">
                            No practice matches recorded yet.
                        </p>
                    @endforelse
                </div>

                <div class="mt-6">
                    <a href="{{ route('coaches.edit', $coach) }}"
                       class="inline-block px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-700">
                        Edit Coach
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>