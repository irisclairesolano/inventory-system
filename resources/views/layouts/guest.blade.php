<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Inventory System') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-[#0A3323]">

<div class="min-h-screen flex items-center justify-center px-4 py-10">

    <div class="w-full max-w-md">

    <div class="flex flex-col items-center mb-6 text-center">

        <div class="p-4 rounded-2xl bg-[#839958]/15 border border-[#839958]/30">
            <svg xmlns="http://www.w3.org/2000/svg"
                class="w-10 h-10 text-[#F7F4D5]"
                viewBox="0 0 24 24"
                fill="none"
                stroke="currentColor"
                stroke-width="2"
                stroke-linecap="round"
                stroke-linejoin="round">

                <path d="m7.5 4.27 9 5.15"></path>
                <path d="M21 8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16Z"></path>
                <path d="m3.3 7 8.7 5 8.7-5"></path>
                <path d="M12 22V12"></path>
            </svg>
        </div>

        <h1 class="mt-4 text-[#F7F4D5] text-xl font-semibold tracking-tight">
            Inventory Management System
        </h1>

        <p class="text-sm text-[#E8E6C8] mt-1">
            @if (request()->routeIs('login'))
                Login your account
            @elseif (request()->routeIs('register'))
                Create your account
            @else
                Welcome
            @endif
        </p>

    </div>

        <!-- Card -->
        <div class="bg-white rounded-xl shadow-lg border border-[#839958] p-6">
            {{ $slot }}
        </div>

    </div>

</div>

</body>
</html>