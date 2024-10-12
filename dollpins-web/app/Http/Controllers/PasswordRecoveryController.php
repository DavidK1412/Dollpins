<?php

namespace App\Http\Controllers;

use App\Services\RecoveryPasswordService;
use App\Services\MailService;
use App\Services\AuthUserService;
use Illuminate\Http\Request;

class PasswordRecoveryController extends Controller
{
    protected $passwordService;
    protected $mailService;
    protected $authUserService;

    public function __construct(RecoveryPasswordService $passwordService, MailService $mailService, AuthUserService $authUserService)
    {
        $this->passwordService = $passwordService;
        $this->mailService = $mailService;
        $this->authUserService = $authUserService;
    }

    public function showRequestForm()
    {
        return view('auth.forgot');
    }

    public function generateToken(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        $user = $this->authUserService->getByEmail($request->email);
        if ($user) {
            $token = $this->passwordService->generateToken($user);
            $this->mailService->send($user->email, 'Recuperación de contraseña', 'emails.recovery',
                ['name' => $user->email, 'url' => route('password.reset', $token)]);
            return back()->with('success', 'Se ha enviado un correo con las instrucciones para recuperar la contraseña');
        }
        return back()->with('error', 'No se ha encontrado un usuario con ese correo');
    }

    public function showResetForm($token)
    {
        if ($this->passwordService->validateToken($token)) {
            return view('auth.reset', ['token' => $token]);
        }
        return redirect()->route('password.request')->with('error', 'El token ha expirado o es inválido');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|min:6|confirmed'
        ]);
        $token = $this->passwordService->validateToken($request->token);
        if ($token) {
            $this->authUserService->changePassword($token->user, $request->password);
            $this->passwordService->deleteToken($token->user_id);
            return redirect()->route('login')->with('success', 'Contraseña actualizada correctamente');
        }
        return redirect()->route('password.request')->with('error', 'El token ha expirado o es inválido');
    }

}
