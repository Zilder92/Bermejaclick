<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Nuevo Comercio - Panel Admin</title>
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div style="min-height: 100vh; background: #f5f7fa; padding: 2rem;">
        <div style="max-width: 600px; margin: 0 auto; background: white; border-radius: 12px; box-shadow: 0 4px 16px rgba(0,0,0,0.1);">
            <div style="padding: 2rem; border-bottom: 1px solid #e9ecef;">
                <h2 style="margin: 0; color: #8B4513;">
                    <i class="fas fa-user-plus"></i> Crear Nuevo Comercio
                </h2>
                <p style="color: #6c757d; margin-top: 0.5rem;">Solo administradores pueden crear cuentas</p>
            </div>
            <div style="padding: 2rem;">
                @if ($errors->any())
                    <div style="background: #fee; color: #c33; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                        <ul style="margin: 0; padding-left: 1.5rem;">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.register') }}" class="auth-form">
                    @csrf
                    <h3 style="color: #8B4513; margin-bottom: 1rem;">Datos del Usuario</h3>
                    <div class="form-group">
                        <label for="name">Nombre del Usuario</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Teléfono</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}">
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirmar Contraseña</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required>
                    </div>

                    <h3 style="color: #8B4513; margin-top: 2rem; margin-bottom: 1rem;">Datos del Negocio</h3>
                    <div class="form-group">
                        <label for="business_name">Nombre del Negocio *</label>
                        <input type="text" id="business_name" name="business_name" value="{{ old('business_name') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="business_category">Categoría *</label>
                        <select id="business_category" name="business_category" required>
                            <option value="">Seleccione una categoría</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('business_category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="business_email">Email del Negocio (opcional)</label>
                        <input type="email" id="business_email" name="business_email" value="{{ old('business_email') }}">
                        <small style="color: #6c757d;">Si no se especifica, se usará el email del usuario</small>
                    </div>
                    <div class="form-group">
                        <label for="business_phone">Teléfono del Negocio (opcional)</label>
                        <input type="tel" id="business_phone" name="business_phone" value="{{ old('business_phone') }}">
                    </div>
                    <div class="form-group">
                        <label for="business_address">Dirección (opcional)</label>
                        <textarea id="business_address" name="business_address" rows="2">{{ old('business_address') }}</textarea>
                    </div>

                    <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                        <button type="submit" class="btn-primary" style="flex: 1;">
                            <i class="fas fa-save"></i> Crear Comercio
                        </button>
                        <a href="{{ route('admin.users') }}" class="btn-secondary" style="flex: 1; text-align: center; text-decoration: none; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-times"></i> Cancelar
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>

