<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Comercios - BermejaClick.co</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --color-primary: #4A90E2;
            --color-primary-dark: #1E90FF;
            --color-secondary: #C97D60;
            --color-accent: #2A9D8F;
            --color-dark: #1E3A5F;
            --color-text: #2D3748;
            --color-text-light: #4A5568;
            --color-white: #FFFFFF;
            --color-bg-light: #F7FAFC;
            --shadow-sm: 0 2px 8px rgba(0, 0, 0, 0.08);
            --shadow-md: 0 4px 16px rgba(0, 0, 0, 0.12);
            --shadow-lg: 0 10px 30px rgba(0, 0, 0, 0.15);
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            overflow: hidden;
            padding: 2rem;
        }

        /* Fondo con imagen de Barrancabermeja */
        .background-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            background-image: url('<?php echo e(asset("images/barrancabermeja/Barrancabermeja_1.jpg")); ?>');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            opacity: 0.3;
        }

        .background-overlay::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(30, 58, 95, 0.85) 0%, rgba(74, 144, 226, 0.75) 100%);
        }

        /* Partículas flotantes */
        .floating-particles {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            overflow: hidden;
            pointer-events: none;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            animation: float 15s infinite ease-in-out;
        }

        .particle:nth-child(1) { left: 10%; animation-delay: 0s; }
        .particle:nth-child(2) { left: 20%; animation-delay: 2s; }
        .particle:nth-child(3) { left: 30%; animation-delay: 4s; }
        .particle:nth-child(4) { left: 40%; animation-delay: 6s; }
        .particle:nth-child(5) { left: 50%; animation-delay: 8s; }
        .particle:nth-child(6) { left: 60%; animation-delay: 10s; }
        .particle:nth-child(7) { left: 70%; animation-delay: 12s; }
        .particle:nth-child(8) { left: 80%; animation-delay: 14s; }

        @keyframes float {
            0%, 100% {
                transform: translateY(100vh) translateX(0);
                opacity: 0;
            }
            10% {
                opacity: 1;
            }
            90% {
                opacity: 1;
            }
            100% {
                transform: translateY(-100vh) translateX(50px);
                opacity: 0;
            }
        }

        /* Contenedor Principal */
        .login-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 480px;
        }

        /* Card de Login */
        .login-card {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: 3rem;
            box-shadow: var(--shadow-lg);
            border: 1px solid rgba(255, 255, 255, 0.3);
            animation: slideUp 0.6s ease-out;
            position: relative;
            overflow: hidden;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--color-primary) 0%, var(--color-accent) 50%, var(--color-secondary) 100%);
        }

        /* Header */
        .login-header {
            text-align: center;
            margin-bottom: 2.5rem;
        }

        .logo-wrapper {
            width: 80px;
            height: 80px;
            margin: 0 auto 1.5rem;
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-accent) 100%);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 8px 20px rgba(74, 144, 226, 0.3);
            position: relative;
            animation: logoFloat 3s ease-in-out infinite;
        }

        @keyframes logoFloat {
            0%, 100% {
                transform: translateY(0);
            }
            50% {
                transform: translateY(-10px);
            }
        }

        .logo-wrapper i {
            font-size: 2.5rem;
            color: var(--color-white);
        }

        .login-title {
            font-size: 2rem;
            font-weight: 800;
            color: var(--color-dark);
            margin-bottom: 0.5rem;
            letter-spacing: -0.02em;
        }

        .login-subtitle {
            color: var(--color-text-light);
            font-size: 1rem;
            font-weight: 500;
        }

        .login-badge {
            display: inline-block;
            margin-top: 1rem;
            padding: 0.5rem 1rem;
            background: linear-gradient(135deg, rgba(74, 144, 226, 0.1) 0%, rgba(42, 157, 143, 0.1) 100%);
            border-radius: 20px;
            color: var(--color-primary);
            font-size: 0.85rem;
            font-weight: 600;
        }

        /* Formulario */
        .login-form {
            margin-top: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            color: var(--color-text);
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-label i {
            color: var(--color-primary);
            font-size: 0.85rem;
        }

        .input-wrapper {
            position: relative;
        }

        .form-input {
            width: 100%;
            padding: 1rem 1.25rem 1rem 3rem;
            background: var(--color-bg-light);
            border: 2px solid #E2E8F0;
            border-radius: 12px;
            color: var(--color-text);
            font-size: 1rem;
            font-family: 'Inter', sans-serif;
            font-weight: 500;
            transition: all 0.3s ease;
            outline: none;
        }

        .form-input::placeholder {
            color: #A0AEC0;
        }

        .form-input:focus {
            border-color: var(--color-primary);
            background: var(--color-white);
            box-shadow: 0 0 0 4px rgba(74, 144, 226, 0.1);
        }

        .input-icon {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--color-primary);
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .form-input:focus + .input-icon {
            color: var(--color-accent);
            transform: translateY(-50%) scale(1.1);
        }

        /* Checkbox */
        .checkbox-group {
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
            background: var(--color-bg-light);
            border: 2px solid #E2E8F0;
            border-radius: 6px;
            transition: all 0.3s ease;
        }

        .custom-checkbox input:checked ~ .checkmark {
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-accent) 100%);
            border-color: var(--color-primary);
        }

        .custom-checkbox input:checked ~ .checkmark::after {
            content: '✓';
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            color: var(--color-white);
            font-weight: 700;
            font-size: 0.85rem;
        }

        .checkbox-label {
            color: var(--color-text-light);
            font-size: 0.9rem;
            user-select: none;
            font-weight: 500;
        }

        /* Botón Submit */
        .submit-btn {
            width: 100%;
            padding: 1.1rem;
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-primary-dark) 100%);
            border: none;
            border-radius: 12px;
            color: var(--color-white);
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(74, 144, 226, 0.4);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.75rem;
            position: relative;
            overflow: hidden;
        }

        .submit-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 25px rgba(74, 144, 226, 0.5);
        }

        .submit-btn:hover::before {
            left: 100%;
        }

        .submit-btn:active {
            transform: translateY(0);
        }

        .submit-btn i {
            font-size: 1.1rem;
        }

        /* Mensajes de Error */
        .error-messages {
            background: #FEE2E2;
            border: 1px solid #FECACA;
            border-radius: 12px;
            padding: 1rem;
            margin-bottom: 1.5rem;
            animation: errorSlide 0.4s ease-out;
        }

        @keyframes errorSlide {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .error-messages ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .error-messages li {
            color: #DC2626;
            font-size: 0.9rem;
            padding: 0.25rem 0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-weight: 500;
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
            border-top: 1px solid #E2E8F0;
        }

        .login-footer p {
            color: var(--color-text-light);
            font-size: 0.9rem;
            margin-bottom: 1rem;
            font-weight: 500;
        }

        .back-link {
            color: var(--color-primary);
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.9rem;
        }

        .back-link:hover {
            color: var(--color-accent);
            gap: 0.75rem;
        }

        .back-link i {
            transition: transform 0.3s ease;
        }

        .back-link:hover i {
            transform: translateX(-3px);
        }

        /* Responsive */
        @media (max-width: 640px) {
            body {
                padding: 1rem;
            }

            .login-card {
                padding: 2rem 1.5rem;
            }

            .login-title {
                font-size: 1.75rem;
            }

            .form-input {
                padding: 0.875rem 1rem 0.875rem 2.75rem;
            }
        }

        /* Loading State */
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
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top-color: var(--color-white);
            border-radius: 50%;
            animation: spin 0.8s linear infinite;
        }

        @keyframes spin {
            to { transform: translate(-50%, -50%) rotate(360deg); }
        }
    </style>
</head>
<body>
    <!-- Fondo con imagen -->
    <div class="background-overlay"></div>

    <!-- Partículas flotantes -->
    <div class="floating-particles">
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
        <div class="particle"></div>
    </div>

    <!-- Contenedor de Login -->
    <div class="login-wrapper">
        <div class="login-card">
            <!-- Header -->
            <div class="login-header">
                <div class="logo-wrapper">
                    <i class="fas fa-store"></i>
                </div>
                <h1 class="login-title">Portal Comercios</h1>
                <p class="login-subtitle">Sistema de Autogestión para Comerciantes</p>
                <span class="login-badge">
                    <i class="fas fa-map-marker-alt"></i> Barrancabermeja
                </span>
            </div>

            <!-- Formulario -->
            <form method="POST" action="<?php echo e(route('login')); ?>" class="login-form" id="loginForm">
                <?php echo csrf_field(); ?>

                <?php if($errors->any()): ?>
                    <div class="error-messages">
                        <ul>
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <!-- Email -->
                <div class="form-group">
                    <label for="email" class="form-label">
                        <i class="fas fa-envelope"></i>
                        Correo Electrónico
                    </label>
                    <div class="input-wrapper">
                        <input 
                            type="email" 
                            id="email" 
                            name="email" 
                            class="form-input" 
                            value="<?php echo e(old('email')); ?>" 
                            placeholder="tu@email.com"
                            required 
                            autofocus
                        >
                        <i class="fas fa-envelope input-icon"></i>
                    </div>
                </div>

                <!-- Password -->
                <div class="form-group">
                    <label for="password" class="form-label">
                        <i class="fas fa-lock"></i>
                        Contraseña
                    </label>
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
                <div class="checkbox-group">
                    <div class="custom-checkbox">
                        <input type="checkbox" id="remember" name="remember">
                        <span class="checkmark"></span>
                    </div>
                    <label for="remember" class="checkbox-label">Recordar sesión</label>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="submit-btn">
                    <i class="fas fa-sign-in-alt"></i>
                    <span>Iniciar Sesión</span>
                </button>
            </form>

            <!-- Footer -->
            <div class="login-footer">
                <p>¿Necesitas una cuenta? Contacta al administrador.</p>
                <a href="<?php echo e(route('home')); ?>" class="back-link">
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
            const btnText = submitBtn.querySelector('span');
            
            form.classList.add('loading');
            btnText.textContent = 'Accediendo...';
            
            // Si hay errores, remover la clase loading después de un tiempo
            setTimeout(() => {
                if (form.querySelector('.error-messages')) {
                    form.classList.remove('loading');
                    btnText.textContent = 'Iniciar Sesión';
                }
            }, 100);
        });

        // Efecto de focus mejorado en inputs
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.01)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Animación de entrada
        window.addEventListener('load', function() {
            document.querySelector('.login-card').style.animation = 'slideUp 0.6s ease-out';
        });
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\BermejaClick\resources\views/auth/login.blade.php ENDPATH**/ ?>