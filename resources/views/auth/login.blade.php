<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Comercios - BermejaClick.co</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700;900&family=Rajdhani:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-neon: #00f3ff;
            --secondary-neon: #ff00ff;
            --accent-neon: #00ff88;
            --dark-bg: #0a0e27;
            --dark-card: #151932;
            --text-primary: #ffffff;
            --text-secondary: #a0aec0;
        }

        body {
            font-family: 'Rajdhani', sans-serif;
            background: var(--dark-bg);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            position: relative;
        }

        /* Fondo Animado con Partículas */
        .animated-bg {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
        }

        .gradient-orb {
            position: absolute;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.5;
            animation: float 20s infinite ease-in-out;
        }

        .orb-1 {
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, var(--primary-neon) 0%, transparent 70%);
            top: -250px;
            left: -250px;
            animation-delay: 0s;
        }

        .orb-2 {
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, var(--secondary-neon) 0%, transparent 70%);
            bottom: -200px;
            right: -200px;
            animation-delay: 5s;
        }

        .orb-3 {
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, var(--accent-neon) 0%, transparent 70%);
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            animation-delay: 10s;
        }

        @keyframes float {
            0%, 100% {
                transform: translate(0, 0) scale(1);
            }
            33% {
                transform: translate(30px, -30px) scale(1.1);
            }
            66% {
                transform: translate(-20px, 20px) scale(0.9);
            }
        }

        /* Grid de Fondo */
        .grid-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: 
                linear-gradient(rgba(0, 243, 255, 0.1) 1px, transparent 1px),
                linear-gradient(90deg, rgba(0, 243, 255, 0.1) 1px, transparent 1px);
            background-size: 50px 50px;
            z-index: 1;
            animation: gridMove 20s linear infinite;
        }

        @keyframes gridMove {
            0% {
                transform: translate(0, 0);
            }
            100% {
                transform: translate(50px, 50px);
            }
        }

        /* Contenedor Principal */
        .login-container {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 480px;
            padding: 2rem;
        }

        /* Card de Login */
        .login-card {
            background: rgba(21, 25, 50, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 3rem 2.5rem;
            border: 1px solid rgba(0, 243, 255, 0.2);
            box-shadow: 
                0 8px 32px rgba(0, 0, 0, 0.4),
                0 0 0 1px rgba(0, 243, 255, 0.1),
                inset 0 1px 0 rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
            animation: cardEntrance 0.8s ease-out;
        }

        @keyframes cardEntrance {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.95);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(0, 243, 255, 0.1),
                transparent
            );
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% {
                left: -100%;
            }
            100% {
                left: 100%;
            }
        }

        /* Header */
        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
            position: relative;
        }

        .logo-container {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            position: relative;
            animation: logoPulse 2s ease-in-out infinite;
        }

        @keyframes logoPulse {
            0%, 100% {
                transform: scale(1);
                filter: drop-shadow(0 0 10px var(--primary-neon));
            }
            50% {
                transform: scale(1.05);
                filter: drop-shadow(0 0 20px var(--primary-neon));
            }
        }

        .logo-icon {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--primary-neon), var(--secondary-neon));
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2.5rem;
            color: var(--dark-bg);
            position: relative;
            overflow: hidden;
        }

        .logo-icon::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                45deg,
                transparent 30%,
                rgba(255, 255, 255, 0.3) 50%,
                transparent 70%
            );
            animation: logoShine 3s infinite;
        }

        @keyframes logoShine {
            0% {
                transform: rotate(0deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        .login-title {
            font-family: 'Orbitron', sans-serif;
            font-size: 2rem;
            font-weight: 900;
            background: linear-gradient(135deg, var(--primary-neon), var(--secondary-neon), var(--accent-neon));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 2px;
            position: relative;
        }

        .login-subtitle {
            color: var(--text-secondary);
            font-size: 0.95rem;
            font-weight: 400;
            letter-spacing: 1px;
        }

        /* Formulario */
        .login-form {
            position: relative;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-label {
            display: block;
            color: var(--text-primary);
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            position: relative;
            padding-left: 1.5rem;
        }

        .form-label::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 16px;
            background: linear-gradient(180deg, var(--primary-neon), var(--accent-neon));
            border-radius: 2px;
        }

        .input-wrapper {
            position: relative;
        }

        .form-input {
            width: 100%;
            padding: 1rem 1.25rem 1rem 3rem;
            background: rgba(10, 14, 39, 0.6);
            border: 2px solid rgba(0, 243, 255, 0.2);
            border-radius: 12px;
            color: var(--text-primary);
            font-size: 1rem;
            font-family: 'Rajdhani', sans-serif;
            font-weight: 500;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-input::placeholder {
            color: rgba(160, 174, 192, 0.5);
        }

        .form-input:focus {
            border-color: var(--primary-neon);
            background: rgba(10, 14, 39, 0.8);
            box-shadow: 
                0 0 0 3px rgba(0, 243, 255, 0.1),
                0 0 20px rgba(0, 243, 255, 0.3),
                inset 0 0 20px rgba(0, 243, 255, 0.05);
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--primary-neon);
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .form-input:focus + .input-icon {
            color: var(--accent-neon);
            transform: translateY(-50%) scale(1.2);
        }

        /* Checkbox Personalizado */
        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 2rem;
            cursor: pointer;
        }

        .custom-checkbox {
            position: relative;
            width: 20px;
            height: 20px;
            flex-shrink: 0;
        }

        .custom-checkbox input {
            position: absolute;
            opacity: 0;
            cursor: pointer;
        }

        .checkmark {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(10, 14, 39, 0.6);
            border: 2px solid rgba(0, 243, 255, 0.3);
            border-radius: 4px;
            transition: all 0.3s ease;
        }

        .custom-checkbox input:checked ~ .checkmark {
            background: linear-gradient(135deg, var(--primary-neon), var(--accent-neon));
            border-color: var(--primary-neon);
            box-shadow: 0 0 10px rgba(0, 243, 255, 0.5);
        }

        .custom-checkbox input:checked ~ .checkmark::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: var(--dark-bg);
            font-weight: 900;
            font-size: 0.9rem;
        }

        .checkbox-label {
            color: var(--text-secondary);
            font-size: 0.9rem;
            user-select: none;
        }

        /* Botón de Submit */
        .submit-btn {
            width: 100%;
            padding: 1.25rem;
            background: linear-gradient(135deg, var(--primary-neon), var(--secondary-neon));
            border: none;
            border-radius: 12px;
            color: var(--dark-bg);
            font-family: 'Orbitron', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 
                0 4px 15px rgba(0, 243, 255, 0.4),
                0 0 30px rgba(0, 243, 255, 0.2);
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(
                90deg,
                transparent,
                rgba(255, 255, 255, 0.3),
                transparent
            );
            transition: left 0.5s;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 
                0 6px 25px rgba(0, 243, 255, 0.6),
                0 0 40px rgba(0, 243, 255, 0.4);
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .submit-btn i {
            margin-right: 0.5rem;
        }

        /* Mensajes de Error */
        .error-messages {
            background: rgba(255, 0, 0, 0.1);
            border: 1px solid rgba(255, 0, 0, 0.3);
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            animation: errorShake 0.5s ease;
        }

        @keyframes errorShake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-10px); }
            75% { transform: translateX(10px); }
        }

        .error-messages ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .error-messages li {
            color: #ff6b6b;
            font-size: 0.9rem;
            padding: 0.25rem 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .error-messages li::before {
            content: '⚠';
            font-size: 1rem;
        }

        /* Footer */
        .login-footer {
            text-align: center;
            margin-top: 2rem;
            padding-top: 2rem;
            border-top: 1px solid rgba(0, 243, 255, 0.1);
        }

        .login-footer p {
            color: var(--text-secondary);
            font-size: 0.85rem;
            margin-bottom: 1rem;
        }

        .back-link {
            color: var(--primary-neon);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .back-link:hover {
            color: var(--accent-neon);
            text-shadow: 0 0 10px var(--accent-neon);
        }

        /* Responsive */
        @media (max-width: 640px) {
            .login-container {
                padding: 1rem;
            }

            .login-card {
                padding: 2rem 1.5rem;
            }

            .login-title {
                font-size: 1.5rem;
            }

            .form-input {
                padding: 0.875rem 1rem 0.875rem 2.75rem;
            }
        }

        /* Efectos de Carga */
        .loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .loading .submit-btn {
            position: relative;
        }

        .loading .submit-btn::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 20px;
            height: 20px;
            border: 3px solid rgba(10, 14, 39, 0.3);
            border-top-color: var(--dark-bg);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: translate(-50%, -50%) rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Fondo Animado -->
    <div class="animated-bg">
        <div class="gradient-orb orb-1"></div>
        <div class="gradient-orb orb-2"></div>
        <div class="gradient-orb orb-3"></div>
    </div>
    
    <!-- Grid Overlay -->
    <div class="grid-overlay"></div>

    <!-- Contenedor de Login -->
    <div class="login-container">
        <div class="login-card">
            <!-- Header -->
            <div class="login-header">
                <div class="logo-container">
                    <div class="logo-icon">
                        <i class="fas fa-store"></i>
                    </div>
                </div>
                <h1 class="login-title">Acceso Comercios</h1>
                <p class="login-subtitle">Sistema de Autogestión</p>
            </div>

            <!-- Formulario -->
            <form method="POST" action="{{ route('login') }}" class="login-form" id="loginForm">
                @csrf

                @if ($errors->any())
                    <div class="error-messages">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="form-label">Correo Electrónico</label>
                    <div class="input-wrapper">
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="form-input" 
                            value="{{ old('email') }}" 
                            placeholder="tu@email.com"
                            required 
                            autofocus
                        >
                        <i class="fas fa-envelope input-icon"></i>
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">Contraseña</label>
                    <div class="input-wrapper">
                        <input 
                            type="password" 
                            id="password" 
                            name="password" 
                            class="form-input" 
                            placeholder="••••••••"
                            required
                        >
                        <i class="fas fa-lock input-icon"></i>
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="checkbox-wrapper">
                    <div class="custom-checkbox">
                        <input type="checkbox" id="remember" name="remember">
                        <span class="checkmark"></span>
                    </div>
                    <label for="remember" class="checkbox-label">Recordar sesión</label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="submit-btn">
                    <i class="fas fa-sign-in-alt"></i>
                    Iniciar Sesión
                </button>
            </form>

            <!-- Footer -->
            <div class="login-footer">
                <p>¿Necesitas una cuenta? Contacta al administrador.</p>
                <a href="{{ route('home') }}" class="back-link">
                    <i class="fas fa-arrow-left"></i>
                    Volver al inicio
                </a>
            </div>
        </div>
    </div>

    <script>
        // Efecto de carga al enviar formulario
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const form = this;
            const submitBtn = form.querySelector('.submit-btn');
            
            form.classList.add('loading');
            submitBtn.innerHTML = '<i class="fas fa-spinner"></i> Accediendo...';
            
            // Si hay errores, remover la clase loading
            setTimeout(() => {
                if (form.querySelector('.error-messages')) {
                    form.classList.remove('loading');
                    submitBtn.innerHTML = '<i class="fas fa-sign-in-alt"></i> Iniciar Sesión';
                }
            }, 100);
        });

        // Efecto de focus en inputs
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Animación de entrada para el card
        window.addEventListener('load', function() {
            document.querySelector('.login-card').style.animation = 'cardEntrance 0.8s ease-out';
        });
    </script>
</body>
</html>
