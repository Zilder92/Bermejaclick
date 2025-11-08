<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use App\Business;

class ListUsers extends Command
{
    protected $signature = 'users:list';
    protected $description = 'Lista todos los usuarios con sus credenciales';

    public function handle()
    {
        $this->info('📋 LISTA DE USUARIOS');
        $this->info('═══════════════════════════════════════════════════════════');
        
        $users = User::with('business')->get();
        
        $this->table(
            ['ID', 'Nombre', 'Email', 'Rol', 'Negocio', 'Contraseña'],
            $users->map(function ($user) {
                $password = $user->role === 'admin' ? 'admin123' : 'password';
                $businessName = $user->business ? $user->business->name : 'N/A';
                
                return [
                    $user->id,
                    $user->name,
                    $user->email,
                    $user->role,
                    $businessName,
                    $password,
                ];
            })->toArray()
        );
        
        $this->info('');
        $this->info('📊 Total de usuarios: ' . $users->count());
        $this->info('👤 Administradores: ' . $users->where('role', 'admin')->count());
        $this->info('🏢 Comercios: ' . $users->where('role', 'business')->count());
        $this->info('');
        $this->info('🔑 Credenciales:');
        $this->info('   - Admin: admin@bermejaclick.com / admin123');
        $this->info('   - Comercios: [email del negocio] / password');
        
        return Command::SUCCESS;
    }
}
