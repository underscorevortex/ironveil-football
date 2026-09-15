<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-xl font-bold text-slate-800 dark:text-white">
                    Student Profile
                </h2>

                <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                    {{ $student->student_id }}
                </p>
            </div>

            <a href="{{ route('students.edit', $student) }}"
               class="px-4 py-2 rounded-xl bg-slate-900 dark:bg-white
                      text-white dark:text-slate-900 text-sm font-semibold
                      hover:opacity-90">
                Edit Student
            </a>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 dark:bg-slate-950 py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

                {{-- Profile --}}
                <div class="bg-slate-900 dark:bg-slate-800 rounded-2xl
                            p-6 text-white">

                    <div class="w-20 h-20 rounded-full bg-white/10
                                flex items-center justify-center text-3xl">
                        ⚽
                    </div>

                    <h1 class="mt-5 text-2xl font-bold">
                        {{ $student->user->name }}
                    </h1>

                    <p class="mt-1 text-slate-300">
                        {{ $student->student_id }}
                    </p>

                    <div class="mt-6 pt-6 border-t border-white/10">

                        <p class="text-xs text-slate-400 uppercase tracking-wide">
                            Team
                        </p>

                        <p class="mt-1 font-semibold">
                            {{ $student->team->name ?? 'Unassigned' }}
                        </p>

                    </div>

                </div>

                {{-- Information --}}
                <div class="lg:col-span-2 bg-white dark:bg-slate-900
                            rounded-2xl border border-slate-200
                            dark:border-slate-800 shadow-sm p-6">

                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                        Student Information
                    </h2>

                    <div class="mt-6 grid grid-cols-1 sm:grid-cols-2 gap-6">

                        <div>
                            <p class="text-xs uppercase tracking-wide
                                      text-slate-400">
                                Email
                            </p>

                            <p class="mt-1 text-slate-800 dark:text-white">
                                {{ $student->user->email }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs uppercase tracking-wide
                                      text-slate-400">
                                Phone
                            </p>

                            <p class="mt-1 text-slate-800 dark:text-white">
                                {{ $student->phone ?? 'Not provided' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs uppercase tracking-wide
                                      text-slate-400">
                                Date of Birth
                            </p>

                            <p class="mt-1 text-slate-800 dark:text-white">
                                {{ $student->date_of_birth?->format('d M Y') ?? 'Not provided' }}
                            </p>
                        </div>

                        <div>
                            <p class="text-xs uppercase tracking-wide
                                      text-slate-400">
                                Team
                            </p>

                            <p class="mt-1 text-slate-800 dark:text-white">
                                {{ $student->team->name ?? 'Unassigned' }}
                            </p>
                        </div>

                        <div class="sm:col-span-2">
                            <p class="text-xs uppercase tracking-wide
                                      text-slate-400">
                                Address
                            </p>

                            <p class="mt-1 text-slate-800 dark:text-white">
                                {{ $student->address ?? 'Not provided' }}
                            </p>
                        </div>

                    </div>
                </div>

                {{-- Enrollments --}}
                <div class="lg:col-span-3 bg-white dark:bg-slate-900
                            rounded-2xl border border-slate-200
                            dark:border-slate-800 shadow-sm">

                    <div class="p-6 border-b border-slate-200 dark:border-slate-800">
                        <h2 class="text-lg font-bold text-slate-900 dark:text-white">
                            Enrolled Courses
                        </h2>
                    </div>

                    <div class="p-6">

                        @forelse($student->enrollments as $enrollment)

                            <div class="flex items-center justify-between py-4
                                        border-b last:border-0 border-slate-200
                                        dark:border-slate-800">

                                <div>
                                    <p class="font-semibold text-slate-900 dark:text-white">
                                        {{ $enrollment->course->name }}
                                    </p>

                                    <p class="text-sm text-slate-500 dark:text-slate-400">
                                        {{ $enrollment->course->code }}
                                    </p>
                                </div>

                                <span class="px-3 py-1 rounded-full
                                             bg-emerald-50 dark:bg-emerald-950
                                             text-emerald-700 dark:text-emerald-300
                                             text-xs font-semibold">
                                    {{ ucfirst($enrollment->status) }}
                                </span>

                            </div>

                        @empty

                            <p class="text-sm text-slate-500 dark:text-slate-400">
                                This student is not enrolled in any courses.
                            </p>

                        @endforelse

                    </div>
                </div>

            </div>

            <div class="mt-6">
                <a href="{{ route('students.index') }}"
                   class="text-sm font-semibold text-slate-600
                          dark:text-slate-400 hover:text-slate-900
                          dark:hover:text-white">
                    ← Back to Students
                </a>
            </div>

        </div>
    </div>
</x-app-layout>