{{-- https://laravel.com/docs/12.x/blade#anonymous-components --}}
@props(['title', 'route']) {{-- https://laravel.com/docs/12.x/blade#data-properties-attributes --}}

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title }} / {{ config('app.name') }}</title>
    <x-fonts />
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>
    @auth
        <header>
            <div></div>
            {{-- https://laravel.com/docs/12.x/requests#inspecting-the-request-path --}}
            <nav class="main-nav">
                <a href="{{ route('feed') }}"
                    class="{{ request()->routeIs('feed') ? 'active-route' : '' }}"><x-icon.slash />Feed</a>
                <a href="{{ route('quacks.index') }}"
                    class="{{ request()->routeIs('quacks.*') ? 'active-route' : '' }}"><x-icon.quack />Quacks</a>
                <a href="{{ route('quashtags.index') }}"
                    class="{{ request()->routeIs('quashtags.*') ? 'active-route' : '' }}"><x-icon.quashtag />Quashtags</a>
                <a href="{{ route('users.index') }}"
                    class="{{ request()->routeIs('users.*') ? 'active-route' : '' }}"><x-icon.user />Usuarios</a>
                {{-- <a href="{{ $route }}"><x-icon.plus />Crear recurso</a> --}}
            </nav>

            <div class="flex gap-3">
                <div class="app-logo">
                    <a href="https://github.com/mariomo16/Quacker" target="_blank">
                        <x-icon.github />
                    </a>
                </div>
                {{-- https://laravel.com/docs/12.x/strings#method-fluent-str-substr --}}
                <div class="auth-user-profile">
                    <div class="flex gap-2">
                        <div class="auth-user-avatar">
                            {{ Str::of(strtoupper(auth()->user()->display_name))->substr(0, 1) }}
                        </div>
    
                        <div class="auth-user-info">
                            <strong>{{ auth()->user()->display_name }}</strong>
                            <span class="text-muted">{{ '@' }}{{ auth()->user()->username }}</span>
                        </div>
                    </div>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="auth-user-logout-btn"><x-icon.logout /></button>
                    </form>
                </div>
            </div>
        </header>
    @endauth
    <main @class(['main-auth-form' => !auth()->check()])>
        @yield('main')
    </main>
</body>

</html>
