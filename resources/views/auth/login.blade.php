<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" />
        </div>

        <!-- Password -->
        <div>
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" />
        </div>

        <!-- Remember Me -->
        <div class="flex items-center">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-[#E5E7EB] text-[#4F46E5] shadow-sm focus:ring-[#4F46E5]" name="remember">
                <span class="ms-2 text-sm text-[#6B7280]">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-between">
            <div class="flex gap-3">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-[#6B7280] hover:text-[#111827] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#4F46E5]" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                @if (Route::has('register'))
                    <a class="underline text-sm text-[#6B7280] hover:text-[#111827] rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#4F46E5]" href="{{ route('register') }}">
                        {{ __('Register') }}
                    </a>
                @endif
            </div>

            <x-primary-button>
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
