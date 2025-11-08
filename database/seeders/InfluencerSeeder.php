<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Influencer;
use Illuminate\Support\Str;

class InfluencerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $influencers = [
            [
                'name' => 'María González',
                'nickname' => '@mariabarranca',
                'bio' => 'Influencer de comida y gastronomía local. Descubre los mejores sabores de Barrancabermeja.',
                'specialty' => 'Comida',
                'instagram_followers' => 12500,
                'tiktok_followers' => 8500,
                'youtube_subscribers' => 3200,
                'social_media' => [
                    'instagram' => 'https://instagram.com/mariabarranca',
                    'tiktok' => 'https://tiktok.com/@mariabarranca',
                    'youtube' => 'https://youtube.com/@mariabarranca',
                ],
                'email' => 'maria@bermejaclick.com',
                'location' => 'Barrancabermeja',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Carlos Ramírez',
                'nickname' => '@carlosbarranca_travel',
                'bio' => 'Explorador de los rincones más hermosos de Barrancabermeja. Turismo y aventura local.',
                'specialty' => 'Turismo',
                'instagram_followers' => 18900,
                'tiktok_followers' => 12000,
                'youtube_subscribers' => 5600,
                'social_media' => [
                    'instagram' => 'https://instagram.com/carlosbarranca_travel',
                    'tiktok' => 'https://tiktok.com/@carlosbarranca_travel',
                    'youtube' => 'https://youtube.com/@carlosbarranca_travel',
                ],
                'email' => 'carlos@bermejaclick.com',
                'location' => 'Barrancabermeja',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Ana Martínez',
                'nickname' => '@anabarranca_style',
                'bio' => 'Fashionista local. Moda, estilo y tendencias desde el corazón del Magdalena Medio.',
                'specialty' => 'Moda',
                'instagram_followers' => 9800,
                'tiktok_followers' => 15200,
                'youtube_subscribers' => 2100,
                'social_media' => [
                    'instagram' => 'https://instagram.com/anabarranca_style',
                    'tiktok' => 'https://tiktok.com/@anabarranca_style',
                    'youtube' => 'https://youtube.com/@anabarranca_style',
                ],
                'email' => 'ana@bermejaclick.com',
                'location' => 'Barrancabermeja',
                'is_featured' => true,
                'is_active' => true,
            ],
            [
                'name' => 'Luis Hernández',
                'nickname' => '@luisbarranca_life',
                'bio' => 'Lifestyle y cultura barranqueña. Viviendo y compartiendo lo mejor de nuestra ciudad.',
                'specialty' => 'Lifestyle',
                'instagram_followers' => 11200,
                'tiktok_followers' => 9800,
                'youtube_subscribers' => 3400,
                'social_media' => [
                    'instagram' => 'https://instagram.com/luisbarranca_life',
                    'tiktok' => 'https://tiktok.com/@luisbarranca_life',
                    'youtube' => 'https://youtube.com/@luisbarranca_life',
                ],
                'email' => 'luis@bermejaclick.com',
                'location' => 'Barrancabermeja',
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'name' => 'Sofía Rodríguez',
                'nickname' => '@sofiabarranca_fit',
                'bio' => 'Fitness y bienestar en Barrancabermeja. Motivación y salud para todos.',
                'specialty' => 'Fitness',
                'instagram_followers' => 7600,
                'tiktok_followers' => 11200,
                'youtube_subscribers' => 1800,
                'social_media' => [
                    'instagram' => 'https://instagram.com/sofiabarranca_fit',
                    'tiktok' => 'https://tiktok.com/@sofiabarranca_fit',
                    'youtube' => 'https://youtube.com/@sofiabarranca_fit',
                ],
                'email' => 'sofia@bermejaclick.com',
                'location' => 'Barrancabermeja',
                'is_featured' => false,
                'is_active' => true,
            ],
            [
                'name' => 'Diego Morales',
                'nickname' => '@diegobarranca_tech',
                'bio' => 'Tecnología y emprendimiento local. Innovación desde Barrancabermeja.',
                'specialty' => 'Tecnología',
                'instagram_followers' => 6400,
                'tiktok_followers' => 4200,
                'youtube_subscribers' => 2900,
                'social_media' => [
                    'instagram' => 'https://instagram.com/diegobarranca_tech',
                    'tiktok' => 'https://tiktok.com/@diegobarranca_tech',
                    'youtube' => 'https://youtube.com/@diegobarranca_tech',
                ],
                'email' => 'diego@bermejaclick.com',
                'location' => 'Barrancabermeja',
                'is_featured' => false,
                'is_active' => true,
            ],
        ];

        foreach ($influencers as $influencerData) {
            Influencer::firstOrCreate(
                ['slug' => Str::slug($influencerData['name'])],
                $influencerData
            );
        }

        $this->command->info('✅ Influencers barranqueños creados exitosamente!');
    }
}
