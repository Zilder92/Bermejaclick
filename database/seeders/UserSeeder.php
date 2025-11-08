<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\User;
use App\Business;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Obtener todos los negocios
        $businesses = Business::all();

        foreach ($businesses as $business) {
            // Crear usuario para cada negocio
            // Email del usuario será el mismo del negocio
            // Contraseña por defecto: password
            
            $user = User::firstOrCreate(
                ['email' => $business->email],
                [
                    'name' => $business->name,
                    'email' => $business->email,
                    'password' => Hash::make('password'), // Contraseña por defecto
                    'phone' => $business->phone,
                    'business_id' => $business->id,
                    'role' => 'business',
                    'email_verified_at' => now(),
                ]
            );

            // Si el usuario ya existía, actualizar la relación con el negocio
            if (!$user->wasRecentlyCreated) {
                $user->update([
                    'business_id' => $business->id,
                ]);
            }
        }

        // Crear un usuario administrador completo
        User::firstOrCreate(
            ['email' => 'admin@bermejaclick.com'],
            [
                'name' => 'Administrador BermejaClick',
                'email' => 'admin@bermejaclick.com',
                'password' => Hash::make('admin123'),
                'role' => 'admin',
                'email_verified_at' => now(),
            ]
        );

        $this->command->info('✅ Usuarios creados exitosamente!');
        $this->command->info('📧 Contraseña por defecto para comercios: password');
        $this->command->info('👤 Usuario admin: admin@bermejaclick.com / admin123');
        $this->command->info('📊 Total de usuarios creados: ' . User::count());
    }
}

