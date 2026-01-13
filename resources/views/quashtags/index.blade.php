<x-layouts.app title="Quashtags" :route="route('quashtags.create')">

    @section('main')
        @foreach ($quashtags as $quashtag)
            <article class="index">
                <p>🦆{{ $quashtag->name }} <span class="text-muted">ID: {{ $quashtag->id }}</span></p>
                <div class="resource-actions">
                    <a href="{{ route('quashtags.show', $quashtag) }}">Mostrar más</a>
                    <a href="{{ route('quashtags.edit', $quashtag) }}">Editar</a>
                    <form method="POST" action="{{ route('quashtags.destroy', $quashtag) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn-delete">Eliminar</button>
                    </form>
                </div>
            </article>
        @endforeach
    @endsection

</x-layouts.app>
