<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Método para mostrar el formulario de registro 
    public function create()
    {
        return view('auth.register');
    }

    // Método para registrar un usuario e iniciar sesión automáticamente 
    public function store(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['username'] = str_replace(' ', '.', $data['username']);

        $user = User::create($data);

        Auth::login($user);
        $request->session()->regenerate();

        return to_route('quacks.index');
    }

    // Método para mostrar el formulario de inicio de sesión 
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Método para iniciar sesión
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return to_route('quacks.index');
        }

        return back()->withErrors([
            'email' => 'Credenciales incorrectas'
        ]);
    }

    // Método para cerrar sesión 
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('login');
    }
}
