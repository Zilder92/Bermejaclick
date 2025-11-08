<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración - BermejaClick.com</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .admin-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 2rem;
        }
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }
        .stat-card {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .stat-card h3 {
            font-size: 0.9rem;
            color: #6c757d;
            margin-bottom: 0.5rem;
        }
        .stat-card .value {
            font-size: 2rem;
            font-weight: 700;
            color: #8B4513;
        }
        .logs-section {
            background: white;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        .logs-section h2 {
            font-size: 1.5rem;
            margin-bottom: 1rem;
            color: #8B4513;
        }
        .logs-table {
            width: 100%;
            border-collapse: collapse;
        }
        .logs-table th,
        .logs-table td {
            padding: 0.75rem;
            text-align: left;
            border-bottom: 1px solid #e9ecef;
        }
        .logs-table th {
            background: #f8f9fa;
            font-weight: 600;
            color: #495057;
        }
        .logs-table tr:hover {
            background: #f8f9fa;
        }
        .badge {
            display: inline-block;
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 600;
        }
        .badge-success {
            background: #d4edda;
            color: #155724;
        }
        .badge-danger {
            background: #f8d7da;
            color: #721c24;
        }
        .badge-warning {
            background: #fff3cd;
            color: #856404;
        }
        .badge-info {
            background: #d1ecf1;
            color: #0c5460;
        }
        .action-login { color: #28a745; }
        .action-logout { color: #6c757d; }
        .action-login_failed { color: #dc3545; }
        .action-update { color: #ffc107; }
        .action-create { color: #17a2b8; }
        .action-delete { color: #dc3545; }
        .header-admin {
            background: linear-gradient(135deg, #8B4513 0%, #1E90FF 100%);
            color: white;
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
        }
        .header-admin h1 {
            margin: 0;
            font-size: 2rem;
        }
        .tabs {
            display: flex;
            gap: 1rem;
            margin-bottom: 1.5rem;
            border-bottom: 2px solid #e9ecef;
        }
        .tab {
            padding: 0.75rem 1.5rem;
            cursor: pointer;
            border: none;
            background: none;
            font-weight: 600;
            color: #6c757d;
            border-bottom: 3px solid transparent;
            transition: all 0.3s;
        }
        .tab.active {
            color: #8B4513;
            border-bottom-color: #8B4513;
        }
        .tab-content {
            display: none;
        }
        .tab-content.active {
            display: block;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="header-admin">
            <h1><i class="fas fa-shield-alt"></i> Panel de Administración</h1>
            <p>Gestión completa de la plataforma BermejaClick.com</p>
        </div>

        <!-- Estadísticas de Actividad -->
        <div class="stats-grid">
            <div class="stat-card">
                <h3>Logins Hoy</h3>
                <div class="value">{{ $activityStats['logins_today'] }}</div>
            </div>
            <div class="stat-card">
                <h3>Logins Esta Semana</h3>
                <div class="value">{{ $activityStats['logins_this_week'] }}</div>
            </div>
            <div class="stat-card">
                <h3>Logins Fallidos Hoy</h3>
                <div class="value text-danger">{{ $activityStats['failed_logins_today'] }}</div>
            </div>
            <div class="stat-card">
                <h3>Actividades Hoy</h3>
                <div class="value">{{ $activityStats['total_activities_today'] }}</div>
            </div>
        </div>

        <!-- Tabs para diferentes tipos de logs -->
        <div class="tabs">
            <button class="tab active" onclick="showTab('all')">Todas las Actividades</button>
            <button class="tab" onclick="showTab('logins')">Logins</button>
            <button class="tab" onclick="showTab('errors')">Errores</button>
        </div>

        <!-- Tab: Todas las Actividades -->
        <div id="tab-all" class="tab-content active">
            <div class="logs-section">
                <h2><i class="fas fa-list"></i> Registro de Actividades</h2>
                <div style="overflow-x: auto;">
                    <table class="logs-table">
                        <thead>
                            <tr>
                                <th>Fecha y Hora</th>
                                <th>Usuario</th>
                                <th>Acción</th>
                                <th>Descripción</th>
                                <th>Estado</th>
                                <th>IP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($activityLogs as $log)
                                <tr>
                                    <td>{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                                    <td>
                                        @if($log->user)
                                            {{ $log->user->name }}<br>
                                            <small style="color: #6c757d;">{{ $log->user->email }}</small>
                                        @else
                                            <span style="color: #6c757d;">
                                                @if($log->metadata && isset($log->metadata['email']))
                                                    {{ $log->metadata['email'] }}
                                                @else
                                                    No identificado
                                                @endif
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="action-{{ $log->action }}">
                                            <i class="fas fa-{{ $log->action === 'login' ? 'sign-in-alt' : ($log->action === 'logout' ? 'sign-out-alt' : ($log->action === 'login_failed' ? 'exclamation-triangle' : ($log->action === 'update' ? 'edit' : ($log->action === 'create' ? 'plus' : 'trash')))) }}"></i>
                                            {{ ucfirst(str_replace('_', ' ', $log->action)) }}
                                        </span>
                                    </td>
                                    <td>{{ $log->description }}</td>
                                    <td>
                                        @if($log->status === 'success')
                                            <span class="badge badge-success">Éxito</span>
                                        @elseif($log->status === 'failed')
                                            <span class="badge badge-danger">Fallido</span>
                                        @else
                                            <span class="badge badge-warning">Advertencia</span>
                                        @endif
                                    </td>
                                    <td><small>{{ $log->ip_address }}</small></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align: center; padding: 2rem; color: #6c757d;">
                                        No hay actividades registradas aún
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tab: Logins -->
        <div id="tab-logins" class="tab-content">
            <div class="logs-section">
                <h2><i class="fas fa-sign-in-alt"></i> Registro de Logins</h2>
                <div style="overflow-x: auto;">
                    <table class="logs-table">
                        <thead>
                            <tr>
                                <th>Fecha y Hora</th>
                                <th>Usuario</th>
                                <th>Tipo</th>
                                <th>Estado</th>
                                <th>IP</th>
                                <th>Navegador</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($loginLogs as $log)
                                <tr>
                                    <td>{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                                    <td>
                                        @if($log->user)
                                            <strong>{{ $log->user->name }}</strong><br>
                                            <small style="color: #6c757d;">{{ $log->user->email }}</small>
                                        @else
                                            <span style="color: #6c757d;">
                                                @if($log->metadata && isset($log->metadata['email']))
                                                    {{ $log->metadata['email'] }}
                                                @else
                                                    No identificado
                                                @endif
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($log->action === 'login')
                                            <span class="action-login"><i class="fas fa-sign-in-alt"></i> Login</span>
                                        @elseif($log->action === 'logout')
                                            <span class="action-logout"><i class="fas fa-sign-out-alt"></i> Logout</span>
                                        @else
                                            <span class="action-login_failed"><i class="fas fa-exclamation-triangle"></i> Login Fallido</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($log->status === 'success')
                                            <span class="badge badge-success">Éxito</span>
                                        @else
                                            <span class="badge badge-danger">Fallido</span>
                                        @endif
                                    </td>
                                    <td><small>{{ $log->ip_address }}</small></td>
                                    <td><small style="color: #6c757d;">{{ Str::limit($log->user_agent, 50) }}</small></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align: center; padding: 2rem; color: #6c757d;">
                                        No hay logins registrados aún
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Tab: Errores -->
        <div id="tab-errors" class="tab-content">
            <div class="logs-section">
                <h2><i class="fas fa-exclamation-triangle"></i> Errores y Fallos</h2>
                <div style="overflow-x: auto;">
                    <table class="logs-table">
                        <thead>
                            <tr>
                                <th>Fecha y Hora</th>
                                <th>Usuario</th>
                                <th>Acción</th>
                                <th>Descripción</th>
                                <th>Razón</th>
                                <th>IP</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($errorLogs as $log)
                                <tr>
                                    <td>{{ $log->created_at->format('d/m/Y H:i:s') }}</td>
                                    <td>
                                        @if($log->user)
                                            {{ $log->user->name }}<br>
                                            <small style="color: #6c757d;">{{ $log->user->email }}</small>
                                        @else
                                            <span style="color: #6c757d;">
                                                @if($log->metadata && isset($log->metadata['email']))
                                                    {{ $log->metadata['email'] }}
                                                @else
                                                    No identificado
                                                @endif
                                            </span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="action-{{ $log->action }}">
                                            {{ ucfirst(str_replace('_', ' ', $log->action)) }}
                                        </span>
                                    </td>
                                    <td>{{ $log->description }}</td>
                                    <td>
                                        @if($log->metadata && isset($log->metadata['reason']))
                                            <span class="badge badge-danger">{{ $log->metadata['reason'] }}</span>
                                        @else
                                            <span class="badge badge-warning">Error desconocido</span>
                                        @endif
                                    </td>
                                    <td><small>{{ $log->ip_address }}</small></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" style="text-align: center; padding: 2rem; color: #6c757d;">
                                        No hay errores registrados
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Enlaces rápidos -->
        <div style="margin-top: 2rem; text-align: center;">
            <a href="{{ route('admin.businesses') }}" style="display: inline-block; margin: 0.5rem; padding: 0.75rem 1.5rem; background: #8B4513; color: white; text-decoration: none; border-radius: 8px;">
                <i class="fas fa-store"></i> Gestionar Negocios
            </a>
            <a href="{{ route('admin.users') }}" style="display: inline-block; margin: 0.5rem; padding: 0.75rem 1.5rem; background: #1E90FF; color: white; text-decoration: none; border-radius: 8px;">
                <i class="fas fa-users"></i> Gestionar Usuarios
            </a>
            <a href="{{ route('admin.register') }}" style="display: inline-block; margin: 0.5rem; padding: 0.75rem 1.5rem; background: #C97D60; color: white; text-decoration: none; border-radius: 8px;">
                <i class="fas fa-user-plus"></i> Crear Nuevo Comercio
            </a>
            <a href="{{ route('admin.promotions') }}" style="display: inline-block; margin: 0.5rem; padding: 0.75rem 1.5rem; background: #228B22; color: white; text-decoration: none; border-radius: 8px;">
                <i class="fas fa-tags"></i> Gestionar Promociones
            </a>
            <a href="{{ route('dashboard') }}" style="display: inline-block; margin: 0.5rem; padding: 0.75rem 1.5rem; background: #6c757d; color: white; text-decoration: none; border-radius: 8px;">
                <i class="fas fa-arrow-left"></i> Volver
            </a>
        </div>
    </div>

    <script>
        function showTab(tabName) {
            // Ocultar todos los tabs
            document.querySelectorAll('.tab-content').forEach(tab => {
                tab.classList.remove('active');
            });
            document.querySelectorAll('.tab').forEach(tab => {
                tab.classList.remove('active');
            });

            // Mostrar el tab seleccionado
            document.getElementById('tab-' + tabName).classList.add('active');
            event.target.classList.add('active');
        }
    </script>
</body>
</html>

