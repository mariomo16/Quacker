<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index', [
            'users' => User::withCount(['quacks', 'following', 'followers',])
                ->withCount([
                    'quacks as quavs_count' => function ($q) {
                        $q->select(\DB::raw('(SELECT COUNT(*) FROM quavs WHERE quavs.quack_id = quacks.id)'));
                    }
                ])
                ->withCount([
                    'quacks as requacks_count' => function ($q) {
                        $q->select(\DB::raw('(SELECT COUNT(*) FROM requacks WHERE requacks.quack_id = quacks.id)'));
                    }
                ])
                ->orderByDesc('id')->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $data = $request->validated();
        $data['username'] = str_replace(' ', '.', $data['username']);

        User::create($data);
        return to_route('users.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', [
            'user' => User::withCount(['quacks', 'following', 'followers',])
                ->withCount([
                    'quacks as quavs_count' => function ($q) {
                        $q->select(\DB::raw('(SELECT COUNT(*) FROM quavs WHERE quavs.quack_id = quacks.id)'));
                    }
                ])
                ->withCount([
                    'quacks as requacks_count' => function ($q) {
                        $q->select(\DB::raw('(SELECT COUNT(*) FROM requacks WHERE requacks.quack_id = quacks.id)'));
                    }
                ])
                ->orderByDesc('id')->find($user->id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // Evita que se puedan hacer peticiones POST para actualizar usuarios distintos al usuario autenticado
        $this->authorize('updateUser', $user);

        $data = array_filter($request->validated());
        $data['username'] = str_replace(' ', '.', $data['username']);

        $user->update($data);
        return to_route('users.show', [$user]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        // Evita que se puedan hacer peticiones POST para actualizar usuarios distintos al usuario autenticado
        $this->authorize('updateUser', $user);

        User::destroy($user);
        return to_route('users.index');
    }

    public function editMe()
    {
        return view('users.edit', [
            'user' => auth()->user()
        ]);
    }
}
