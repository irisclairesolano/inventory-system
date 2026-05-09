<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold text-[#F7F4D5]">
            Profile
        </h2>
    </x-slot>

    <div class="py-10 max-w-5xl mx-auto space-y-6">

        <!-- Profile Card -->
        <div class="card flex items-center gap-6">

            <!-- Avatar -->
            <div class="w-16 h-16 rounded-full bg-[#839958] flex items-center justify-center text-[#F7F4D5] text-lg font-bold">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                {{ strtoupper(str_contains(auth()->user()->name, ' ') ? substr(auth()->user()->name, strpos(auth()->user()->name, ' ') + 1, 1) : '') }}
            </div>

            <!-- Info -->
            <div class="flex-1">
                <h3 class="text-lg font-semibold text-[#0A3323]">
                    {{ auth()->user()->name }}
                </h3>
                <p class="text-sm text-gray-600">{{ auth()->user()->email }}</p>
                <div class="mt-2">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-[#839958]/15 text-[#6B7A4A] border border-[#839958]/30 uppercase tracking-wide">
                        {{ auth()->user()->role }}
                    </span>
                </div>
            </div>

            <a href="{{ route('profile.edit') }}" class="btn-primary">
                Edit Profile
            </a>
        </div>

        <!-- Login History -->
        <div class="card">
            <h3 class="text-lg font-semibold mb-4 text-[#0A3323]">
                Login Activity
            </h3>

            @if($logs->count())
                <div class="space-y-3">
                    @foreach($logs as $log)
                        <div class="flex justify-between text-sm border-b border-[#839958]/30 pb-2">
                            <div>
                                <p class="text-[#0A3323] font-medium">
                                    {{ $log->logged_in_at->format('M d, Y h:i A') }}
                                </p>
                                <p class="text-xs text-gray-500">
                                    <span class="font-medium text-[#0A3323]">IP Address:</span>
                                    {{ $log->ip_address }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-10 text-gray-500">
                    No login activity found
                </div>
            @endif
        </div>

    </div>
</x-app-layout>