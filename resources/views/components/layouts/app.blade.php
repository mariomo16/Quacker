@props(['title', 'route']) {{-- https://laravel.com/docs/12.x/blade#data-properties-attributes --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} / {{ config('app.name') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @auth
        <header>
            <x-auth-user-profile />
        </header>
        <aside>
            <x-sidebar-nav :route="$route" />
        </aside>
    @endauth
    <main>
        @yield('main')
    </main>
</body>

</html>
