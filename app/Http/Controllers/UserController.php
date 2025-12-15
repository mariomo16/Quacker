<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.index', [
            'users' => User::latest()->get()
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
    public function store(Request $request)
    {
        $request->validate(
            [
                'username' => 'required|max:15|unique:users,username',
                'display_name' => 'required|max:50',
                'email' => 'required|email|unique:users,email',
                'password' => 'required',
            ],
            [
                'username.required' => 'Este campo es obligatorio',
                'username.max' => 'Máximo 15 caracteres',
                'username.unique' => 'Este nombre de usuario ya esta en uso',
                'display_name.required' => 'Este campo es obligatorio',
                'display_name.max' => 'Máximo 50 caracteres',
                'email.required' => 'Este campo es obligatorio',
                'email.email' => 'Introduce un correo electrónico válido',
                'email.unique' => 'Este correo electrónico ya esta en uso',
                'password.required' => 'Este campo es obligatorio',
            ]
        );

        User::create($request->all());
        return redirect('/users');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        return view('users.show', [
            'user' => $user
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
    public function update(Request $request, User $user)
    {
        $request->validate(
            [
                'username' => ['required', 'max:15', Rule::unique('users', 'username')->ignore($user->id)],
                'display_name' => 'required|max:50',
                'email' => ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)],
                'password' => 'required',
            ],
            [
                'username.required' => 'Este campo es obligatorio',
                'username.max' => 'Máximo 15 caracteres',
                'username.unique' => 'Este nombre de usuario ya esta en uso',
                'display_name.required' => 'Este campo es obligatorio',
                'display_name.max' => 'Máximo 50 caracteres',
                'email.required' => 'Este campo es obligatorio',
                'email.email' => 'Introduce un correo electrónico válido',
                'email.unique' => 'Este correo electrónico ya esta en uso',
                'password.required' => 'Este campo es obligatorio',
            ]
        );

        $user->update($request->all());
        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);
        return redirect('/users');
    }
}
