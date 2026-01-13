<x-layouts.app title="Quacks" :route="route('quacks.create')">

    @section('main')
        @foreach ($quacks as $quack)
            <article class="index">
                <p><b>{{ $quack->user->display_name }}</b> <span
                        class="text-muted">{{ '@' }}{{ $quack->user->username }}
                        ·
                        {{ $quack->created_at->diffForHumans(null, true, true, 1) }}</span></p>
                <p>{{ $quack->content }}</p>
                <div class="resource-actions">
                    <a href="{{ route('quacks.show', $quack) }}">Mostrar más</a>
                    @can('manage', $quack)
                        <a href="{{ route('quacks.edit', $quack) }}">Editar</a>
                        <form method="POST" action="{{ route('quacks.destroy', $quack) }}">
                            @csrf
                            @method('DELETE')
                            <button>Eliminar</button>
                        </form>
                    @endcan
                </div>
            </article>
        @endforeach
    @endsection

</x-layouts.app>
