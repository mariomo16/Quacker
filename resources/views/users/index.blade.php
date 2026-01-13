<x-layouts.app title="Usuarios" :route="route('users.create')">

    @section('main')
        @foreach ($users as $user)
            <article class="index">
                <p><b>{{ $user->display_name }}</b> <span class="text-muted">{{ '@' }}{{ $user->username }}</span>
                </p>
                <div class="resource-actions">
                    <a href="{{ route('users.show', $user) }}">Mostrar más</a>
                    <a href="{{ route('users.edit', $user) }}">Editar</a>
                    <form method="POST" action="{{ route('users.destroy', $user) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn-delete">Eliminar</button>
                    </form>
                </div>
            </article>
        @endforeach
    @endsection

</x-layouts.app>
