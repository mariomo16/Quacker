{{-- https://laravel.com/docs/12.x/blade#anonymous-components --}}
<div class="auth-user-profile">
    {{-- https://laravel.com/docs/12.x/strings#method-fluent-str-substr --}}
    <div class="auth-user-avatar unselectable">{{ Str::of(auth()->user()->display_name)->substr(0, 1) }}</div>

    <div class="auth-user-info">
        <strong>{{ auth()->user()->display_name }}</strong>
        <span class="text-muted">{{ '@' }}{{ auth()->user()->username }}</span>
    </div>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <button type="submit" class="auth-user-logout-btn"><x-icon.logout /></button>
    </form>
</div>
