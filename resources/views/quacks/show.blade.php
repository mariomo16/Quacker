<x-layouts.app :title="'Quack ' . $quack->id" :route="route('quacks.create')">

    @section('main')
        <article class="quack-show">
            <div class="quack-user-avatar select-none">
                {{ Str::of(strtoupper($quack->user->display_name))->substr(0, 1) }}
            </div>

            <div class="quack-content">
                <div>
                    <p>
                        <a href="{{ route('user.quacks', $quack->user_id) }}">
                            <strong class="hover:underline">{{ $quack->user->display_name }}</strong>
                            <span class="text-muted">{{ '@' }}{{ $quack->user->username }}</span>
                        </a>
                    </p>
                    <p>{{ $quack->content }}</p>
                </div>

                <time class="text-muted">{{ $quack->created_at->isoFormat('h:mm a D MMM YYYY') }}</time>

                <div class="quack-toolbar select-none">
                    <div class="quack-social">
                        <livewire:quav :quackId="$quack->id" />
                        <livewire:requack :quackId="$quack->id" />
                    </div>

                    <div class="quack-actions">
                        <a href="{{ route('quacks.index') }}">Volver</a>
                        @can('manage', $quack)
                            <a href="{{ route('quacks.edit', $quack) }}">Editar</a>
                            <form method="POST" action="{{ route('quacks.destroy', $quack) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Eliminar</button>
                            </form>
                        @endcan
                    </div>
                </div>
            </div>
        </article>
    @endsection

</x-layouts.app>
