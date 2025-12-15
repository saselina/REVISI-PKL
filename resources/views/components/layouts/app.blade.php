@props(['title' => '', 'hideNavbar' => false])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $title ? $title . ' — ' : '' }}{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased bg-gray-100 min-h-screen">

    {{-- NAVBAR (bisa di-hide) --}}
    @unless($hideNavbar)
    
        @livewire('layout.navigation')
    @endunless

    {{-- HEADER --}}
    @isset($header)
        <header class="bg-white shadow">
            <div class="text-2xl font-semibold text-white bg-pink-400 py-2 rounded-t-lg text-center">
                {{ $header }}
            </div>
        </header>
    @endisset

    {{-- MAIN CONTENT --}}
    <main class="max-w-7xl mx-auto p-6">
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>
