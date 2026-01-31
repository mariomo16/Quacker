<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    /** 
     * Registra un nuevo usuario a partir de los datos validados,
     * normaliza el username, inicia sesión automáticamente,
     * regenera la sesión y redirige al feed.
     */
    public function store(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['username'] = str_replace(' ', '.', $data['username']);

        $user = User::create($data);

        Auth::login($user);
        $request->session()->regenerate();

        return to_route('feed');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Intenta iniciar sesión con las credenciales validadas.
     * Regenera la sesión en caso de éxito y redirige al feed;
     * en caso de fallo, retorna al formulario con mensaje de error.
     */
    public function login(LoginRequest $request)
    {
        $credentials = $request->validated();

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return to_route('feed');
        }

        return back()->withErrors([
            'email' => 'Credenciales incorrectas'
        ]);
    }

    /**
     * Cierra la sesión actual,
     * invalida la sesión y regenera el token CSRF,
     * luego redirige al formulario de login.
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return to_route('login');
    }
}
