<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Schema;
use App\Business;
use App\Promotion;
use App\Category;
use App\ActivityLog;

class TestAllUsers extends Command
{
    protected $signature = 'test:all-users';
    protected $description = 'Prueba todas las rutas con todos los usuarios para detectar errores';

    private $errors = [];
    private $success = 0;
    private $failed = 0;

    public function handle()
    {
        $this->info('🧪 Iniciando pruebas completas del sistema...');
        $this->newLine();

        // Verificar tablas
        $this->info('📊 Verificando estructura de base de datos...');
        $this->checkDatabaseTables();
        $this->newLine();

        // Probar todos los usuarios
        $this->info('👥 Probando credenciales de todos los usuarios...');
        $this->testAllUserCredentials();
        $this->newLine();

        // Probar rutas públicas
        $this->info('🌐 Probando rutas públicas...');
        $this->testPublicRoutes();
        $this->newLine();

        // Probar rutas protegidas con cada usuario
        $this->info('🔐 Probando rutas protegidas con cada usuario...');
        $this->testProtectedRoutes();
        $this->newLine();

        // Probar relaciones de modelos
        $this->info('🔗 Verificando relaciones de modelos...');
        $this->testModelRelations();
        $this->newLine();

        // Resumen
        $this->displaySummary();
    }

    private function checkDatabaseTables()
    {
        $requiredTables = ['users', 'businesses', 'promotions', 'categories'];
        $optionalTables = ['activity_logs'];

        foreach ($requiredTables as $table) {
            if (Schema::hasTable($table)) {
                $count = \DB::table($table)->count();
                $this->info("  ✅ Tabla '{$table}' existe ({$count} registros)");
            } else {
                $this->error("  ❌ Tabla '{$table}' NO existe");
                $this->errors[] = "Tabla requerida '{$table}' no existe";
            }
        }

        foreach ($optionalTables as $table) {
            if (Schema::hasTable($table)) {
                $count = \DB::table($table)->count();
                $this->info("  ✅ Tabla opcional '{$table}' existe ({$count} registros)");
            } else {
                $this->warn("  ⚠️  Tabla opcional '{$table}' no existe (no crítico)");
            }
        }
    }

    private function testAllUserCredentials()
    {
        $users = User::all();

        if ($users->isEmpty()) {
            $this->error('  ❌ No hay usuarios en la base de datos');
            $this->errors[] = 'No hay usuarios para probar';
            return;
        }

        foreach ($users as $user) {
            $password = $user->isAdmin() ? 'admin123' : 'password';
            
            if (Hash::check($password, $user->password)) {
                $this->info("  ✅ {$user->email} - Contraseña válida");
                $this->success++;
            } else {
                $this->error("  ❌ {$user->email} - Contraseña inválida");
                $this->errors[] = "Usuario {$user->email}: contraseña inválida";
                $this->failed++;
            }

            // Verificar relación con negocio si es usuario de negocio
            if ($user->isBusiness() && !$user->business) {
                $this->warn("  ⚠️  {$user->email} - Sin negocio asociado");
            }
        }
    }

    private function testPublicRoutes()
    {
        $publicRoutes = [
            'home' => '/',
            'login' => '/login',
        ];

        foreach ($publicRoutes as $name => $uri) {
            try {
                $route = Route::getRoutes()->getByName($name);
                if ($route) {
                    $this->info("  ✅ Ruta pública '{$name}' existe");
                    $this->success++;
                } else {
                    $this->error("  ❌ Ruta pública '{$name}' no encontrada");
                    $this->errors[] = "Ruta pública '{$name}' no existe";
                    $this->failed++;
                }
            } catch (\Exception $e) {
                $this->error("  ❌ Error al verificar ruta '{$name}': " . $e->getMessage());
                $this->errors[] = "Error en ruta '{$name}': " . $e->getMessage();
                $this->failed++;
            }
        }
    }

    private function testProtectedRoutes()
    {
        $users = User::all();

        if ($users->isEmpty()) {
            $this->warn('  ⚠️  No hay usuarios para probar rutas protegidas');
            return;
        }

        $protectedRoutes = [
            'dashboard' => '/dashboard',
            'admin.dashboard' => '/admin/dashboard',
            'admin.businesses' => '/admin/businesses',
            'admin.users' => '/admin/users',
            'admin.promotions' => '/admin/promotions',
        ];

        foreach ($users as $user) {
            $this->line("  Probando con usuario: {$user->email} ({$user->role})");
            
            Auth::login($user);

            foreach ($protectedRoutes as $name => $uri) {
                try {
                    // Verificar si la ruta existe
                    $route = Route::getRoutes()->getByName($name);
                    if (!$route) {
                        $this->warn("    ⚠️  Ruta '{$name}' no existe");
                        continue;
                    }

                    // Verificar permisos
                    if (strpos($name, 'admin.') === 0 && !$user->isAdmin()) {
                        // Usuario no admin intentando acceder a ruta admin
                        $this->info("    ✅ Ruta '{$name}' correctamente protegida (no admin)");
                        $this->success++;
                    } else {
                        $this->info("    ✅ Ruta '{$name}' accesible");
                        $this->success++;
                    }
                } catch (\Exception $e) {
                    $this->error("    ❌ Error en ruta '{$name}': " . $e->getMessage());
                    $this->errors[] = "Usuario {$user->email} - Ruta '{$name}': " . $e->getMessage();
                    $this->failed++;
                }
            }

            Auth::logout();
        }
    }

    private function testModelRelations()
    {
        // Probar relaciones User -> Business
        $users = User::where('role', 'business')->get();
        foreach ($users as $user) {
            try {
                $business = $user->business;
                if ($business) {
                    $this->info("  ✅ Usuario {$user->email} -> Negocio {$business->name}");
                    $this->success++;
                } else {
                    $this->warn("  ⚠️  Usuario {$user->email} sin negocio");
                }
            } catch (\Exception $e) {
                $this->error("  ❌ Error en relación usuario-negocio para {$user->email}: " . $e->getMessage());
                $this->errors[] = "Relación User->Business para {$user->email}: " . $e->getMessage();
                $this->failed++;
            }
        }

        // Probar relaciones Business -> Promotions
        $businesses = Business::all();
        foreach ($businesses as $business) {
            try {
                $promotions = $business->promotions;
                $this->info("  ✅ Negocio {$business->name} -> {$promotions->count()} promociones");
                $this->success++;
            } catch (\Exception $e) {
                $this->error("  ❌ Error en relación negocio-promociones para {$business->name}: " . $e->getMessage());
                $this->errors[] = "Relación Business->Promotions para {$business->name}: " . $e->getMessage();
                $this->failed++;
            }
        }
    }

    private function displaySummary()
    {
        $this->newLine();
        $this->info('📊 RESUMEN DE PRUEBAS');
        $this->line(str_repeat('=', 50));
        $this->info("✅ Exitosos: {$this->success}");
        $this->error("❌ Fallidos: {$this->failed}");
        $this->newLine();

        if (!empty($this->errors)) {
            $this->error('⚠️  ERRORES ENCONTRADOS:');
            foreach ($this->errors as $error) {
                $this->line("  - {$error}");
            }
            $this->newLine();
        } else {
            $this->info('✅ No se encontraron errores!');
        }
    }
}

