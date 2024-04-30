<x-guest-layout>
    <x-authentication-card>

        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @session('status')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ $value }}
        </div>
        @endsession

        <form method="POST" action="{{ route('auth-v1.login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif
            </div>

            <x-button class="flex justify-center w-full mt-2 px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <span class="py-2">{{ __('Log in') }}</span>
            </x-button>

            <br>
            <br>

            <a href="/auth/github/redirect">
                <div class="flex justify-between w-full  px-4 py-2 border border-gray-800 rounded-md font-semibold text-xs text-gray-900 uppercase tracking-widest hover:bg-gray-100  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <span class="inline-flex items-center  "> Login with github</span>
                    <img src="{{ asset('img/logo-github.png') }}" alt="github logo" class="w-8">
                </div>
            </a>

            <br>

            <a href="/auth/google/redirect">
                <div class="flex justify-between w-full  px-4 py-2 border border-gray-800 rounded-md font-semibold text-xs text-gray-900 uppercase tracking-widest hover:bg-gray-100  focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <span class="inline-flex items-center  "> Login with google</span>
                    <img src="{{ asset('img/google_logo.png') }}" alt="google logo" class="w-8">
                </div>
            </a>
        </form>
    </x-authentication-card>
</x-guest-layout>
