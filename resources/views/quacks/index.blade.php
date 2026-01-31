<x-layouts.app title="Quacks" :route="route('quacks.create')">

    @section('main')
        @foreach ($quacks as $quack)
            <article class="index">
                <div class="quack-user-avatar select-none">
                    {{ Str::of(strtoupper($quack->user->display_name))->substr(0, 1) }}
                </div>

                <div class="quack-content">
                    <div class="flex gap-1">
                        @if ($quack->user->email_verified_at)
                            <x-icon.verified />
                        @endif
                        <a href="{{ route('user.quacks', $quack->user_id) }}">
                            <strong class="hover:underline">{{ $quack->user->display_name }}</strong>
                            <span class="text-muted">{{ '@' }}{{ $quack->user->username }}</span>
                        </a>
                        <span class="text-muted">
                            · <time>{{ $quack->created_at->diffForHumans(null, true, true, 1) }}</time>
                        </span>
                    </div>

                    <p>{{ $quack->content }}</p>

                    <div class="quack-toolbar select-none">
                        <div class="quack-social">
                            <livewire:quav :quackId="$quack->id" />
                            <livewire:requack :quackId="$quack->id" />
                        </div>

                        <div class="quack-actions">
                            <a href="{{ route('quacks.show', $quack) }}">Mostrar más</a>
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
        @endforeach
    @endsection

</x-layouts.app>
