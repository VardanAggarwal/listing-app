<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-red-600">
                {{ __(session('status')) }}
            </div>
        @endif
        <div class="my-4 border-b pb-4">
            <span>{{__('Login with social accounts')}}</span>
            <div class="flex items-center justify-center mt-4 gap-4">
                <a href="/auth/google/redirect"><span class="rounded-full px-4 py-2 bg-black text-white"><i class="fab fa-google mr-2"></i>{{__('Google')}}</span></a>
                <a href="/auth/facebook/redirect"><span class="rounded-full px-4 py-2 bg-black text-white"><i class="fab fa-facebook-f mr-2"></i>{{__('Facebook')}}</span></a>
            </div>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" value="{{ __('Email') }}" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" value="{{ __('Password') }}" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember" checked />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>
            <div class="flex items-center justify-end border-b pb-2 mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-jet-button class="ml-4">
                    {{ __('Log in') }}
                </x-jet-button>
            </div>
        </form>
        <div class="mt-4">
        <a class="underline text-sm text-blue-800 hover:text-gray-900" href="{{ route('register') }}">
            {{ __('Not yet registered? create an account') }}
        </a></div>
    </x-jet-authentication-card>
</x-guest-layout>
