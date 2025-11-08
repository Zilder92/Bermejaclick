<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Category;
use App\Business;
use App\Promotion;
use Carbon\Carbon;

class PromotionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener categorías
        $comida = Category::where('slug', 'comida')->first();
        $hoteles = Category::where('slug', 'hoteles')->first();
        $turismo = Category::where('slug', 'turismo')->first();
        $ropa = Category::where('slug', 'ropa')->first();
        $servicios = Category::where('slug', 'servicios')->first();
        $tecnologia = Category::where('slug', 'tecnologia')->first();
        $salud = Category::where('slug', 'salud')->first();
        $supermercados = Category::where('slug', 'supermercados')->first();

        $now = Carbon::now();

        // PROMOCIONES DE COMIDA
        $restaurantePetrolero = Business::where('name', 'Restaurante El Petrolero')->first();
        $pizzeria = Business::where('name', 'Pizzería La Barranca')->first();
        $express = Business::where('name', 'Comida Rápida Express')->first();
        $asados = Business::where('name', 'Asados del Río')->first();
        $cafe = Business::where('name', 'Café del Centro')->first();

        if ($restaurantePetrolero) {
            Promotion::firstOrCreate(
                [
                    'business_id' => $restaurantePetrolero->id,
                    'title' => '2x1 en Hamburguesas Premium',
                ],
                [
                'category_id' => $comida->id,
                'description' => 'Disfruta de nuestras hamburguesas artesanales con el mejor descuento. Incluye papas fritas y bebida.',
                'price_regular' => 25000,
                'price_discount' => 17500,
                'start_date' => $now->copy()->subDays(5),
                'end_date' => $now->copy()->addDays(25),
                'is_featured' => true,
                'is_active' => true,
                'views_count' => rand(100, 500),
                'clicks_count' => rand(20, 100),
                ]
            );

            Promotion::firstOrCreate(
                [
                    'business_id' => $restaurantePetrolero->id,
                    'title' => 'Menú Ejecutivo con 30% de Descuento',
                ],
                [
                'category_id' => $comida->id,
                'description' => 'Plato del día, sopa, postre y bebida. Perfecto para el almuerzo.',
                'price_regular' => 18000,
                'price_discount' => 12600,
                'start_date' => $now->copy()->subDays(2),
                'end_date' => $now->copy()->addDays(30),
                'is_active' => true,
                'views_count' => rand(50, 200),
                'clicks_count' => rand(10, 50),
                ]
            );
        }

        if ($pizzeria) {
            Promotion::firstOrCreate(
                [
                    'business_id' => $pizzeria->id,
                    'title' => 'Pizzas Grandes con 25% de Descuento',
                ],
                [
                'category_id' => $comida->id,
                'description' => 'Pizzas grandes artesanales con ingredientes frescos. Variedad de sabores disponibles.',
                'price_regular' => 28000,
                'price_discount' => 21000,
                'start_date' => $now->copy()->subDays(3),
                'end_date' => $now->copy()->addDays(27),
                'is_featured' => true,
                'is_active' => true,
                'views_count' => rand(150, 400),
                'clicks_count' => rand(30, 80),
                ]
            );
        }

        if ($express) {
            Promotion::firstOrCreate(
                [
                    'business_id' => $express->id,
                    'title' => 'Combo Familiar con 30% de Descuento',
                ],
                [
                'category_id' => $comida->id,
                'description' => 'Perfecto para compartir en familia. Incluye hamburguesas, papas, bebidas y postre.',
                'price_regular' => 45000,
                'price_discount' => 31500,
                'start_date' => $now->copy()->subDays(1),
                'end_date' => $now->copy()->addDays(29),
                'is_active' => true,
                'views_count' => rand(80, 250),
                'clicks_count' => rand(15, 60),
                ]
            );
        }

        if ($asados) {
            Promotion::firstOrCreate(
                [
                    'business_id' => $asados->id,
                    'title' => 'Combo Especial de Fin de Semana',
                ],
                [
                'business_id' => $asados->id,
                'category_id' => $comida->id,
                'title' => 'Combo Especial de Fin de Semana',
                'description' => 'Asado completo para 2 personas. Incluye carne, chorizo, arepa, yuca y ensalada.',
                'price_regular' => 45000,
                'price_discount' => 36000,
                'start_date' => $now->copy()->subDays(4),
                'end_date' => $now->copy()->addDays(26),
                'is_featured' => true,
                'is_active' => true,
                'views_count' => rand(120, 350),
                'clicks_count' => rand(25, 70),
            
                ]
            );
        }

        // PROMOCIONES DE HOTELES
        $hotelCentro = Business::where('name', 'Hotel Centro Barrancabermeja')->first();
        $hotelRio = Business::where('name', 'Hotel Río Magdalena')->first();
        $hostal = Business::where('name', 'Hostal Barranca')->first();

        if ($hotelCentro) {
            Promotion::firstOrCreate(
                [
                    'business_id' => $hotelCentro->id,
                    'title' => 'Noche de Hotel con Desayuno Incluido',
                ],
                [
                'business_id' => $hotelCentro->id,
                'category_id' => $hoteles->id,
                'title' => 'Noche de Hotel con Desayuno Incluido',
                'description' => 'Hospedaje cómodo en el corazón de Barrancabermeja. Desayuno buffet incluido.',
                'price_regular' => 120000,
                'price_discount' => 90000,
                'start_date' => $now->copy()->subDays(6),
                'end_date' => $now->copy()->addDays(24),
                'is_featured' => true,
                'is_active' => true,
                'views_count' => rand(200, 600),
                'clicks_count' => rand(40, 120),
            
                ]
            );
        }

        if ($hotelRio) {
            Promotion::firstOrCreate(
                [
                    'business_id' => $hotelRio->id,
                    'title' => 'Paquete Romántico - 2 Noches',
                ],
                [
                'business_id' => $hotelRio->id,
                'category_id' => $hoteles->id,
                'title' => 'Paquete Romántico - 2 Noches',
                'description' => 'Dos noches con vista al río Magdalena. Incluye desayuno, cena romántica y spa.',
                'price_regular' => 300000,
                'price_discount' => 240000,
                'start_date' => $now->copy()->subDays(7),
                'end_date' => $now->copy()->addDays(23),
                'is_active' => true,
                'views_count' => rand(150, 450),
                'clicks_count' => rand(30, 90),
            
                ]
            );
        }

        if ($hostal) {
            Promotion::firstOrCreate(
                [
                    'business_id' => $hostal->id,
                    'title' => 'Descuento 20% en Estancias de 3+ Noches',
                ],
                [
                'business_id' => $hostal->id,
                'category_id' => $hoteles->id,
                'title' => 'Descuento 20% en Estancias de 3+ Noches',
                'description' => 'Perfecto para viajeros. Descuento especial en estancias prolongadas.',
                'price_regular' => 50000,
                'price_discount' => 40000,
                'start_date' => $now->copy()->subDays(5),
                'end_date' => $now->copy()->addDays(25),
                'is_active' => true,
                'views_count' => rand(100, 300),
                'clicks_count' => rand(20, 70),
            
                ]
            );
        }

        // PROMOCIONES DE TURISMO
        $toursRio = Business::where('name', 'Tours del Río Magdalena')->first();
        $aventuras = Business::where('name', 'Aventuras Barranca')->first();

        if ($toursRio) {
            Promotion::firstOrCreate(
                [
                    'business_id' => $toursRio->id,
                    'title' => 'Tour por el Río Magdalena - 40% de Descuento',
                ],
                [
                'business_id' => $toursRio->id,
                'category_id' => $turismo->id,
                'title' => 'Tour por el Río Magdalena - 40% de Descuento',
                'description' => 'Recorrido completo por los puntos más emblemáticos de la ciudad. Incluye guía y refrigerio.',
                'price_regular' => 50000,
                'price_discount' => 30000,
                'start_date' => $now->copy()->subDays(8),
                'end_date' => $now->copy()->addDays(22),
                'is_featured' => true,
                'is_active' => true,
                'views_count' => rand(180, 500),
                'clicks_count' => rand(35, 100),
            
                ]
            );
        }

        if ($aventuras) {
            Promotion::firstOrCreate(
                [
                    'business_id' => $aventuras->id,
                    'title' => 'Paquete Ecoturismo - Día Completo',
                ],
                [
                'business_id' => $aventuras->id,
                'category_id' => $turismo->id,
                'title' => 'Paquete Ecoturismo - Día Completo',
                'description' => 'Tour de aventura por las ciénagas y humedales. Incluye almuerzo típico.',
                'price_regular' => 80000,
                'price_discount' => 60000,
                'start_date' => $now->copy()->subDays(4),
                'end_date' => $now->copy()->addDays(26),
                'is_active' => true,
                'views_count' => rand(90, 280),
                'clicks_count' => rand(18, 65),
            
                ]
            );
        }

        // PROMOCIONES DE ROPA
        $modaBarranca = Business::where('name', 'Moda Barranca')->first();
        $calzado = Business::where('name', 'Calzado Express')->first();

        if ($modaBarranca) {
            Promotion::firstOrCreate(
                [
                    'business_id' => $modaBarranca->id,
                    'title' => 'Ropa de Verano - Liquidación 20%',
                ],
                [
                'business_id' => $modaBarranca->id,
                'category_id' => $ropa->id,
                'title' => 'Ropa de Verano - Liquidación 20%',
                'description' => 'Las mejores prendas para el clima de Barrancabermeja. Variedad de tallas y estilos.',
                'price_regular' => 80000,
                'price_discount' => 64000,
                'start_date' => $now->copy()->subDays(3),
                'end_date' => $now->copy()->addDays(27),
                'is_active' => true,
                'views_count' => rand(70, 220),
                'clicks_count' => rand(15, 55),
            
                ]
            );
        }

        if ($calzado) {
            Promotion::firstOrCreate(
                [
                    'business_id' => $calzado->id,
                    'title' => '2x1 en Calzado Deportivo',
                ],
                [
                'business_id' => $calzado->id,
                'category_id' => $ropa->id,
                'title' => '2x1 en Calzado Deportivo',
                'description' => 'Calzado deportivo de calidad. Llévate dos pares al precio de uno.',
                'price_regular' => 120000,
                'price_discount' => 60000,
                'start_date' => $now->copy()->subDays(2),
                'end_date' => $now->copy()->addDays(28),
                'is_active' => true,
                'views_count' => rand(110, 320),
                'clicks_count' => rand(22, 75),
            
                ]
            );
        }

        // PROMOCIONES DE SERVICIOS
        $spa = Business::where('name', 'Spa y Relajación Barranca')->first();
        $salon = Business::where('name', 'Salón de Belleza Estilo')->first();

        if ($spa) {
            Promotion::firstOrCreate(
                [
                    'business_id' => $spa->id,
                    'title' => 'Servicio de Spa y Relajación - 50% de Descuento',
                ],
                [
                'business_id' => $spa->id,
                'category_id' => $servicios->id,
                'title' => 'Servicio de Spa y Relajación - 50% de Descuento',
                'description' => 'Momentos de bienestar y descanso. Incluye masaje, facial y acceso a jacuzzi.',
                'price_regular' => 100000,
                'price_discount' => 50000,
                'start_date' => $now->copy()->subDays(9),
                'end_date' => $now->copy()->addDays(21),
                'is_featured' => true,
                'is_active' => true,
                'views_count' => rand(160, 480),
                'clicks_count' => rand(32, 95),
            
                ]
            );
        }

        if ($salon) {
            Promotion::firstOrCreate(
                [
                    'business_id' => $salon->id,
                    'title' => 'Paquete de Belleza Completo',
                ],
                [
                'business_id' => $salon->id,
                'category_id' => $servicios->id,
                'title' => 'Paquete de Belleza Completo',
                'description' => 'Corte, peinado, tinte y tratamiento facial. Todo en un solo paquete.',
                'price_regular' => 85000,
                'price_discount' => 60000,
                'start_date' => $now->copy()->subDays(1),
                'end_date' => $now->copy()->addDays(29),
                'is_active' => true,
                'views_count' => rand(85, 260),
                'clicks_count' => rand(17, 62),
            
                ]
            );
        }

        // PROMOCIONES DE TECNOLOGÍA
        $techStore = Business::where('name', 'Tech Store Barranca')->first();

        if ($techStore) {
            Promotion::firstOrCreate(
                [
                    'business_id' => $techStore->id,
                    'title' => 'Smartphones con 15% de Descuento',
                ],
                [
                'business_id' => $techStore->id,
                'category_id' => $tecnologia->id,
                'title' => 'Smartphones con 15% de Descuento',
                'description' => 'Las mejores marcas de celulares. Modelos actuales con garantía oficial.',
                'price_regular' => 800000,
                'price_discount' => 680000,
                'start_date' => $now->copy()->subDays(6),
                'end_date' => $now->copy()->addDays(24),
                'is_active' => true,
                'views_count' => rand(200, 600),
                'clicks_count' => rand(40, 130),
            
                ]
            );
        }

        // PROMOCIONES DE SALUD
        $farmacia = Business::where('name', 'Farmacia Central')->first();

        if ($farmacia) {
            Promotion::firstOrCreate(
                [
                    'business_id' => $farmacia->id,
                    'title' => 'Descuento 10% en Medicamentos',
                ],
                [
                'business_id' => $farmacia->id,
                'category_id' => $salud->id,
                'title' => 'Descuento 10% en Medicamentos',
                'description' => 'Medicamentos y productos de farmacia con descuento especial. Válido para todos los productos.',
                'price_regular' => 50000,
                'price_discount' => 45000,
                'start_date' => $now->copy()->subDays(7),
                'end_date' => $now->copy()->addDays(23),
                'is_active' => true,
                'views_count' => rand(140, 420),
                'clicks_count' => rand(28, 85),
            
                ]
            );
        }

        // PROMOCIONES DE SUPERMERCADOS
        $supermercado = Business::where('name', 'Supermercado El Ahorro')->first();

        if ($supermercado) {
            Promotion::firstOrCreate(
                [
                    'business_id' => $supermercado->id,
                    'title' => 'Descuento 5% en Compras Mayores a $100.000',
                ],
                [
                'business_id' => $supermercado->id,
                'category_id' => $supermercados->id,
                'title' => 'Descuento 5% en Compras Mayores a $100.000',
                'description' => 'Ahorra en tu compra del mes. Descuento automático en caja.',
                'price_regular' => 100000,
                'price_discount' => 95000,
                'start_date' => $now->copy()->subDays(5),
                'end_date' => $now->copy()->addDays(25),
                'is_active' => true,
                'views_count' => rand(180, 550),
                'clicks_count' => rand(36, 110),
            
                ]
            );
        }
    }
}
