<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-6 pt-2">
        @csrf

        <!-- Full Name -->
        <div>
            <x-input-label for="name" value="Full Name" />

            <x-text-input
                id="name"
                class="block mt-1 w-full"
                type="text"
                name="name"
                :value="old('name')"
                placeholder="Enter your full name"
                required
                autofocus
            />

            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

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
                    placeholder="Create a password"
                    required
                    class="w-full px-3.5 py-2.5 bg-[#F7F4D5] border border-[#839958] rounded-lg pr-10 text-[#0A3323] focus:border-[#839958] focus:ring-0 placeholder:text-[#839958]/70"
                />

                <button
                    type="button"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-[#839958]"
                    @click="show = !show"
                >
                    <svg x-show="!show" class="h-5 w-5" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                        <path stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5
                            c4.478 0 8.268 2.943 9.542 7
                            -1.274 4.057-5.064 7-9.542 7
                            -4.477 0-8.268-2.943-9.542-7z" />
                    </svg>

                    <svg x-show="show" style="display:none"
                        class="h-5 w-5" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M13.875 18.825A10.05 10.05 0 0112 19
                            c-4.478 0-8.268-2.943-9.542-7
                            a9.97 9.97 0 012.293-3.95
                            M6.228 6.228A9.956 9.956 0 0112 5
                            c4.478 0 8.268 2.943 9.542 7
                            a9.96 9.96 0 01-4.132 5.411
                            M15 12a3 3 0 01-3 3
                            m0-6a3 3 0 013 3
                            m6 6L3 3"/>
                    </svg>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div x-data="{ show: false }">
            <x-input-label for="password_confirmation" value="Confirm Password" />

            <div class="relative mt-1">
                <input
                    :type="show ? 'text' : 'password'"
                    id="password_confirmation"
                    name="password_confirmation"
                    placeholder="Confirm your password"
                    required
                    class="w-full px-3.5 py-2.5 bg-[#F7F4D5] border border-[#839958] rounded-lg pr-10 text-[#0A3323] focus:border-[#839958] focus:ring-0 placeholder:text-[#839958]/70"
                />

                <button
                    type="button"
                    class="absolute inset-y-0 right-0 pr-3 flex items-center text-[#839958]"
                    @click="show = !show"
                >
                    <svg x-show="!show" class="h-5 w-5" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />

                        <path stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5
                            c4.478 0 8.268 2.943 9.542 7
                            -1.274 4.057-5.064 7-9.542 7
                            -4.477 0-8.268-2.943-9.542-7z" />
                    </svg>

                    <svg x-show="show" style="display:none"
                        class="h-5 w-5" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M13.875 18.825A10.05 10.05 0 0112 19
                            c-4.478 0-8.268-2.943-9.542-7
                            a9.97 9.97 0 012.293-3.95
                            M6.228 6.228A9.956 9.956 0 0112 5
                            c4.478 0 8.268 2.943 9.542 7
                            a9.96 9.96 0 01-4.132 5.411
                            M15 12a3 3 0 01-3 3
                            m0-6a3 3 0 013 3
                            m6 6L3 3"/>
                    </svg>
                </button>
            </div>

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Actions -->
        <div class="flex items-center justify-between">
            <a href="{{ route('login') }}"
                class="text-sm text-[#839958] hover:text-[#6B7A4A]">
                Already have an account?
            </a>

            <x-primary-button>
                Create Account
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>