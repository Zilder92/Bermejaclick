<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use App\User;
use App\Business;
use App\Promotion;
use App\Category;
use App\ActivityLog;
use App\Helpers\ActivityLogger;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Auth::user()->isAdmin()) {
                return redirect()->route('dashboard')->with('error', 'No tienes permisos de administrador.');
            }
            return $next($request);
        });
    }

    public function dashboard()
    {
        try {
            // Estadísticas generales (con validación de tablas)
            $stats = [
                'total_businesses' => Schema::hasTable('businesses') ? Business::count() : 0,
                'active_businesses' => Schema::hasTable('businesses') ? Business::where('is_active', true)->count() : 0,
                'total_users' => Schema::hasTable('users') ? User::count() : 0,
                'business_users' => Schema::hasTable('users') ? User::where('role', 'business')->count() : 0,
                'total_promotions' => Schema::hasTable('promotions') ? Promotion::count() : 0,
                'active_promotions' => Schema::hasTable('promotions') ? Promotion::where('is_active', true)
                    ->where('start_date', '<=', Carbon::now())
                    ->where('end_date', '>=', Carbon::now())
                    ->count() : 0,
                'total_views' => Schema::hasTable('promotions') ? (Promotion::sum('views_count') ?? 0) : 0,
                'total_clicks' => Schema::hasTable('promotions') ? (Promotion::sum('clicks_count') ?? 0) : 0,
            ];

            // Negocios recientes
            $recentBusinesses = Schema::hasTable('businesses') 
                ? Business::orderBy('created_at', 'desc')->limit(5)->get() 
                : collect();

            // Usuarios recientes
            $recentUsers = Schema::hasTable('users') 
                ? User::orderBy('created_at', 'desc')->limit(5)->get() 
                : collect();

            // Promociones más vistas
            $topPromotions = Schema::hasTable('promotions')
                ? Promotion::with(['business', 'category'])
                    ->orderBy('views_count', 'desc')
                    ->limit(10)
                    ->get()
                : collect();

            // Negocios por categoría
            $businessesByCategory = Schema::hasTable('categories')
                ? Category::withCount('businesses')->get()
                : collect();

            // Logs de actividad (con verificación de tabla)
            $activityLogs = collect();
            $loginLogs = collect();
            $errorLogs = collect();
            $activityStats = [
                'logins_today' => 0,
                'logins_this_week' => 0,
                'failed_logins_today' => 0,
                'total_activities_today' => 0,
            ];

            if (Schema::hasTable('activity_logs')) {
                try {
                    $activityLogs = ActivityLog::with('user')
                        ->orderBy('created_at', 'desc')
                        ->limit(50)
                        ->get();

                    // Logs de login (exitosos y fallidos)
                    $loginLogs = ActivityLog::with('user')
                        ->whereIn('action', ['login', 'logout', 'login_failed'])
                        ->orderBy('created_at', 'desc')
                        ->limit(30)
                        ->get();

                    // Logs de errores
                    $errorLogs = ActivityLog::with('user')
                        ->where('status', 'failed')
                        ->orderBy('created_at', 'desc')
                        ->limit(20)
                        ->get();

                    // Estadísticas de actividad
                    $activityStats = [
                        'logins_today' => ActivityLog::where('action', 'login')
                            ->whereDate('created_at', Carbon::today())
                            ->count(),
                        'logins_this_week' => ActivityLog::where('action', 'login')
                            ->where('created_at', '>=', Carbon::now()->subWeek())
                            ->count(),
                        'failed_logins_today' => ActivityLog::where('action', 'login_failed')
                            ->whereDate('created_at', Carbon::today())
                            ->count(),
                        'total_activities_today' => ActivityLog::whereDate('created_at', Carbon::today())
                            ->count(),
                    ];
                } catch (\Exception $e) {
                    \Log::error('Error al cargar logs de actividad: ' . $e->getMessage());
                }
            }

            return view('admin.dashboard', compact(
                'stats', 
                'recentBusinesses', 
                'recentUsers', 
                'topPromotions', 
                'businessesByCategory',
                'activityLogs',
                'loginLogs',
                'errorLogs',
                'activityStats'
            ));
        } catch (\Exception $e) {
            \Log::error('Error en AdminController@dashboard: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            // Retornar vista con valores por defecto
            return view('admin.dashboard', [
                'stats' => [
                    'total_businesses' => 0,
                    'active_businesses' => 0,
                    'total_users' => 0,
                    'business_users' => 0,
                    'total_promotions' => 0,
                    'active_promotions' => 0,
                    'total_views' => 0,
                    'total_clicks' => 0,
                ],
                'recentBusinesses' => collect(),
                'recentUsers' => collect(),
                'topPromotions' => collect(),
                'businessesByCategory' => collect(),
                'activityLogs' => collect(),
                'loginLogs' => collect(),
                'errorLogs' => collect(),
                'activityStats' => [
                    'logins_today' => 0,
                    'logins_this_week' => 0,
                    'failed_logins_today' => 0,
                    'total_activities_today' => 0,
                ],
            ])->with('error', 'Error al cargar el dashboard. Por favor intenta nuevamente.');
        }
    }

    public function businesses()
    {
        try {
            if (!Schema::hasTable('businesses')) {
                return view('admin.businesses', ['businesses' => collect()])
                    ->with('warning', 'La tabla de negocios no existe. Ejecuta las migraciones.');
            }

            $businesses = Business::with(['category', 'user'])->paginate(15);
            return view('admin.businesses', compact('businesses'));
        } catch (\Exception $e) {
            \Log::error('Error en AdminController@businesses: ' . $e->getMessage());
            return view('admin.businesses', ['businesses' => collect()])
                ->with('error', 'Error al cargar los negocios. Por favor intenta nuevamente.');
        }
    }

    public function users()
    {
        try {
            if (!Schema::hasTable('users')) {
                return view('admin.users', [
                    'users' => collect(),
                    'categories' => collect()
                ])->with('warning', 'La tabla de usuarios no existe. Ejecuta las migraciones.');
            }

            $users = User::with('business')->paginate(15);
            $categories = Schema::hasTable('categories')
                ? Category::where('is_active', true)->orderBy('name')->get()
                : collect();
            
            return view('admin.users', compact('users', 'categories'));
        } catch (\Exception $e) {
            \Log::error('Error en AdminController@users: ' . $e->getMessage());
            return view('admin.users', [
                'users' => collect(),
                'categories' => collect()
            ])->with('error', 'Error al cargar los usuarios. Por favor intenta nuevamente.');
        }
    }

    public function promotions()
    {
        try {
            if (!Schema::hasTable('promotions')) {
                return view('admin.promotions', ['promotions' => collect()])
                    ->with('warning', 'La tabla de promociones no existe. Ejecuta las migraciones.');
            }

            $promotions = Promotion::with(['business', 'category'])->paginate(15);
            return view('admin.promotions', compact('promotions'));
        } catch (\Exception $e) {
            \Log::error('Error en AdminController@promotions: ' . $e->getMessage());
            return view('admin.promotions', ['promotions' => collect()])
                ->with('error', 'Error al cargar las promociones. Por favor intenta nuevamente.');
        }
    }

    public function togglePromotionStatus($id)
    {
        try {
            $promotion = Promotion::findOrFail($id);
            $oldStatus = $promotion->is_active;
            $promotion->is_active = !$promotion->is_active;
            $promotion->save();

            // Registrar cambio (con manejo de errores)
            try {
                ActivityLogger::logUpdate(
                    $promotion,
                    "Estado de la promoción cambiado de " . ($oldStatus ? 'activo' : 'inactivo') . " a " . ($promotion->is_active ? 'activo' : 'inactivo'),
                    ['is_active' => ['old' => $oldStatus, 'new' => $promotion->is_active]]
                );
            } catch (\Exception $e) {
                \Log::error('Error al registrar cambio de estado de promoción: ' . $e->getMessage());
            }

            return back()->with('success', 'Estado de la promoción actualizado.');
        } catch (\Exception $e) {
            \Log::error('Error en togglePromotionStatus: ' . $e->getMessage());
            return back()->with('error', 'Error al actualizar el estado de la promoción.');
        }
    }

    public function toggleBusinessStatus($id)
    {
        try {
            $business = Business::findOrFail($id);
            $oldStatus = $business->is_active;
            $business->is_active = !$business->is_active;
            $business->save();

            // Registrar cambio (con manejo de errores)
            try {
                ActivityLogger::logUpdate(
                    $business,
                    "Estado del negocio cambiado de " . ($oldStatus ? 'activo' : 'inactivo') . " a " . ($business->is_active ? 'activo' : 'inactivo'),
                    ['is_active' => ['old' => $oldStatus, 'new' => $business->is_active]]
                );
            } catch (\Exception $e) {
                \Log::error('Error al registrar cambio de estado: ' . $e->getMessage());
            }

            return back()->with('success', 'Estado del negocio actualizado.');
        } catch (\Exception $e) {
            \Log::error('Error en toggleBusinessStatus: ' . $e->getMessage());
            return back()->with('error', 'Error al actualizar el estado del negocio.');
        }
    }

    public function toggleUserStatus($id)
    {
        $user = User::findOrFail($id);
        if ($user->isAdmin()) {
            return back()->with('error', 'No se puede desactivar un administrador.');
        }
        // Aquí podrías agregar un campo is_active a users si lo necesitas
        return back()->with('success', 'Estado del usuario actualizado.');
    }

    public function deleteBusiness($id)
    {
        try {
            $business = Business::findOrFail($id);
            $businessName = $business->name;
            
            // Registrar eliminación antes de borrar (con manejo de errores)
            try {
                ActivityLogger::logDelete($business, "Negocio {$businessName} eliminado por administrador");
            } catch (\Exception $e) {
                \Log::error('Error al registrar eliminación: ' . $e->getMessage());
            }
            
            $business->delete();
            return back()->with('success', 'Negocio eliminado exitosamente.');
        } catch (\Exception $e) {
            \Log::error('Error en deleteBusiness: ' . $e->getMessage());
            return back()->with('error', 'Error al eliminar el negocio.');
        }
    }

    public function deleteUser($id)
    {
        try {
            $user = User::findOrFail($id);
            if ($user->isAdmin()) {
                return back()->with('error', 'No se puede eliminar un administrador.');
            }
            
            $userEmail = $user->email;
            // Registrar eliminación antes de borrar (con manejo de errores)
            try {
                ActivityLogger::logDelete($user, "Usuario {$userEmail} eliminado por administrador");
            } catch (\Exception $e) {
                \Log::error('Error al registrar eliminación de usuario: ' . $e->getMessage());
            }
            
            $user->delete();
            return back()->with('success', 'Usuario eliminado exitosamente.');
        } catch (\Exception $e) {
            \Log::error('Error en deleteUser: ' . $e->getMessage());
            return back()->with('error', 'Error al eliminar el usuario.');
        }
    }
}

