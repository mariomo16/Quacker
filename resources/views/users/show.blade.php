<x-layouts.app :title="'@' . $user->username" :route="route('users.create')">

    @section('main')
        <article class="show">
            <p>{{ $user->display_name }} <span class="text-muted">{{ '@' }}{{ $user->username }}</span></p>
            <p class="user-content"><span class="text-muted">Correo electrónico: {{ $user->email }}</span></p>
            <p class="user-content"><span class="text-muted">Se unió en {{ $user->created_at->isoFormat('MMMM') }} de
                    {{ $user->created_at->isoFormat('YYYY') }}</span></p>

            <div class="resource-actions">
                <a href="{{ route('users.index') }}">Volver</a>
                <a href="{{ route('users.edit', $user) }}">Editar</a>
                <form method="POST" action="{{ route('users.destroy', $user) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn-delete">Eliminar</button>
                </form>
            </div>
        </article>
    @endsection

</x-layouts.app>
