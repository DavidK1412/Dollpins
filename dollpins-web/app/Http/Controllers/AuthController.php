<?php

namespace App\Http\Controllers;

use App\Services\AuthUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    protected $authUserService;

    public function __construct(AuthUserService $authUserService)
    {
        $this->authUserService = $authUserService;
    }

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email|unique:authuser',
            'password' => 'required|min:6',
        ]);

        $data['role_id'] = 1;

        $this->authUserService->create($data);
        return redirect()->route('login')->with('success', 'Registro exitoso. Puedes iniciar sesión.');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($this->authUserService->login($credentials)) {
            return redirect()->intended('/'); // Redirigir a la página de inicio o a la página deseada
        }

        return back()->withErrors([
            'email' => 'Las credenciales proporcionadas son incorrectas.',
        ]);
    }

    public function logout()
    {
        $this->authUserService->logout();
        return redirect()->route('login')->with('success', 'Has cerrado sesión exitosamente.');
    }
}
