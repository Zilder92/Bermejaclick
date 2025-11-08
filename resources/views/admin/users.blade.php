<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestionar Usuarios - Panel Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background: #f5f5f5;
            color: #333;
            padding: 2rem;
        }
        .admin-container {
            max-width: 1400px;
            margin: 0 auto;
            background: white;
            border-radius: 8px;
            padding: 2rem;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            color: #333;
        }
        .alert {
            padding: 0.75rem 1rem;
            border-radius: 6px;
            margin-bottom: 1rem;
            font-size: 0.9rem;
        }
        .alert-success {
            background: #d4edda;
            color: #155724;
            border-left: 3px solid #28a745;
        }
        .alert-error {
            background: #f8d7da;
            color: #721c24;
            border-left: 3px solid #dc3545;
        }
        .alert-warning {
            background: #fff3cd;
            color: #856404;
            border-left: 3px solid #ffc107;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 1rem;
        }
        th {
            text-align: left;
            padding: 0.75rem;
            font-weight: 600;
            font-size: 0.875rem;
            color: #6c757d;
            border-bottom: 1px solid #e9ecef;
        }
        td {
            padding: 0.75rem;
            border-bottom: 1px solid #f0f0f0;
            font-size: 0.875rem;
        }
        tr:hover {
            background: #f8f9fa;
        }
        .badge {
            display: inline-block;
            padding: 0.25rem 0.5rem;
            border-radius: 12px;
            font-size: 0.75rem;
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
        .badge-info {
            background: #d1ecf1;
            color: #0c5460;
        }
        .btn-action {
            padding: 0.375rem 0.75rem;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 0.875rem;
            font-weight: 500;
            margin-right: 0.5rem;
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            min-width: 100px;
            justify-content: center;
        }
        .btn-delete {
            background: #dc3545;
            color: white;
            min-width: 100px;
        }
        .btn-delete:hover {
            background: #c82333;
        }
        td {
            padding: 0.75rem;
            border-bottom: 1px solid #f0f0f0;
            font-size: 0.875rem;
        }
        td small, td .small-text {
            font-size: 0.8125rem;
        }
        .pagination-info {
            margin-top: 1rem;
            margin-bottom: 0.5rem;
            color: #6c757d;
            font-size: 0.875rem;
            text-align: center;
        }
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            margin-top: 1rem;
            flex-wrap: wrap;
        }
        .pagination-wrapper .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 0.5rem;
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .pagination-wrapper .pagination li {
            display: inline-block;
        }
        .pagination-wrapper .pagination a,
        .pagination-wrapper .pagination span {
            padding: 0.25rem 0.5rem;
            border: 1px solid #dee2e6;
            border-radius: 3px;
            text-decoration: none;
            color: #495057;
            font-size: 0.75rem;
            background: white;
            min-width: 26px;
            height: 26px;
            line-height: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
        }
        .pagination-wrapper .pagination a svg,
        .pagination-wrapper .pagination span svg {
            width: 10px !important;
            height: 10px !important;
        }
        .pagination-wrapper .pagination a svg.w-5,
        .pagination-wrapper .pagination span svg.w-5,
        .pagination-wrapper .pagination a svg[class*="w-"],
        .pagination-wrapper .pagination span svg[class*="w-"] {
            width: 10px !important;
            height: 10px !important;
        }
        .pagination-wrapper .pagination a i,
        .pagination-wrapper .pagination span i {
            font-size: 0.6875rem;
        }
        .pagination-wrapper .pagination a:hover {
            background: #f8f9fa;
        }
        .pagination-wrapper .pagination .active span {
            background: #8B4513;
            color: white;
            border-color: #8B4513;
        }
        .pagination-wrapper .pagination .disabled span {
            opacity: 0.5;
            cursor: not-allowed;
            background: #f8f9fa;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
            <h1 class="page-title" style="margin: 0;">Gestionar Usuarios</h1>
            <a href="{{ route('admin.dashboard') }}" style="display: inline-flex; align-items: center; gap: 0.5rem; padding: 0.5rem 1rem; background: #6c757d; color: white; text-decoration: none; border-radius: 6px; font-size: 0.875rem; font-weight: 500; transition: background 0.2s;">
                <i class="fas fa-arrow-left"></i> Volver al Dashboard
            </a>
        </div>

        @if(session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-error">
                <i class="fas fa-times-circle"></i> {{ session('error') }}
            </div>
        @endif

        @if(session('warning'))
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i> {{ session('warning') }}
            </div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Business</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($users ?? [] as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td><strong>{{ $user->name ?? 'Sin nombre' }}</strong></td>
                        <td>{{ $user->email ?? 'N/A' }}</td>
                        <td>
                            @if($user->role === 'admin')
                                <span class="badge badge-info">Admin</span>
                            @else
                                <span class="badge badge-success">Business</span>
                            @endif
                        </td>
                        <td>
                            @if(isset($user->business) && $user->business)
                                {{ $user->business->name ?? 'N/A' }}
                            @else
                                <span style="color: #6c757d;">Sin negocio</span>
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-success">Activo</span>
                        </td>
                        <td>
                            @if(!$user->isAdmin())
                                <form action="{{ route('admin.users.delete', $user->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('¿Estás seguro de eliminar este usuario?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete">
                                        <i class="fas fa-trash"></i> Eliminar
                                    </button>
                                </form>
                            @else
                                <span style="color: #6c757d; font-size: 0.875rem;">No se puede eliminar</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" style="text-align: center; padding: 2rem; color: #6c757d;">
                            No hay usuarios registrados aún
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if(isset($users) && method_exists($users, 'links'))
            <div class="pagination-info">
                Mostrando {{ $users->firstItem() ?? 0 }} a {{ $users->lastItem() ?? 0 }} de {{ $users->total() }} resultados
            </div>
            <div class="pagination-wrapper">
                {{ $users->links() }}
            </div>
        @endif
    </div>
</body>
</html>

