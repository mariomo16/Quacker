<x-layouts.app :title="'Quack ' . $quack->id" :route="route('quacks.create')">

    @section('main')
        <article class="show">
            <p>{{ $quack->user->display_name }} <span
                    class="text-muted">{{ '@' }}{{ $quack->user->username }}</span>
            </p>
            <p class="quack-content">{{ $quack->content }}</p>
            <p><span class="text-muted">{{ $quack->created_at->isoFormat('h:mm a · D MMM YYYY') }}</span></p>
            <div class="resource-actions">
                <a href="{{ route('quacks.index') }}">Volver</a>
                @can('manage', $quack)
                    <a href="{{ route('quacks.edit', $quack) }}">Editar</a>
                    <form method="POST" action="{{ route('quacks.destroy', $quack) }}">
                        @csrf
                        @method('DELETE')
                        <button class="btn-delete">Eliminar</button>
                    </form>
                @endcan
            </div>
        </article>
    @endsection

</x-layouts.app>
