<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ Cookie::get('theme', 'light') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'Laravel') }}</title>


    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset("dist/css/app.css") }}"/>

    <!-- Scripts -->
    @routes
    <script src="{{ mix('js/app.js') }}" defer></script>
    @inertiaHead
</head>
<body class="font-sans antialiased login">
@inertia
<!-- BEGIN: Dark Mode Switcher-->
<div data-url="{{ route('switch-theme') }}"
     class="dark-mode-switcher cursor-pointer shadow-md fixed bottom-0 right-0 box dark:bg-dark-2 border rounded-full w-40 h-12 flex items-center justify-center z-50 mb-10 mr-10">
    <div class="mr-4 text-gray-700 dark:text-gray-300">
        dark mode
    </div>
    <div
        class="dark-mode-switcher__toggle border {{ Cookie::get('theme', 'light') === 'dark' ? 'dark-mode-switcher__toggle--active' : '' }}"></div>
</div>
<!-- END: Dark Mode Switcher-->
<script src="{{ asset("dist/js/app.js") }}" defer></script>
</body>
</html>
