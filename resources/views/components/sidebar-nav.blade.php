{{-- https://laravel.com/docs/12.x/blade#anonymous-components --}}
{{-- https://laravel.com/docs/12.x/requests#inspecting-the-request-path --}}
@props(['route'])

<nav class="sidebar-nav">
    <a href="{{ $route }}"><x-icon.plus /></a>
    <a href="{{ route('users.index') }}"
        class="{{ request()->routeIs('users.*') ? 'active-route' : '' }}"><x-icon.user /></a>
    <a href="{{ route('quacks.index') }}"
        class="{{ request()->routeIs('quacks.*') ? 'active-route' : '' }}"><x-icon.quack /></a>
    <a href="{{ route('quashtags.index') }}"
        class="{{ request()->routeIs('quashtags.*') ? 'active-route' : '' }}"><x-icon.quashtag /></a>
</nav>
