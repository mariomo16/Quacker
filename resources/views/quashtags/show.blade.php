<x-layouts.app :title="'🦆' . $quashtag->name" :route="route('quashtags.create')">

    @section('main')
        <article class="quashtag-show">
            <div>
                <p>
                    🦆{{ $quashtag->name }}
                    <span class="text-muted">ID: {{ $quashtag->id }}</span>
                </p>
                <p>
                    <span class="text-muted">Creado en {{ $quashtag->created_at->isoFormat('MMMM') }} de
                        {{ $quashtag->created_at->isoFormat('YYYY') }}
                    </span>
                </p>
            </div>

            <div class="quashtag-actions select-none">
                <a href="{{ url()->previous(route('quashtags.index')) }}">Volver</a>
                <a href="{{ route('quashtags.edit', $quashtag) }}">Editar</a>
                <form method="POST" action="{{ route('quashtags.destroy', $quashtag) }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </div>
        </article>
    @endsection

</x-layouts.app>
