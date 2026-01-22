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
                                    {{ '0' }}
                                </div>
                                <div class="user-quav">
                                    <x-icon.quav />
                                    {{ '0' }}
                                </div>
                                <div class="user-requack">
                                    <x-icon.requack />
                                    {{ '0' }}
                                </div>
                            </div>
                            <strong>{{ $user->display_name }}</strong>
                            <span class="text-muted">{{ '@' }}{{ $user->username }}</span>
                        </p>
                        <span class="text-muted">{{ $user->email }}</span>
                    </div>

                    <div class="user-toolbar select-none">
                        <div class="user-social">
                            <span class="text-muted">Seguidos: {{ '0' }}</span>
                            <button type="submit" class="user-follow">
                                <x-icon.follow />
                                {{ '0' }}
                            </button>
                        </div>
                        
                        <div class="user-actions">
                            <a href="{{ route('users.show', $user) }}">Mostrar más</a>
                            <a href="{{ route('users.edit', $user) }}">Editar</a>
                            <form method="" action="{{ route('users.destroy', $user) }}">
                                <button type="submit">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>

            </article>
        @endforeach
    @endsection

</x-layouts.app>
