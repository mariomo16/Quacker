<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //Funcion para iniciar Sesion
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/quacks');
        }

        return back()->withErrors([
            'email' => 'Credenciales incorrectas.',
        ]);
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    //Funcion de Registro
    public function register(Request $request)
    {
        $data = $request->validate([
            'display_name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'email' => ['required', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        $user = User::create([
            'display_name' => $data['display_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'email_verified_at' => now(),
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect('/quacks');
    }

    //Función de Cerrar Sesion
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    //Aqui con esta funcion ocultamos el login a la hora de que estas dentro de la pagina de quacks
    public function showLogin()
    {
        if (auth()->check()) {
            return redirect('/quacks');
        }

        return view('auth.login');
    }
}