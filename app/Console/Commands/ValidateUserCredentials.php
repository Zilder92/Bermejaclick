<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class ValidateUserCredentials extends Command
{
    protected $signature = 'users:validate-credentials';
    protected $description = 'Valida que todas las credenciales de usuarios funcionen correctamente';

    public function handle()
    {
        $this->info('🔍 Validando credenciales de usuarios...');
        $this->newLine();

        $users = User::all();
        $total = $users->count();
        $success = 0;
        $failed = 0;
        $errors = [];

        foreach ($users as $user) {
            $this->line("Probando: {$user->email} ({$user->name})");
            
            // Determinar contraseña según el tipo de usuario
            $password = $user->isAdmin() ? 'admin123' : 'password';
            
            // Verificar contraseña
            if (Hash::check($password, $user->password)) {
                $this->info("  ✅ Contraseña válida");
                $success++;
            } else {
                $this->error("  ❌ Contraseña inválida");
                $errors[] = [
                    'user' => $user->email,
                    'issue' => 'Contraseña no coincide',
                ];
                $failed++;
            }

            // Verificar relación con negocio (si es usuario de negocio)
            if ($user->isBusiness() && !$user->business) {
                $this->warn("  ⚠️  Usuario sin negocio asociado");
                $errors[] = [
                    'user' => $user->email,
                    'issue' => 'Sin negocio asociado',
                ];
            }

            // Verificar email único
            $duplicate = User::where('email', $user->email)->count();
            if ($duplicate > 1) {
                $this->warn("  ⚠️  Email duplicado");
                $errors[] = [
                    'user' => $user->email,
                    'issue' => 'Email duplicado',
                ];
            }
        }

        $this->newLine();
        $this->info("📊 Resumen:");
        $this->line("Total usuarios: {$total}");
        $this->info("✅ Exitosos: {$success}");
        if ($failed > 0) {
            $this->error("❌ Fallidos: {$failed}");
        }

        if (!empty($errors)) {
            $this->newLine();
            $this->error("⚠️  Errores encontrados:");
            foreach ($errors as $error) {
                $this->line("  - {$error['user']}: {$error['issue']}");
            }
        }

        return $failed === 0 ? 0 : 1;
    }
}

