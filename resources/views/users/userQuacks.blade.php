<x-layouts.app title="Quacks" :route="route('quacks.create')">

    @section('main')
        @foreach ($quacks as $quack)
            @if ($quack->user->id === $user_id || $quack->hasRequacked($user_id))
                <article class="index">
                    <div class="quack-user-avatar select-none">
                        {{ Str::of(strtoupper($quack->user->display_name))->substr(0, 1) }}
                    </div>

                    <div class="quack-content">
                        <p>
                            <strong>{{ $quack->user->display_name }}</strong>
                            <span class="text-muted">{{ '@' }}{{ $quack->user->username }} ·
                                <time>{{ $quack->created_at->diffForHumans(null, true, true, 1) }}</time>
                            </span>
                        </p>

                        <p>{{ $quack->content }}</p>

                        <div class="quack-toolbar select-none">
                            <div class="quack-social">
                                <form method="" action="">
                                    <button type="submit" class="quack-quav">
                                        <x-icon.quav />
                                        {{ '0' }}
                                    </button>
                                </form>
                                <form method="" action="">
                                    <button type="submit" class="quack-requack">
                                        <x-icon.requack />
                                        {{ '0' }}
                                    </button>
                                </form>
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
            @endif
        @endforeach
    @endsection

</x-layouts.app>
