<x-layouts.app title="Usuarios" :route="route('users.create')">

    @section('main')
        @foreach ($users as $user)
            <article class="index">
                <div class="quack-user-avatar select-none">
                    {{ Str::of(strtoupper($user->display_name))->substr(0, 1) }}
                </div>

                <div class="user-card">
                    <div class="user-info">
                        <p>
                        <div class="user-popularity select-none">
                            <div class="user-quack">
                                <x-icon.quack />
                                {{ $user->quacks_count }}
                            </div>
                            <div class="user-quav">
                                <x-icon.quav :isQuaved="false" />
                                {{ '?' }}
                            </div>
                            <div class="user-requack">
                                <x-icon.requack :isRequacked="false" />
                                {{ '?' }}
                            </div>
                        </div>
                        <strong>{{ $user->display_name }}</strong>
                        <span class="text-muted">{{ '@' }}{{ $user->username }}</span>
                        </p>
                        <span class="text-muted">{{ $user->email }}</span>
                    </div>

                    <div class="user-toolbar select-none">
                        <div class="user-social">
                            <span class="text-muted">Seguidos: {{ $user->following_count }}</span>
                            <button type="submit" class="user-follow">
                                <x-icon.follow :isFollowed="$user->isFollowedByAuth()" />
                                {{ $user->followers_count }}
                            </button>
                        </div>

                        <div class="user-actions">
                            <a href="{{ route('users.show', $user) }}">Mostrar más</a>
                            @if ($user->id === auth()->user()->id)
                                <a href="{{ route('editMe') }}">Editar</a>
                            @else
                                <a href="{{ route('users.edit', $user) }}">Editar</a>
                            @endif
                            <form method="POST" action="{{ route('users.destroy', $user) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>

            </article>
        @endforeach
    @endsection

</x-layouts.app>
