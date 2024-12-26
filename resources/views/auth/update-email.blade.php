<x-auth-layout title="Login">
    <x-validation-errors class="mb-4" />
    <div
        class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white drop-shadow-md dark:bg-gray-800 shadow-md overflow-hidden rounded-lg">

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                {{ session('status') }}
            </div>
        @endif

        <div class="flex flex-col relative items-start mb-4 z-10">
            <h1 class="font-bold text-3xl text-gray-800 dark:text-gray-200"> Update Email</h1>
            <p class="font-bold text-sm text-gray-800 dark:text-gray-200">Update Your email to verify</p>
        </div>

        <form method="POST" action="{{ route('email.update') }}">
            @csrf

            <div class="relative z-10">
                <x-label for="old-email" value="{{ __('Old Email') }}" />
                <x-input id="old-email" class="block mt-1 w-full" type="email" name="old-email" :value="old('old-email')"
                    required />
            </div>

            <div class="relative z-10">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="email" />
            </div>

            <div class="flex items-center justify-between mt-4 z-10">
                <button type="submit"
                    class="btn btn-primary hover:bg-transparent hover:border-2 hover:text-primary ext-gray-600 dark:text-gray-200 w-full  mt-5 z-10 text-lg">
                    Update Email
                </button>
            </div>
        </form>

        <div class="flex flex-col items-center justify-between mt-4 z-10">
            <a href="{{ route('register') }}"
                class="underline z-10 text-sm text-gray-600 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 mt-2">
                Don't Have an Account? Register now</a>
        </div>

        <div class="w-48 h-48 rounded-full bg-primary absolute z-0 top-[-30px] left-[-30px] opacity-50"></div>
        <div class="w-48 h-48 rounded-full bg-accent absolute z-0 bottom-[-30px] right-[-30px] opacity-50"> </div>

    </div>
</x-auth-layout>
