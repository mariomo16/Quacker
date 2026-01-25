<x-layouts.app :title="'@' . $user->username" :route="route('users.create')">

    @section('main')
        <article class="user-show">
            <div class="user-user-avatar select-none">
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
                    <p>
                        <span class="text-muted">Correo electrónico: {{ $user->email }}</span>
                    </p>
                    <p>
                        <span class="text-muted">Se unió en {{ $user->created_at->isoFormat('MMMM') }} de
                            {{ $user->created_at->isoFormat('YYYY') }}
                        </span>
                    </p>
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
                        <a href="{{ route('users.index') }}">Volver</a>
                        @if ($user->id === Auth::user()->id)
                                <a href="{{ route('editAuth') }}">Editar</a>
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
    @endsection

</x-layouts.app>
