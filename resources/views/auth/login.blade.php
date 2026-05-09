<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <!-- Email -->
        <div>
            <x-input-label for="email" value="Email" />

            <x-text-input
                id="email"
                class="block mt-1 w-full"
                type="email"
                name="email"
                :value="old('email')"
                placeholder="Enter your email address"
                required
                autofocus
            />

            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div x-data="{ show: false }">
            <x-input-label for="password" value="Password" />

            <div class="relative mt-1">
                <input
                    :type="show ? 'text' : 'password'"
                    id="password"
                    name="password"
                    placeholder="Enter your password"
                    required
                    class="w-full px-3.5 py-2.5 bg-[#F7F4D5] border border-[#839958] rounded-lg text-[#0A3323] pr-10 focus:border-[#839958] focus:ring-0 placeholder:text-[#839958]/70"
                />

                <button
                    type="button"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-[#839958]"
                    @click="show = !show"
                >
                    <svg x-show="!show" xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>

                    <svg x-show="show" style="display:none"
                        xmlns="http://www.w3.org/2000/svg"
                        class="h-5 w-5"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">

                        <path stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a9.97 9.97 0 012.293-3.95M6.228 6.228A9.956 9.956 0 0112 5c4.478 0 8.268 2.943 9.542 7a9.96 9.96 0 01-4.132 5.411M15 12a3 3 0 01-3 3m0-6a3 3 0 013 3m6 6L3 3"/>
                    </svg>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between">
            <a href="{{ route('password.request') }}"
                class="text-sm text-[#839958] hover:text-[#6B7A4A]">
                Forgot password?
            </a>

            <x-primary-button>
                Log in
            </x-primary-button>
        </div>

        <!-- Register -->
        <div class="text-center pt-3 border-t border-[#839958]/30">
            <p class="text-sm text-[#0A3323]">
                Don’t have an account?
                <a href="{{ route('register') }}"
                    class="text-[#839958] font-medium hover:text-[#6B7A4A]">
                    Create one
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>