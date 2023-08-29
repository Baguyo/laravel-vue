<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>SPA</title>

        {{-- INERTIA PROGRESS INDICATOR --}}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/nprogress/0.2.0/nprogress.min.css" />

        <!-- Fonts -->
        <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        @routes
        @vite('resources/js/app.js')
        @inertiaHead
    </head>
    <body class="bg-white dar:bg-gray-900 text-gray-800">
        @inertia

    </body>
</html>
