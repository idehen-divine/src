<x-auth-layout>
    <x-validation-errors class="mb-4" />
        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white drop-shadow-md dark:bg-gray-800 shadow-md overflow-hidden rounded-lg">

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600 dark:text-green-400">
                    {{ session('status') }}
                </div>
            @endif

            <div class="flex flex-col relative items-start mb-4 z-10">
                <h1 class="font-bold text-3xl text-gray-800 dark:text-gray-200"> Welcome Back!</h1>
                <p class="font-bold text-sm text-gray-800 dark:text-gray-200">Login Your account now</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="relative z-10">
                    <x-label for="email" value="{{ __('Email') }}" />
                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                        required autofocus autocomplete="email" />
                </div>

                <div class="mt-4">
                    <x-label for="password" value="{{ __('Password') }}" />
                    <x-input id="password" class="block mt-1 w-full" type="password" name="password" required
                        autocomplete="current-password" />
                </div>

                <div class="block mt-4">
                    <label for="remember_me" class="flex items-center">
                        <x-checkbox id="remember_me" name="remember" />
                        <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-4 z-10">
                    <a href="{{ route('password.request') }}"
                        class="underline text-sm text-gray-600 dark:text-gray-200 hover:text-gray-900 dark:hover:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800 me-5">
                        Forgot password?
                    </a>
                    <button type="submit"
                        class="btn btn-primary hover:bg-transparent hover:border-2 hover:text-primary ext-gray-600 dark:text-gray-200 w-[220px] mt-5 z-10 text-lg">Login</button>

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
