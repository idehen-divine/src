<x-auth-layout title="Verify Email">

    <div
        class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white drop-shadow-md dark:bg-gray-800 shadow-md overflow-hidden rounded-lg">

        <x-validation-errors class="mb-4" />

        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400 z-10">
                {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
            </div>
        @endif

        <div class="flex flex-col relative items-start mb-4 z-10">
            <h1 class="font-bold text-3xl text-gray-800 dark:text-gray-200">Verify Email</h1>
            <p class="text-gray-800 dark:text-gray-200 mt-4">
                Before continuing, could you verify your email address by clicking on the link we just emailed to you?
                If you didn\'t receive the email, we will gladly send you another.
            </p>
        </div>

        <div class="mt-4 flex items-center justify-between z-10">
            <form method="POST" action="{{ route('verification.send') }}">
                @csrf

                <div>
                    <x-button type="submit">
                        {{ __('Resend Verification Email') }}
                    </x-button>
                </div>
            </form>

            <div class="z-10">
                <a href="{{ route('email.update') }}"
                    class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800">
                    {{ __('Edit Email') }}</a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf

                    <button type="submit"
                        class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 ms-2">
                        {{ __('Log Out') }}
                    </button>
                </form>
            </div>
        </div>

        <div class="w-48 h-48 rounded-full bg-primary absolute z-0 top-[-30px] left-[-30px] opacity-50"></div>
        <div class="w-48 h-48 rounded-full bg-accent absolute z-0 bottom-[-30px] right-[-30px] opacity-50"> </div>

    </div>

</x-auth-layout>
