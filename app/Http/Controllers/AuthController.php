<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('sesiones.login');
    }

    public function storeLogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            // Si las credenciales son correctas, regenera la sesión para evitar ataques de fijación de sesión
            $request->session()->regenerate();
            // Redirige al usuario a la URL que intentó visitar antes de ser redirigido al login, o al 'home' por defecto
            return redirect()->intended('/dashboard');
        }

        // Si la autenticación falla, redirige de nuevo al formulario de login con un error
        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas no coinciden con nuestros registros.',
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout(); // Cierra la sesión
        $request->session()->invalidate(); // Invalida la sesión
        $request->session()->regenerateToken(); // Regenera el token CSRF
        return redirect('/'); // Redirige al inicio
    }
}
