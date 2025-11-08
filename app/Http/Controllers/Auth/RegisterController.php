<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use App\Business;
use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Auth::user()->isAdmin()) {
                return redirect()->route('dashboard')
                    ->with('error', 'Solo los administradores pueden crear cuentas.');
            }
            return $next($request);
        });
    }

    public function showRegistrationForm()
    {
        $categories = Category::where('is_active', true)->orderBy('name')->get();
        return view('auth.register', compact('categories'));
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['nullable', 'string', 'max:20'],
            'password' => ['required', 'confirmed', Password::defaults()],
            'business_name' => ['required', 'string', 'max:255'],
            'business_category' => ['required', 'exists:categories,id'],
            'business_email' => ['nullable', 'string', 'email', 'max:255'],
            'business_phone' => ['nullable', 'string', 'max:20'],
            'business_address' => ['nullable', 'string', 'max:500'],
        ]);

        // Crear el negocio
        $business = Business::create([
            'name' => $validated['business_name'],
            'slug' => \Illuminate\Support\Str::slug($validated['business_name']),
            'email' => $validated['business_email'] ?? $validated['email'],
            'phone' => $validated['business_phone'] ?? $validated['phone'],
            'address' => $validated['business_address'] ?? null,
            'category_id' => $validated['business_category'],
            'is_active' => true,
        ]);

        // Crear el usuario
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
            'business_id' => $business->id,
            'role' => 'business',
            'email_verified_at' => now(),
        ]);

        return redirect()->route('admin.users')
            ->with('success', "Usuario y negocio '{$business->name}' creados exitosamente.");
    }
}

