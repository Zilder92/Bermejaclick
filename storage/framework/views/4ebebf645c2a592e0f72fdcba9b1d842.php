<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - BermejaClick.co</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/dashboard.css')); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="modal" style="display: flex;">
        <div class="modal-content">
            <div class="modal-header">
                <h2>Acceso Comercios</h2>
                <a href="<?php echo e(route('home')); ?>" class="close-modal">&times;</a>
            </div>
            <div class="modal-body">
                <?php if($errors->any()): ?>
                    <div style="background: #fee; color: #c33; padding: 1rem; border-radius: 8px; margin-bottom: 1rem;">
                        <ul style="margin: 0; padding-left: 1.5rem;">
                            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li><?php echo e($error); ?></li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </ul>
                    </div>
                <?php endif; ?>

                <form method="POST" action="<?php echo e(route('login')); ?>" class="auth-form">
                    <?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="email">Correo Electrónico</label>
                        <input type="email" id="email" name="email" value="<?php echo e(old('email')); ?>" required autofocus>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    <div class="form-group" style="display: flex; align-items: center; gap: 0.5rem;">
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember" style="margin: 0;">Recordarme</label>
                    </div>
                    <button type="submit" class="btn-primary">Iniciar Sesión</button>
                </form>
                <div style="margin-top: 1rem; padding-top: 1rem; border-top: 1px solid #e9ecef; text-align: center;">
                    <p style="color: #6c757d; font-size: 0.9rem;">
                        ¿Necesitas una cuenta? Contacta al administrador.
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php /**PATH C:\laragon\www\BermejaClick\resources\views/auth/login.blade.php ENDPATH**/ ?>