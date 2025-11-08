<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Comida',
                'slug' => 'comida',
                'icon' => 'fa-utensils',
                'description' => 'Restaurantes, comida rápida, cafeterías y establecimientos gastronómicos',
                'is_active' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Hoteles y Alojamiento',
                'slug' => 'hoteles',
                'icon' => 'fa-hotel',
                'description' => 'Hoteles, hostales, hospedajes y alojamientos turísticos',
                'is_active' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'Turismo y Entretenimiento',
                'slug' => 'turismo',
                'icon' => 'fa-map-marked-alt',
                'description' => 'Tours, actividades recreativas, parques y atracciones turísticas',
                'is_active' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Ropa y Moda',
                'slug' => 'ropa',
                'icon' => 'fa-tshirt',
                'description' => 'Tiendas de ropa, calzado, accesorios y moda',
                'is_active' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Servicios',
                'slug' => 'servicios',
                'icon' => 'fa-tools',
                'description' => 'Spa, belleza, reparaciones, servicios profesionales',
                'is_active' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Tecnología y Electrónica',
                'slug' => 'tecnologia',
                'icon' => 'fa-laptop',
                'description' => 'Tiendas de tecnología, electrónica, celulares y accesorios',
                'is_active' => true,
                'sort_order' => 6,
            ],
            [
                'name' => 'Salud y Farmacias',
                'slug' => 'salud',
                'icon' => 'fa-heartbeat',
                'description' => 'Farmacias, clínicas, laboratorios y servicios de salud',
                'is_active' => true,
                'sort_order' => 7,
            ],
            [
                'name' => 'Supermercados y Tiendas',
                'slug' => 'supermercados',
                'icon' => 'fa-shopping-cart',
                'description' => 'Supermercados, tiendas de conveniencia y abarrotes',
                'is_active' => true,
                'sort_order' => 8,
            ],
            [
                'name' => 'Transporte',
                'slug' => 'transporte',
                'icon' => 'fa-car',
                'description' => 'Alquiler de vehículos, taxis, transporte turístico',
                'is_active' => true,
                'sort_order' => 9,
            ],
            [
                'name' => 'Educación',
                'slug' => 'educacion',
                'icon' => 'fa-graduation-cap',
                'description' => 'Instituciones educativas, cursos y capacitaciones',
                'is_active' => true,
                'sort_order' => 10,
            ],
        ];

        foreach ($categories as $category) {
            Category::firstOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }

        $this->command->info('✅ Categorías creadas exitosamente!');
    }
}
