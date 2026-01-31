<x-layouts.app title="Quashtags" :route="route('quashtags.create')">

    @section('main')
        @foreach ($quashtags as $quashtag)
            <article class="index">
                <div class="quashtag-card">
                    <p>🦆{{ $quashtag->name }} <span class="text-muted">ID: {{ $quashtag->id }}</span></p>
                    <div class="quashtag-actions select-none">
                        {{-- <form method="POST" action="{{ route('quashtags.destroy', $quashtag) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Eliminar</button>
                        </form>
                        <a href="{{ route('quashtags.edit', $quashtag) }}">Editar</a> --}}
                        <a href="{{ route('quashtag.quacks', $quashtag->id) }}">Mostrar más</a>
                    </div>
                </div>
            </article>
        @endforeach
    @endsection

</x-layouts.app>
