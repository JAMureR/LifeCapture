<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>LifeCapture</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts VITE DESACTIVADOS PARA ASSETS EN HOSTINGUER
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/main.js', 'resources/css/style.css'])-->

    <!--NUEVOS LINKS PARA COMPLIACION EN SUBCARPETA DE LIFECAPUTE EN HOSTINGUER-->

    <link rel="stylesheet" href="{{ asset('build/assets/app-DLeKCgwp.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/app-DX4crK43.css') }}">

    <script src="{{ asset('build/assets/app-Du8iItK3.js') }}" defer></script>
    <script src="{{ asset('build/assets/main-SjaNfK8j.js') }}" defer></script>

    </head>
    <body class="font-sans text-gray-900 antialiased">
        <div class="min-h-screen flex flex-col sm:justify-center items-center py-0 sm:pt-0 bg-gray-100 dark:bg-gray-900">
            <div class="logo-wrapper">
                <a href="/">
                    <img src="{{ asset('img/Logo_aplicacion.png') }}" alt="Logo_login" class="logo_login block mb-0" />
                </a>
            </div>

            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white dark:bg-gray-800 shadow-md overflow-hidden sm:rounded-lg">
                {{ $slot }}
            </div>
        </div>
    </body>
</html>
