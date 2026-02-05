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

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="bg-gradient-to-b from-black via-[#4a0051] to-black">
            <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-[url('/public/images/hexagonos_roxo_claro.png')] bg-contain">
                <!-- <div>
                    <a href="/">
                        <x-application-logo class="w-16 h-16 fill-current text-[#a066a6]" />
                    </a>
                </div> -->
                <div class="relative w-full sm:max-w-md mt-6">
                    <div class="h-[calc(100%+0.5rem)] w-[calc(100%+0.5rem)] absolute bottom-0 right-0 rounded-lg bg-[#a066a6]"></div>
                    <div class="h-[calc(100%+0.5rem)] w-[calc(100%+0.5rem)] absolute top-0 left-0 rounded-lg bg-[#419089]"></div>
                    <div class="relative px-6 py-4 bg-white overflow-hidden sm:rounded-tl-lg sm:rounded-br-lg z-50">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
