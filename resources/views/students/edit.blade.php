<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="text-xl font-bold text-slate-800 dark:text-white">
                Edit Student
            </h2>

            <p class="text-sm text-slate-500 dark:text-slate-400 mt-1">
                Update student information
            </p>
        </div>
    </x-slot>

    <div class="min-h-screen bg-slate-50 dark:bg-slate-950 py-8">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">

            <form method="POST"
                  action="{{ route('students.update', $student) }}"
                  class="bg-white dark:bg-slate-900 rounded-2xl
                         border border-slate-200 dark:border-slate-800
                         shadow-sm p-6">

                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                            Full Name
                        </label>

                        <input type="text" name="name"
                               value="{{ old('name', $student->user->name) }}"
                               required
                               class="mt-2 w-full rounded-xl border-slate-300
                                      dark:border-slate-700 dark:bg-slate-800
                                      dark:text-white">

                        @error('name')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                            Email
                        </label>

                        <input type="email" name="email"
                               value="{{ old('email', $student->user->email) }}"
                               required
                               class="mt-2 w-full rounded-xl border-slate-300
                                      dark:border-slate-700 dark:bg-slate-800
                                      dark:text-white">

                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                            Student ID
                        </label>

                        <input type="text" name="student_id"
                               value="{{ old('student_id', $student->student_id) }}"
                               required
                               class="mt-2 w-full rounded-xl border-slate-300
                                      dark:border-slate-700 dark:bg-slate-800
                                      dark:text-white">

                        @error('student_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                            Phone
                        </label>

                        <input type="text" name="phone"
                               value="{{ old('phone', $student->phone) }}"
                               class="mt-2 w-full rounded-xl border-slate-300
                                      dark:border-slate-700 dark:bg-slate-800
                                      dark:text-white">

                        @error('phone')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                            Date of Birth
                        </label>

                        <input type="date" name="date_of_birth"
                               value="{{ old('date_of_birth', optional($student->date_of_birth)->format('Y-m-d')) }}"
                               class="mt-2 w-full rounded-xl border-slate-300
                                      dark:border-slate-700 dark:bg-slate-800
                                      dark:text-white">

                        @error('date_of_birth')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                            Team
                        </label>

                        <select name="team_id"
                                class="mt-2 w-full rounded-xl border-slate-300
                                       dark:border-slate-700 dark:bg-slate-800
                                       dark:text-white">

                            <option value="">Select team</option>

                            @foreach($teams as $team)
                                <option value="{{ $team->id }}"
                                    @selected(old('team_id', $student->team_id) == $team->id)>
                                    {{ $team->name }}
                                </option>
                            @endforeach

                        </select>

                        @error('team_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                            Address
                        </label>

                        <textarea name="address" rows="3"
                                  class="mt-2 w-full rounded-xl border-slate-300
                                         dark:border-slate-700 dark:bg-slate-800
                                         dark:text-white">{{ old('address', $student->address) }}</textarea>

                        @error('address')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div class="mt-6 flex items-center justify-end gap-3">

                    <a href="{{ route('students.show', $student) }}"
                       class="px-4 py-2 rounded-xl text-sm font-semibold
                              text-slate-600 dark:text-slate-300
                              hover:bg-slate-100 dark:hover:bg-slate-800">
                        Cancel
                    </a>

                    <button type="submit" class="ig-btn ig-btn-primary">
    Save Changes
</button>

                </div>

            </form>
        </div>
    </div>
</x-app-layout>