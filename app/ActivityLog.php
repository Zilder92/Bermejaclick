<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'action',
        'description',
        'model_type',
        'model_id',
        'status',
        'ip_address',
        'user_agent',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Relación con el usuario
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Obtener el modelo relacionado
     */
    public function model()
    {
        return $this->morphTo();
    }

    /**
     * Scope para filtrar por acción
     */
    public function scopeAction($query, $action)
    {
        return $query->where('action', $action);
    }

    /**
     * Scope para filtrar por estado
     */
    public function scopeStatus($query, $status)
    {
        return $query->where('status', $status);
    }

    /**
     * Scope para logins
     */
    public function scopeLogins($query)
    {
        return $query->whereIn('action', ['login', 'logout', 'login_failed']);
    }

    /**
     * Scope para errores
     */
    public function scopeErrors($query)
    {
        return $query->where('status', 'failed');
    }

    /**
     * Obtener el nombre del usuario o email
     */
    public function getUserNameAttribute()
    {
        if ($this->user) {
            return $this->user->name . ' (' . $this->user->email . ')';
        }
        
        // Si no hay usuario pero hay metadata con email (login fallido)
        if ($this->metadata && isset($this->metadata['email'])) {
            return $this->metadata['email'];
        }
        
        return 'Usuario no identificado';
    }
}
