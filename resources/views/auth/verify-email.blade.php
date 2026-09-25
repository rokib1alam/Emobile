<x-guest-layout>
    <div class="max-w-md mx-auto mt-12 bg-white shadow-lg rounded-lg p-6 border border-gray-200">
        <h2 class="text-xl font-semibold text-gray-800 mb-4 text-center">
            {{ __('Email Verification Required') }}
        </h2>

        <p class="text-sm text-gray-600 mb-6 text-center">
            {{ __("Thanks for signing up! Please verify your email by clicking the link we've sent to your inbox. If you didn't receive it, we can send another.") }}
        </p>

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 text-green-600 font-medium text-sm text-center">
                {{ __('A new verification link has been sent to the email address you provided.') }}
            </div>
        @endif

        <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
            <form method="POST" action="{{ route('verification.send') }}" class="w-full sm:w-auto">
                @csrf
                <x-primary-button class="w-full">
                    {{ __('Resend Verification Email') }}
                </x-primary-button>
            </form>

            <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
                @csrf
                <button type="submit"
                        class="w-full inline-flex justify-center items-center px-4 py-2 bg-gray-100 text-gray-700 text-sm font-medium rounded-md hover:bg-gray-200 transition ease-in-out duration-150">
                    {{ __('Log Out') }}
                </button>
            </form>
        </div>
    </div>
</x-guest-layout>

