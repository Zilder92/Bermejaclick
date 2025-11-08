<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($business->name ?? 'Comercio'); ?> - BermejaClick.co</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/styles.css')); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .business-detail-page {
            min-height: 100vh;
            padding-top: 80px;
        }
        .business-detail-header {
            background: var(--gradient-primary);
            color: white;
            padding: var(--spacing-lg) 0;
            margin-bottom: var(--spacing-lg);
        }
        .business-detail-hero {
            display: grid;
            grid-template-columns: 1fr 2fr;
            gap: var(--spacing-lg);
            margin-bottom: var(--spacing-lg);
        }
        .business-detail-image {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            height: 400px;
        }
        .business-detail-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .business-detail-info {
            background: white;
            padding: var(--spacing-lg);
            border-radius: 15px;
            box-shadow: var(--shadow-md);
        }
        .business-detail-name {
            font-size: 2.5rem;
            color: var(--color-primary);
            margin-bottom: var(--spacing-sm);
        }
        .business-detail-category {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(201, 125, 96, 0.1);
            color: var(--color-primary);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: var(--spacing-md);
        }
        .business-detail-description {
            color: var(--color-gray);
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: var(--spacing-md);
        }
        .promotions-section {
            margin-top: var(--spacing-lg);
        }
        .promotions-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: var(--spacing-md);
            margin-top: var(--spacing-md);
        }
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--color-primary);
            text-decoration: none;
            font-weight: 600;
            margin-bottom: var(--spacing-md);
            transition: var(--transition);
        }
        .back-link:hover {
            color: var(--color-primary-dark);
            transform: translateX(-5px);
        }
        @media (max-width: 768px) {
            .business-detail-hero {
                grid-template-columns: 1fr;
            }
            .business-detail-image {
                height: 250px;
            }
            .business-detail-name {
                font-size: 1.8rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header class="header">
        <nav class="navbar">
            <div class="container">
                <div class="nav-brand">
                    <a href="<?php echo e(route('home')); ?>" style="text-decoration: none; color: inherit;">
                        <h1 class="logo">Bermeja<span class="logo-accent">Click</span>.co</h1>
                    </a>
                </div>
                <ul class="nav-menu">
                    <li><a href="<?php echo e(route('home')); ?>#promociones">Promociones</a></li>
                    <li><a href="<?php echo e(route('home')); ?>#turismo">Turismo</a></li>
                    <li><a href="<?php echo e(route('home')); ?>#hoteles">Hoteles</a></li>
                    <li><a href="<?php echo e(route('home')); ?>#comidas">Comidas</a></li>
                    <li><a href="<?php echo e(route('businesses.index')); ?>">Comercios</a></li>
                    <li><a href="<?php echo e(route('login')); ?>" class="btn-login">Acceso Comercios</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <!-- Página de Detalle del Comercio -->
    <div class="business-detail-page">
        <div class="container">
            <a href="<?php echo e(route('businesses.index')); ?>" class="back-link">
                <i class="fas fa-arrow-left"></i> Volver a Comercios
            </a>

            <div class="business-detail-hero">
                <div class="business-detail-image">
                    <?php if(isset($business->cover_image) && $business->cover_image): ?>
                        <img src="<?php echo e(asset('storage/' . $business->cover_image)); ?>" alt="<?php echo e($business->name); ?>">
                    <?php elseif(isset($business->logo) && $business->logo): ?>
                        <img src="<?php echo e(asset('storage/' . $business->logo)); ?>" alt="<?php echo e($business->name); ?>">
                    <?php else: ?>
                        <div style="width: 100%; height: 100%; background: var(--gradient-primary); display: flex; align-items: center; justify-content: center; color: white;">
                            <div style="text-align: center;">
                                <i class="fas fa-store" style="font-size: 4rem; margin-bottom: 1rem;"></i>
                                <h3><?php echo e($business->name); ?></h3>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="business-detail-info">
                    <h1 class="business-detail-name"><?php echo e($business->name ?? 'Sin nombre'); ?></h1>
                    <div class="business-detail-category">
                        <i class="fas fa-tag"></i>
                        <span><?php echo e($business->category->name ?? 'General'); ?></span>
                    </div>
                    <div class="business-detail-description">
                        <?php echo e($business->description ?? 'Descubre este increíble comercio en Barrancabermeja.'); ?>

                    </div>
                </div>
            </div>

            <!-- Promociones Activas -->
            <div class="promotions-section">
                <h2 class="section-title">Promociones Activas</h2>
                <?php if($activePromotions && $activePromotions->count() > 0): ?>
                    <div class="promotions-grid">
                        <?php $__currentLoopData = $activePromotions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="promotion-card">
                                <div class="promotion-badge">-<?php echo e($promo->discount_percentage ?? 0); ?>%</div>
                                <div class="promotion-image">
                                    <?php if($promo->image): ?>
                                        <img src="<?php echo e(asset('storage/' . $promo->image)); ?>" alt="<?php echo e($promo->title); ?>">
                                    <?php else: ?>
                                        <div style="width: 100%; height: 200px; background: var(--gradient-primary); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem; font-weight: 600;">
                                            <?php echo e($promo->category->name ?? 'Promoción'); ?>

                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="promotion-content">
                                    <h3><?php echo e($promo->title ?? 'Sin título'); ?></h3>
                                    <p class="promotion-description">
                                        <?php echo e(\Illuminate\Support\Str::limit($promo->description ?? 'Sin descripción', 100)); ?>

                                    </p>
                                    <div class="promotion-prices">
                                        <span class="price-old">$<?php echo e(number_format($promo->price_regular ?? 0, 0, ',', '.')); ?></span>
                                        <span class="price-new">$<?php echo e(number_format($promo->price_discount ?? 0, 0, ',', '.')); ?></span>
                                    </div>
                                    <div class="promotion-meta">
                                        <span><i class="fas fa-calendar"></i> <?php echo e($promo->start_date ? $promo->start_date->format('d/m/Y') : 'N/A'); ?> - <?php echo e($promo->end_date ? $promo->end_date->format('d/m/Y') : 'N/A'); ?></span>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php else: ?>
                    <div style="text-align: center; padding: var(--spacing-xl); background: white; border-radius: 15px; box-shadow: var(--shadow-md);">
                        <i class="fas fa-tags" style="font-size: 4rem; color: var(--color-gray); margin-bottom: 1rem;"></i>
                        <h3 style="color: var(--color-gray); margin-bottom: 0.5rem;">No hay promociones activas</h3>
                        <p style="color: var(--color-gray);">Este comercio no tiene promociones disponibles en este momento</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>BermejaClick.co</h3>
                    <p>Tu plataforma de comercio local en Barrancabermeja</p>
                </div>
                <div class="footer-section">
                    <h4>Enlaces Rápidos</h4>
                    <ul>
                        <li><a href="<?php echo e(route('home')); ?>#promociones">Promociones</a></li>
                        <li><a href="<?php echo e(route('home')); ?>#turismo">Turismo</a></li>
                        <li><a href="<?php echo e(route('home')); ?>#hoteles">Hoteles</a></li>
                        <li><a href="<?php echo e(route('home')); ?>#comidas">Comidas</a></li>
                        <li><a href="<?php echo e(route('businesses.index')); ?>">Comercios</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Para Comercios</h4>
                    <ul>
                        <li><a href="<?php echo e(route('login')); ?>">Acceso Dashboard</a></li>
                        <li><a href="<?php echo e(route('login')); ?>">Acceso Comercios</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo e(date('Y')); ?> BermejaClick.co - Todos los derechos reservados</p>
            </div>
        </div>
    </footer>
</body>
</html>

<?php /**PATH C:\laragon\www\BermejaClick\resources\views/business-detail.blade.php ENDPATH**/ ?>