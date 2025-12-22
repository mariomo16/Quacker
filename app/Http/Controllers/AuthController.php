<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Método para mostrar el formulario de registro 
    public function create()
    {
        return view('auth.register');
    }

    // Método para registrar un usuario e iniciar sesión automáticamente 
    public function store(Request $request)
    {
        $data = $request->validate([
            'display_name' => ['required', 'string', 'max:50'],
            'username' => ['required', 'string', 'max:15', 'unique:users,username'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'string', 'min:6', 'confirmed']
        ]);

        $user = User::create([
            'display_name' => $data['display_name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'email_verified_at' => now(),
            'password' => Hash::make($data['password'])
        ]);

        Auth::login($user);
        $request->session()->regenerate();

        return redirect()->route('quacks.index');
    }

    // Método para mostrar el formulario de inicio de sesión 
    public function showLoginForm()
    {
        if (auth()->check()) {
            return redirect('/quacks');
        }

        return view('auth.login');
    }

    // Método para iniciar sesión
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('quacks.index'));
        }

        return back()->withErrors([
            'email' => 'Credenciales incorrectas.'
        ]);
    }

    // Método para cerrar sesión 
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
