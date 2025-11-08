<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use App\Category;
use App\Promotion;
use App\Business;
use App\Influencer;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function index()
    {
        try {
            // Verificar si las tablas existen
            $categories = collect();
            $featuredPromotions = collect();
            $foodPromotions = collect();
            $hotelPromotions = collect();
            $tourismPlaces = collect();

            if (\Schema::hasTable('categories')) {
                $categories = Category::where('is_active', true)
                    ->orderBy('sort_order')
                    ->get();
            }

            if (\Schema::hasTable('promotions')) {
                $featuredPromotions = Promotion::where('is_active', true)
                    ->where('is_featured', true)
                    ->where('start_date', '<=', Carbon::now())
                    ->where('end_date', '>=', Carbon::now())
                    ->with(['business', 'category'])
                    ->orderBy('views_count', 'desc')
                    ->limit(6)
                    ->get();

                // Incrementar visualizaciones de promociones destacadas
                foreach ($featuredPromotions as $promo) {
                    $promo->increment('views_count');
                }

                $allPromotions = Promotion::where('is_active', true)
                    ->where('start_date', '<=', Carbon::now())
                    ->where('end_date', '>=', Carbon::now())
                    ->with(['business', 'category'])
                    ->orderBy('created_at', 'desc')
                    ->get();

                // Promociones por categoría
                $foodPromotions = $allPromotions->where('category.slug', 'comida')->take(4);
                
                // Incrementar visualizaciones de promociones de comida
                foreach ($foodPromotions as $promo) {
                    $promo->increment('views_count');
                }
            }

            if (\Schema::hasTable('businesses')) {
                $hotelPromotions = Business::whereHas('category', function($q) {
                    $q->where('slug', 'hoteles');
                })->where('is_active', true)->where('is_featured', true)->limit(3)->get();
                
                $tourismPlaces = Business::whereHas('category', function($q) {
                    $q->where('slug', 'turismo');
                })->where('is_active', true)->limit(4)->get();
                
                // Negocios destacados para la sección de perfiles
                $featuredBusinesses = Business::where('is_active', true)
                    ->where('is_featured', true)
                    ->with('category')
                    ->orderBy('views_count', 'desc')
                    ->limit(8)
                    ->get();
            } else {
                $featuredBusinesses = collect();
            }

            if (\Schema::hasTable('influencers')) {
                $influencers = Influencer::where('is_active', true)
                    ->where('is_featured', true)
                    ->orderByRaw('(instagram_followers + tiktok_followers + youtube_subscribers) DESC')
                    ->limit(6)
                    ->get();
            }
        } catch (\Exception $e) {
            // Si hay error de BD, usar colecciones vacías
            $categories = collect();
            $featuredPromotions = collect();
            $foodPromotions = collect();
            $hotelPromotions = collect();
            $tourismPlaces = collect();
            $influencers = collect();
        }

        return view('home', compact(
            'categories',
            'featuredPromotions',
            'foodPromotions',
            'hotelPromotions',
            'tourismPlaces',
            'influencers'
        ));
    }

    public function businesses(Request $request)
    {
        try {
            $categories = collect();
            $businesses = collect();

            if (\Schema::hasTable('categories')) {
                $categories = Category::where('is_active', true)
                    ->orderBy('sort_order')
                    ->get();
            }

            if (\Schema::hasTable('businesses')) {
                $query = Business::where('is_active', true)
                    ->with(['category', 'promotions' => function($q) {
                        $q->where('is_active', true)
                          ->where('start_date', '<=', Carbon::now())
                          ->where('end_date', '>=', Carbon::now())
                          ->orderBy('created_at', 'desc');
                    }]);

                // Filtro por categoría
                if ($request->has('categoria') && $request->categoria) {
                    $query->whereHas('category', function($q) use ($request) {
                        $q->where('slug', $request->categoria);
                    });
                }

                // Búsqueda por nombre
                if ($request->has('buscar') && $request->buscar) {
                    $query->where('name', 'like', '%' . $request->buscar . '%');
                }

                $businesses = $query->orderBy('views_count', 'desc')
                    ->paginate(12);
            }

        } catch (\Exception $e) {
            \Log::error('Error en businesses: ' . $e->getMessage());
            $categories = collect();
            $businesses = collect();
        }

        // Calcular estadísticas para el hero
        $totalBusinesses = 0;
        $totalCategories = $categories->count() ?? 0;
        $totalPromotions = 0;

        if (\Schema::hasTable('businesses')) {
            $totalBusinesses = Business::where('is_active', true)->count();
        }

        if (\Schema::hasTable('promotions')) {
            $totalPromotions = Promotion::where('is_active', true)
                ->where('start_date', '<=', Carbon::now())
                ->where('end_date', '>=', Carbon::now())
                ->count();
        }

        return view('businesses', compact('businesses', 'categories', 'totalBusinesses', 'totalCategories', 'totalPromotions'));
    }

    public function businessDetail($slug)
    {
        try {
            $business = null;
            $activePromotions = collect();

            if (\Schema::hasTable('businesses')) {
                $business = Business::where('slug', $slug)
                    ->where('is_active', true)
                    ->with('category')
                    ->firstOrFail();

                // Incrementar contador de visualizaciones
                $business->increment('views_count');

                // Obtener promociones activas
                if (\Schema::hasTable('promotions')) {
                    $activePromotions = Promotion::where('business_id', $business->id)
                        ->where('is_active', true)
                        ->where('start_date', '<=', Carbon::now())
                        ->where('end_date', '>=', Carbon::now())
                        ->with('category')
                        ->orderBy('created_at', 'desc')
                        ->get();

                    // Incrementar visualizaciones de promociones
                    foreach ($activePromotions as $promo) {
                        $promo->increment('views_count');
                    }
                }
            }

            if (!$business) {
                abort(404, 'Comercio no encontrado');
            }

        } catch (\Exception $e) {
            \Log::error('Error en businessDetail: ' . $e->getMessage());
            abort(404, 'Comercio no encontrado');
        }

        return view('business-detail', compact('business', 'activePromotions'));
    }
}
