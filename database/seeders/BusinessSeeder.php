<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Category;
use App\Business;

class BusinessSeeder extends Seeder
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

        // COMIDA
        $businessesComida = [
            [
                'name' => 'Restaurante El Petrolero',
                'email' => 'elpetrolero@bermejaclick.com',
                'phone' => '+57 300 123 4567',
                'address' => 'Calle 50 # 20-30, Barrancabermeja',
                'description' => 'Restaurante especializado en comida típica de la región, con más de 10 años de experiencia. Ofrecemos los mejores platos tradicionales de Barrancabermeja.',
                'rating' => 4.5,
                'is_featured' => true,
            ],
            [
                'name' => 'Pizzería La Barranca',
                'email' => 'pizzerialabarranca@bermejaclick.com',
                'phone' => '+57 301 234 5678',
                'address' => 'Avenida del Río # 15-45',
                'description' => 'Las mejores pizzas artesanales de Barrancabermeja. Ingredientes frescos y masa hecha a mano.',
                'rating' => 4.3,
                'is_featured' => true,
            ],
            [
                'name' => 'Comida Rápida Express',
                'email' => 'expressbarranca@bermejaclick.com',
                'phone' => '+57 302 345 6789',
                'address' => 'Carrera 15 # 25-10',
                'description' => 'Comida rápida con los mejores combos familiares. Servicio rápido y delicioso.',
                'rating' => 4.0,
            ],
            [
                'name' => 'Asados del Río',
                'email' => 'asadosdelrio@bermejaclick.com',
                'phone' => '+57 303 456 7890',
                'address' => 'Vía al Puerto, Km 5',
                'description' => 'Especialistas en asados y parrillas. Ambiente familiar y los mejores cortes de carne.',
                'rating' => 4.7,
                'is_featured' => true,
            ],
            [
                'name' => 'Café del Centro',
                'email' => 'cafedelcentro@bermejaclick.com',
                'phone' => '+57 304 567 8901',
                'address' => 'Calle 48 # 18-25',
                'description' => 'Cafetería acogedora con el mejor café de la región. Pasteles y postres caseros.',
                'rating' => 4.2,
            ],
        ];

        foreach ($businessesComida as $business) {
            Business::firstOrCreate(
                ['email' => $business['email']],
                array_merge($business, [
                    'category_id' => $comida->id,
                    'social_media' => [
                        'facebook' => 'https://facebook.com/' . strtolower(str_replace(' ', '', $business['name'])),
                        'instagram' => '@' . strtolower(str_replace(' ', '', $business['name'])),
                    ],
                ])
            );
        }

        // HOTELES
        $businessesHoteles = [
            [
                'name' => 'Hotel Centro Barrancabermeja',
                'email' => 'hotelcentro@bermejaclick.com',
                'phone' => '+57 305 678 9012',
                'address' => 'Calle 50 # 20-15, Centro',
                'description' => 'Hotel céntrico con todas las comodidades. Ubicado en el corazón de Barrancabermeja.',
                'rating' => 4.4,
                'is_featured' => true,
            ],
            [
                'name' => 'Hotel Río Magdalena',
                'email' => 'hotelriomagdalena@bermejaclick.com',
                'phone' => '+57 306 789 0123',
                'address' => 'Avenida del Río # 25-50, Zona Norte',
                'description' => 'Hotel con vista al río Magdalena. Habitaciones cómodas y desayuno incluido.',
                'rating' => 4.6,
                'is_featured' => true,
            ],
            [
                'name' => 'Hostal Barranca',
                'email' => 'hostalbarranca@bermejaclick.com',
                'phone' => '+57 307 890 1234',
                'address' => 'Carrera 12 # 30-20, Zona Sur',
                'description' => 'Hostal económico y acogedor. Perfecto para viajeros que buscan comodidad a buen precio.',
                'rating' => 4.1,
            ],
        ];

        foreach ($businessesHoteles as $business) {
            Business::firstOrCreate(
                ['email' => $business['email']],
                array_merge($business, [
                    'category_id' => $hoteles->id,
                    'social_media' => [
                        'facebook' => 'https://facebook.com/' . strtolower(str_replace(' ', '', $business['name'])),
                    ],
                ])
            );
        }

        // TURISMO
        $businessesTurismo = [
            [
                'name' => 'Tours del Río Magdalena',
                'email' => 'toursriomagdalena@bermejaclick.com',
                'phone' => '+57 308 901 2345',
                'address' => 'Muelle Turístico, Puerto Barrancabermeja',
                'description' => 'Recorridos turísticos por el río Magdalena. Conoce los lugares más emblemáticos de la ciudad.',
                'rating' => 4.8,
                'is_featured' => true,
            ],
            [
                'name' => 'Aventuras Barranca',
                'email' => 'aventurasbarranca@bermejaclick.com',
                'phone' => '+57 309 012 3456',
                'address' => 'Carrera 20 # 35-10',
                'description' => 'Tours de aventura, ecoturismo y actividades al aire libre en Barrancabermeja.',
                'rating' => 4.5,
            ],
        ];

        foreach ($businessesTurismo as $business) {
            Business::firstOrCreate(
                ['email' => $business['email']],
                array_merge($business, [
                    'category_id' => $turismo->id,
                    'social_media' => [
                        'instagram' => '@' . strtolower(str_replace(' ', '', $business['name'])),
                    ],
                ])
            );
        }

        // ROPA
        $businessesRopa = [
            [
                'name' => 'Moda Barranca',
                'email' => 'modabarranca@bermejaclick.com',
                'phone' => '+57 310 123 4567',
                'address' => 'Centro Comercial Los Petroleros, Local 15',
                'description' => 'Tienda de ropa y moda con las últimas tendencias. Ropa casual y formal.',
                'rating' => 4.2,
            ],
            [
                'name' => 'Calzado Express',
                'email' => 'calzadoexpress@bermejaclick.com',
                'phone' => '+57 311 234 5678',
                'address' => 'Calle 45 # 22-18',
                'description' => 'Calzado para toda la familia. Calidad y comodidad garantizada.',
                'rating' => 4.0,
            ],
        ];

        foreach ($businessesRopa as $business) {
            Business::firstOrCreate(
                ['email' => $business['email']],
                array_merge($business, [
                    'category_id' => $ropa->id,
                ])
            );
        }

        // SERVICIOS
        $businessesServicios = [
            [
                'name' => 'Spa y Relajación Barranca',
                'email' => 'spabarranca@bermejaclick.com',
                'phone' => '+57 312 345 6789',
                'address' => 'Carrera 18 # 28-30',
                'description' => 'Spa completo con masajes, tratamientos faciales y corporales. Relájate y cuídate.',
                'rating' => 4.6,
                'is_featured' => true,
            ],
            [
                'name' => 'Salón de Belleza Estilo',
                'email' => 'estilobarranca@bermejaclick.com',
                'phone' => '+57 313 456 7890',
                'address' => 'Calle 52 # 24-12',
                'description' => 'Cortes, peinados, tintes y tratamientos de belleza. Profesionales expertos.',
                'rating' => 4.3,
            ],
        ];

        foreach ($businessesServicios as $business) {
            Business::firstOrCreate(
                ['email' => $business['email']],
                array_merge($business, [
                    'category_id' => $servicios->id,
                ])
            );
        }

        // TECNOLOGÍA
        $businessesTecnologia = [
            [
                'name' => 'Tech Store Barranca',
                'email' => 'techstore@bermejaclick.com',
                'phone' => '+57 314 567 8901',
                'address' => 'Centro Comercial Plaza, Local 25',
                'description' => 'Todo en tecnología: celulares, computadores, accesorios y más.',
                'rating' => 4.4,
            ],
        ];

        foreach ($businessesTecnologia as $business) {
            Business::firstOrCreate(
                ['email' => $business['email']],
                array_merge($business, [
                    'category_id' => $tecnologia->id,
                ])
            );
        }

        // SALUD
        $businessesSalud = [
            [
                'name' => 'Farmacia Central',
                'email' => 'farmaciacentral@bermejaclick.com',
                'phone' => '+57 315 678 9012',
                'address' => 'Calle 50 # 20-05',
                'description' => 'Farmacia con servicio 24 horas. Medicamentos y productos de salud.',
                'rating' => 4.5,
            ],
        ];

        foreach ($businessesSalud as $business) {
            Business::firstOrCreate(
                ['email' => $business['email']],
                array_merge($business, [
                    'category_id' => $salud->id,
                ])
            );
        }

        // SUPERMERCADOS
        $businessesSupermercados = [
            [
                'name' => 'Supermercado El Ahorro',
                'email' => 'elahorro@bermejaclick.com',
                'phone' => '+57 316 789 0123',
                'address' => 'Carrera 15 # 30-40',
                'description' => 'Supermercado con los mejores precios. Productos frescos y de calidad.',
                'rating' => 4.2,
            ],
        ];

        foreach ($businessesSupermercados as $business) {
            Business::firstOrCreate(
                ['email' => $business['email']],
                array_merge($business, [
                    'category_id' => $supermercados->id,
                ])
            );
        }

        $this->command->info('✅ Negocios creados exitosamente!');
    }
}
