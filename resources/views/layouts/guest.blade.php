<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=Kode+Mono&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-kode text-gray-900 antialiased">
        <div class="bg-gradient-to-b from-black via-[#4a0051] to-black">
            <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[url('/public/images/hexagonos_roxo_claro.png')] bg-contain">
                <div>
                    <a href="/login">
                        <x-application-logo class="w-16 h-16 fill-current text-[#a066a6] mb-6" />
                    </a>
                </div>
                <div class="w-full sm:max-w-md">
                    <x-modais id="modal">
                        {{ $slot }}
                    </x-modais>
                </div>
            </div>
        </div>
    </body>
</html>
