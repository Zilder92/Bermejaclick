<?php

namespace App\Helpers;

use App\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    /**
     * Registrar una actividad
     */
    public static function log($action, $description = null, $model = null, $modelId = null, $status = 'success', $ipAddress = null, $userAgent = null)
    {
        $userId = Auth::check() ? Auth::id() : null;
        $ipAddress = $ipAddress ?? request()->ip();
        $userAgent = $userAgent ?? request()->userAgent();

        return ActivityLog::create([
            'user_id' => $userId,
            'action' => $action,
            'description' => $description ?? $action,
            'model_type' => $model ? get_class($model) : null,
            'model_id' => $modelId ?? ($model ? $model->id : null),
            'status' => $status,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent,
            'metadata' => $model ? json_encode($model->toArray()) : null,
        ]);
    }

    /**
     * Registrar login exitoso
     */
    public static function logLogin($user, $ipAddress = null, $userAgent = null)
    {
        return self::log(
            'login',
            "Usuario {$user->email} inició sesión exitosamente",
            $user,
            $user->id,
            'success',
            $ipAddress,
            $userAgent
        );
    }

    /**
     * Registrar intento de login fallido
     */
    public static function logLoginFailed($email, $reason = 'Credenciales incorrectas', $ipAddress = null, $userAgent = null)
    {
        return ActivityLog::create([
            'user_id' => null,
            'action' => 'login_failed',
            'description' => "Intento de login fallido para {$email}: {$reason}",
            'model_type' => null,
            'model_id' => null,
            'status' => 'failed',
            'ip_address' => $ipAddress ?? request()->ip(),
            'user_agent' => $userAgent ?? request()->userAgent(),
            'metadata' => json_encode(['email' => $email, 'reason' => $reason]),
        ]);
    }

    /**
     * Registrar logout
     */
    public static function logLogout($user, $ipAddress = null, $userAgent = null)
    {
        return self::log(
            'logout',
            "Usuario {$user->email} cerró sesión",
            $user,
            $user->id,
            'success',
            $ipAddress,
            $userAgent
        );
    }

    /**
     * Registrar creación de modelo
     */
    public static function logCreate($model, $description = null)
    {
        $modelName = class_basename($model);
        return self::log(
            'create',
            $description ?? "Se creó {$modelName}",
            $model,
            $model->id,
            'success'
        );
    }

    /**
     * Registrar actualización de modelo
     */
    public static function logUpdate($model, $description = null, $changes = [])
    {
        $modelName = class_basename($model);
        $metadata = !empty($changes) ? json_encode(['changes' => $changes]) : null;
        
        $log = self::log(
            'update',
            $description ?? "Se actualizó {$modelName}",
            $model,
            $model->id,
            'success'
        );

        if ($metadata) {
            $log->metadata = $metadata;
            $log->save();
        }

        return $log;
    }

    /**
     * Registrar eliminación de modelo
     */
    public static function logDelete($model, $description = null)
    {
        $modelName = class_basename($model);
        return self::log(
            'delete',
            $description ?? "Se eliminó {$modelName}",
            $model,
            $model->id,
            'success'
        );
    }
}

