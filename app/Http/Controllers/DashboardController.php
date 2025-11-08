<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Promotion;
use App\Business;
use App\Category;
use App\Helpers\ActivityLogger;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $user = Auth::user();
            
            if (!$user) {
                return redirect()->route('login')->with('error', 'Por favor inicia sesión.');
            }
            
            // Si es administrador, redirigir al panel de admin
            if ($user->isAdmin()) {
                return redirect()->route('admin.dashboard');
            }

            $business = $user->business;

            if (!$business) {
                // Si no tiene negocio, mostrar dashboard vacío con mensaje
                return view('dashboard', [
                    'stats' => [
                        'active_promotions' => 0,
                        'total_promotions' => 0,
                        'total_views' => 0,
                        'total_clicks' => 0,
                        'views_today' => 0,
                        'views_this_week' => 0,
                        'views_this_month' => 0,
                        'total_revenue' => 0,
                    ],
                    'recentPromotions' => collect(),
                    'topPromotions' => collect(),
                    'viewsByDay' => [],
                    'business' => null,
                ])->with('warning', 'Por favor contacta al administrador para completar la información de tu comercio.');
            }

            // Verificar si la tabla de promociones existe
            $promotionsTableExists = \Schema::hasTable('promotions');

            // Estadísticas detalladas de visualizaciones
            if ($promotionsTableExists) {
                $stats = [
                    'active_promotions' => Promotion::where('business_id', $business->id)
                        ->where('is_active', true)
                        ->where('start_date', '<=', Carbon::now())
                        ->where('end_date', '>=', Carbon::now())
                        ->count(),
                    'total_promotions' => Promotion::where('business_id', $business->id)->count(),
                    'total_views' => Promotion::where('business_id', $business->id)->sum('views_count') ?? 0,
                    'total_clicks' => Promotion::where('business_id', $business->id)->sum('clicks_count') ?? 0,
                    'views_today' => Promotion::where('business_id', $business->id)
                        ->whereDate('updated_at', Carbon::today())
                        ->sum('views_count') ?? 0,
                    'views_this_week' => Promotion::where('business_id', $business->id)
                        ->where('updated_at', '>=', Carbon::now()->subWeek())
                        ->sum('views_count') ?? 0,
                    'views_this_month' => Promotion::where('business_id', $business->id)
                        ->where('updated_at', '>=', Carbon::now()->subMonth())
                        ->sum('views_count') ?? 0,
                    'total_revenue' => Promotion::where('business_id', $business->id)
                        ->where('is_active', true)
                        ->sum('price_discount') ?? 0,
                ];

                // Promociones con más visualizaciones
                $topPromotions = Promotion::where('business_id', $business->id)
                    ->orderBy('views_count', 'desc')
                    ->limit(5)
                    ->get();

                // Promociones recientes
                $recentPromotions = Promotion::where('business_id', $business->id)
                    ->orderBy('created_at', 'desc')
                    ->limit(5)
                    ->get();

                // Gráfico de visualizaciones por día (últimos 7 días)
                $viewsByDay = [];
                for ($i = 6; $i >= 0; $i--) {
                    $date = Carbon::now()->subDays($i)->format('Y-m-d');
                    $viewsByDay[$date] = Promotion::where('business_id', $business->id)
                        ->whereDate('updated_at', $date)
                        ->sum('views_count') ?? 0;
                }
            } else {
                // Si no existe la tabla, usar valores por defecto
                $stats = [
                    'active_promotions' => 0,
                    'total_promotions' => 0,
                    'total_views' => 0,
                    'total_clicks' => 0,
                    'views_today' => 0,
                    'views_this_week' => 0,
                    'views_this_month' => 0,
                    'total_revenue' => 0,
                ];
                $topPromotions = collect();
                $recentPromotions = collect();
                $viewsByDay = [];
            }

            // Obtener categorías para el formulario
            $categories = Category::where('is_active', true)->orderBy('sort_order')->get();

            return view('dashboard', compact('stats', 'recentPromotions', 'topPromotions', 'viewsByDay', 'business', 'categories'));
            
        } catch (\Exception $e) {
            \Log::error('Error en DashboardController: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            
            $categories = collect();
            
            return view('dashboard', [
                'stats' => [
                    'active_promotions' => 0,
                    'total_promotions' => 0,
                    'total_views' => 0,
                    'total_clicks' => 0,
                    'views_today' => 0,
                    'views_this_week' => 0,
                    'views_this_month' => 0,
                    'total_revenue' => 0,
                ],
                'recentPromotions' => collect(),
                'topPromotions' => collect(),
                'viewsByDay' => [],
                'business' => $user->business ?? null,
                'categories' => $categories,
            ])->with('error', 'Hubo un error al cargar el dashboard. Por favor intenta nuevamente.');
        }
    }

    public function storePromotion(Request $request)
    {
        try {
            $user = Auth::user();
            
            if (!$user || $user->isAdmin()) {
                return redirect()->route('dashboard')->with('error', 'No tienes permiso para realizar esta acción.');
            }

            $business = $user->business;
            
            if (!$business) {
                return redirect()->route('dashboard')->with('error', 'No tienes un negocio asociado. Contacta al administrador.');
            }

            // Validar datos
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'price_regular' => 'required|numeric|min:0',
                'price_discount' => 'required|numeric|min:0|lt:price_regular',
                'start_date' => [
                    'required',
                    'date',
                    function ($attribute, $value, $fail) {
                        $startDate = Carbon::parse($value)->startOfDay();
                        $today = Carbon::today();
                        
                        if ($startDate->lt($today)) {
                            $fail('La fecha de inicio no puede ser anterior a hoy (' . $today->format('d/m/Y') . ').');
                        }
                    },
                ],
                'end_date' => [
                    'required',
                    'date',
                    function ($attribute, $value, $fail) use ($request) {
                        $endDate = Carbon::parse($value)->startOfDay();
                        $startDate = $request->has('start_date') ? Carbon::parse($request->start_date)->startOfDay() : null;
                        
                        if ($startDate && $endDate->lte($startDate)) {
                            $fail('La fecha de fin debe ser posterior a la fecha de inicio.');
                        }
                    },
                ],
                'category_id' => 'required|exists:categories,id',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120', // 5MB máximo
            ], [
                'start_date.required' => 'La fecha de inicio es obligatoria.',
                'start_date.date' => 'La fecha de inicio debe ser una fecha válida.',
                'end_date.required' => 'La fecha de fin es obligatoria.',
                'end_date.date' => 'La fecha de fin debe ser una fecha válida.',
                'price_discount.lt' => 'El precio con descuento debe ser menor al precio regular.',
            ]);

            // Obtener la categoría
            $category = Category::findOrFail($validated['category_id']);

            // Guardar imagen
            $imagePath = null;
            if ($request->hasFile('image')) {
                try {
                    // Asegurar que el directorio existe
                    $directory = storage_path('app/public/promotions');
                    if (!is_dir($directory)) {
                        \File::makeDirectory($directory, 0755, true);
                    }
                    
                    $imagePath = $request->file('image')->store('promotions', 'public');
                } catch (\Exception $e) {
                    \Log::error('Error al guardar imagen: ' . $e->getMessage());
                    return redirect()->route('dashboard')
                        ->with('error', 'Error al subir la imagen: ' . $e->getMessage())
                        ->withInput();
                }
            }

            // Crear promoción
            $promotion = Promotion::create([
                'business_id' => $business->id,
                'category_id' => $category->id,
                'title' => $validated['title'],
                'description' => $validated['description'],
                'price_regular' => $validated['price_regular'],
                'price_discount' => $validated['price_discount'],
                'start_date' => $validated['start_date'],
                'end_date' => $validated['end_date'],
                'image' => $imagePath,
                'is_active' => true,
                'is_featured' => false,
            ]);

            // Registrar actividad
            try {
                ActivityLogger::logCreate(
                    $promotion,
                    "Nueva promoción creada: {$promotion->title}",
                    ['business_id' => $business->id, 'category' => $category->name]
                );
            } catch (\Exception $e) {
                \Log::error('Error al registrar actividad: ' . $e->getMessage());
            }

            return redirect()->route('dashboard')->with('success', '¡Promoción publicada exitosamente!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->route('dashboard')
                ->withErrors($e->errors())
                ->withInput()
                ->with('error', 'Por favor corrige los errores en el formulario.');
        } catch (\Exception $e) {
            \Log::error('Error al crear promoción: ' . $e->getMessage());
            \Log::error('Stack trace: ' . $e->getTraceAsString());
            \Log::error('Request data: ' . json_encode($request->all()));
            
            return redirect()->route('dashboard')
                ->with('error', 'Hubo un error al publicar la promoción: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function listPromotions()
    {
        try {
            $user = Auth::user();
            
            if (!$user || $user->isAdmin()) {
                return redirect()->route('dashboard')->with('error', 'No tienes permiso para ver esta página.');
            }

            $business = $user->business;
            
            if (!$business) {
                return redirect()->route('dashboard')->with('error', 'No tienes un negocio asociado.');
            }

            $promotions = Promotion::where('business_id', $business->id)
                ->with('category')
                ->orderBy('created_at', 'desc')
                ->paginate(15);

            return view('dashboard', [
                'promotions' => $promotions,
                'business' => $business,
            ]);

        } catch (\Exception $e) {
            \Log::error('Error al listar promociones: ' . $e->getMessage());
            return redirect()->route('dashboard')->with('error', 'Error al cargar las promociones.');
        }
    }
}
