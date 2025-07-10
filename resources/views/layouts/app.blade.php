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
    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">


    <!-- Scripts VITE DESACTIVADOS PARA ASSETS EN HOSTINGUER
        @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/main.js', 'resources/css/style.css'])-->

    <!--NUEVOS LINKS PARA COMPLIACION EN SUBCARPETAS DE LIFECAPUTE EN HOSTINGUER-->

    <link rel="stylesheet" href="{{ asset('build/assets/app-DLeKCgwp.css') }}">
    <link rel="stylesheet" href="{{ asset('build/assets/app-DX4crK43.css') }}">

    <script src="{{ asset('build/assets/app-Du8iItK3.js') }}" defer></script>
    <script src="{{ asset('build/assets/main-SjaNfK8j.js') }}" defer></script>



</head>

<body class="font-sans antialiased">
    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')

        <!-- Page Heading -->
        @isset($header)
            <header class="bg-white dark:bg-gray-800 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endisset

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>
</body>

</html>