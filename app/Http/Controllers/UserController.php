<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    /**
     * Muestra todos los usuarios con sus contadores de quacks, quavs, requacks,
     * seguidores y seguidos, ordenados por ID descendente.
     */
    public function index()
    {
        $users = User::withCount(['quacks', 'following'])
            ->withSum([
                'quacks as quavs_count' => fn($q) =>
                    $q->leftJoin('quavs', 'quavs.quack_id', '=', 'quacks.id')
                        ->select(DB::raw('COUNT(quavs.quack_id)')),
                'quacks as requacks_count' => fn($q) =>
                    $q->leftJoin('requacks', 'requacks.quack_id', '=', 'quacks.id')
                        ->select(DB::raw('COUNT(requacks.quack_id)'))
            ], 'quack_id')
            ->latest()
            ->get();

        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    /**
     * Crea un nuevo usuario a partir de los datos validados,
     * reemplazando espacios en el username por puntos, y redirige al index.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['username'] = str_replace(' ', '.', $data['username']);

        User::create($data);

        return to_route('users.index');
    }

    /**
     * Muestra un usuario específico con sus contadores de quacks, quavs, requacks,
     * seguidores y seguidos, ordenados por ID.
     */
    public function show(User $user)
    {
        $user = User::withCount(['quacks', 'following', 'followers',])
            ->withCount([
                'quacks as quavs_count' => fn($q) =>
                    $q->select(DB::raw('(SELECT COUNT(*) FROM quavs WHERE quavs.quack_id = quacks.id)')),
                'quacks as requacks_count' => fn($q) =>
                    $q->select(DB::raw('(SELECT COUNT(*) FROM requacks WHERE requacks.quack_id = quacks.id)'))
            ])
            ->find($user->id);

        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $this->authorize('manageProfile', $user);

        return view('users.edit', compact('user'));
    }

    /**
     * Actualizar un usuario tras comprobar que corresponde al usuario autenticado,
     * ignorando campos vacíos (por ejemplo, para no modificar la contraseña) 
     * y normalizando el username.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $this->authorize('manageProfile', $user);

        $data = array_filter($request->validated());
        $data['username'] = str_replace(' ', '.', $data['username']);

        $user->update($data);

        return to_route('users.show', [$user]);
    }

    /**
     * Elimina un usuario tras comprobar que corresponde al usuario autenticado.
     */
    public function destroy(User $user)
    {
        $this->authorize('manageProfile', $user);

        $user->delete();

        return to_route('users.index');
    }

    public function editMe()
    {
        $user = auth()->user();

        return view('users.edit', compact('user'));
    }
}
