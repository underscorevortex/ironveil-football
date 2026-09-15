<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        Enter the 6-digit OTP sent to your email.
    </div>

    <form method="POST" action="{{ route('otp.verify') }}">
        @csrf

        <div>
            <x-input-label for="otp" :value="'OTP'" />

            <x-text-input
                id="otp"
                class="block mt-1 w-full"
                type="text"
                name="otp"
                maxlength="6"
                required
                autofocus
            />

            <x-input-error :messages="$errors->get('otp')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                Verify OTP
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>