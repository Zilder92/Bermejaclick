<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Helpers\ActivityLogger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            // Registrar login exitoso (con manejo de errores)
            try {
                ActivityLogger::logLogin(
                    Auth::user(),
                    $request->ip(),
                    $request->userAgent()
                );
            } catch (\Exception $e) {
                // Log error pero no interrumpir el login
                \Log::error('Error al registrar login: ' . $e->getMessage());
            }
            
            return redirect()->intended(route('dashboard'));
        }

        // Registrar intento de login fallido (con manejo de errores)
        try {
            ActivityLogger::logLoginFailed(
                $request->email,
                'Credenciales incorrectas',
                $request->ip(),
                $request->userAgent()
            );
        } catch (\Exception $e) {
            \Log::error('Error al registrar login fallido: ' . $e->getMessage());
        }

        throw ValidationException::withMessages([
            'email' => __('Las credenciales proporcionadas no son correctas.'),
        ]);
    }

    public function logout(Request $request)
    {
        $user = Auth::user();
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        // Registrar logout (con manejo de errores)
        if ($user) {
            try {
                ActivityLogger::logLogout(
                    $user,
                    $request->ip(),
                    $request->userAgent()
                );
            } catch (\Exception $e) {
                \Log::error('Error al registrar logout: ' . $e->getMessage());
            }
        }
        
        return redirect()->route('home');
    }
}
