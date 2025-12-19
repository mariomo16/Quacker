<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quacks / {{ config('app.name') }}</title>
    @vite(['resources/css/app.css'])
</head>

<body>
    @auth
        <div class="welcome">
            Bienvenido <strong>{{ auth()->user()->display_name }}</strong>
            <span class="welcome-user">&commat;{{ auth()->user()->username }}</span>

            <form method="POST" action="{{ route('logout') }}" class="logout-form">
                @csrf
                <button type="submit">Cerrar sesión</button>
            </form>
        </div>
    @endauth


    <main>
        @foreach ($quacks as $quack)
            <article>
                <p><b>{{ $quack->user->display_name }}</b> <span
                        class="text-muted">{{ '@' }}{{ $quack->user->username }}
                        ·
                        {{ $quack->created_at->diffForHumans(null, true, true, 1) }}</span></p>
                <p>{{ $quack->content }}</p>
                <div class="resource-actions">
                    <a href="/quacks/{{ $quack->id }}">Mostrar más</a>
                    <a href="/quacks/{{ $quack->id }}/edit">Editar</a>
                    <form method="POST" action="/quacks/{{ $quack->id }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn-delete">Eliminar</button>
                    </form>
                </div>
            </article>
        @endforeach
    </main>
    <nav class="nav-menu">
        <a href="/quacks/create"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40"
                fill="currentColor" class="bi bi-plus-lg" viewBox="0 0 16 16">
                <path fill-rule="evenodd"
                    d="M8 2a.5.5 0 0 1 .5.5v5h5a.5.5 0 0 1 0 1h-5v5a.5.5 0 0 1-1 0v-5h-5a.5.5 0 0 1 0-1h5v-5A.5.5 0 0 1 8 2" />
            </svg></a>
        <a href="/users"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                class="bi bi-person" viewBox="0 0 16 16">
                <path
                    d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z" />
            </svg></a>
        <a href="/quashtags"><svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor"
                class="bi bi-hash" viewBox="0 0 16 16">
                <path
                    d="M8.39 12.648a1 1 0 0 0-.015.18c0 .305.21.508.5.508.266 0 .492-.172.555-.477l.554-2.703h1.204c.421 0 .617-.234.617-.547 0-.312-.188-.53-.617-.53h-.985l.516-2.524h1.265c.43 0 .618-.227.618-.547 0-.313-.188-.524-.618-.524h-1.046l.476-2.304a1 1 0 0 0 .016-.164.51.51 0 0 0-.516-.516.54.54 0 0 0-.539.43l-.523 2.554H7.617l.477-2.304c.008-.04.015-.118.015-.164a.51.51 0 0 0-.523-.516.54.54 0 0 0-.531.43L6.53 5.484H5.414c-.43 0-.617.22-.617.532s.187.539.617.539h.906l-.515 2.523H4.609c-.421 0-.609.219-.609.531s.188.547.61.547h.976l-.516 2.492c-.008.04-.015.125-.015.18 0 .305.21.508.5.508.265 0 .492-.172.554-.477l.555-2.703h2.242zm-1-6.109h2.266l-.515 2.563H6.859l.532-2.563z" />
            </svg></a>
    </nav>
</body>

</body>

</html>
