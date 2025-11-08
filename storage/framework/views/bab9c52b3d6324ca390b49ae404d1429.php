<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - BermejaClick.co</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/dashboard.css')); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <?php if(auth()->guard()->check()): ?>
    <!-- Dashboard Container -->
    <div id="dashboardContainer" class="dashboard-container">
        <!-- Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-header">
                <h2>Bermeja<span class="logo-accent">Click</span></h2>
                <p class="sidebar-subtitle">Panel de Control</p>
            </div>
            <nav class="sidebar-nav">
                <ul>
                    <li class="nav-item active" data-page="dashboard">
                        <i class="fas fa-home"></i>
                        <span>Inicio</span>
                    </li>
                    <li class="nav-item" data-page="profile">
                        <i class="fas fa-user"></i>
                        <span>Mi Perfil</span>
                    </li>
                    <li class="nav-item" data-page="new-promotion">
                        <i class="fas fa-plus-circle"></i>
                        <span>Publicar Oferta</span>
                    </li>
                    <li class="nav-item" data-page="promotions">
                        <i class="fas fa-tags"></i>
                        <span>Mis Promociones</span>
                    </li>
                    <li class="nav-item" data-page="statistics">
                        <i class="fas fa-chart-bar"></i>
                        <span>Estadísticas</span>
                    </li>
                    <li class="nav-item" data-page="payments">
                        <i class="fas fa-credit-card"></i>
                        <span>Historial de Pagos</span>
                    </li>
                </ul>
            </nav>
            <div class="sidebar-footer">
                <form method="POST" action="<?php echo e(route('logout')); ?>" style="margin: 0;">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn-logout" style="width: 100%; border: none; background: none; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 0.5rem; color: white; font-weight: 600;">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Cerrar Sesión</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <!-- Top Bar -->
            <header class="top-bar">
                <div class="top-bar-content">
                    <h1 id="pageTitle">Dashboard</h1>
                    <div class="top-bar-actions">
                        <div class="user-info">
                            <span id="userName"><?php echo e(Auth::user()->name); ?></span>
                            <i class="fas fa-user-circle"></i>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Dashboard Page -->
            <div id="page-dashboard" class="page-content active">
                <?php if(session('success')): ?>
                    <div style="background: #d4edda; color: #155724; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; border-left: 4px solid #28a745;">
                        <i class="fas fa-check-circle"></i> <?php echo e(session('success')); ?>

                    </div>
                <?php endif; ?>

                <?php if(session('warning')): ?>
                    <div style="background: #fff3cd; color: #856404; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; border-left: 4px solid #ffc107;">
                        <i class="fas fa-exclamation-triangle"></i> <?php echo e(session('warning')); ?>

                    </div>
                <?php endif; ?>

                <?php if(session('error')): ?>
                    <div style="background: #f8d7da; color: #721c24; padding: 1rem; border-radius: 8px; margin-bottom: 1.5rem; border-left: 4px solid #dc3545;">
                        <i class="fas fa-times-circle"></i> <?php echo e(session('error')); ?>

                    </div>
                <?php endif; ?>

                <?php if(!$business): ?>
                    <div style="background: #e7f3ff; color: #004085; padding: 2rem; border-radius: 12px; margin-bottom: 2rem; text-align: center; border: 2px dashed #1E90FF;">
                        <i class="fas fa-info-circle" style="font-size: 3rem; color: #1E90FF; margin-bottom: 1rem;"></i>
                        <h2 style="color: #1E90FF; margin-bottom: 1rem;">Completa tu Perfil</h2>
                        <p style="font-size: 1.1rem; margin-bottom: 1.5rem;">
                            Tu cuenta no tiene un negocio asociado. Contacta al administrador para completar la configuración.
                        </p>
                        <p style="color: #6c757d;">
                            Email: <strong>admin@bermejaclick.com</strong>
                        </p>
                    </div>
                <?php endif; ?>

                <div class="stats-grid">
                    <div class="stat-card">
                        <div class="stat-icon" style="background: #8B4513;">
                            <i class="fas fa-tags"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Promociones Activas</h3>
                            <p class="stat-number"><?php echo e($stats['active_promotions'] ?? 0); ?></p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon" style="background: #1E90FF;">
                            <i class="fas fa-eye"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Visualizaciones</h3>
                            <p class="stat-number"><?php echo e(number_format($stats['total_views'] ?? 0)); ?></p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon" style="background: #228B22;">
                            <i class="fas fa-hand-pointer"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Clics</h3>
                            <p class="stat-number"><?php echo e(number_format($stats['total_clicks'] ?? 0)); ?></p>
                        </div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon" style="background: #DC143C;">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="stat-info">
                            <h3>Ingresos</h3>
                            <p class="stat-number">$<?php echo e(number_format($stats['total_revenue'] ?? 0, 0, ',', '.')); ?></p>
                        </div>
                    </div>
                </div>

                <div class="dashboard-section">
                    <h2>Promociones Recientes</h2>
                    <?php if(isset($recentPromotions) && $recentPromotions->count() > 0): ?>
                        <div class="recent-promotions">
                            <?php $__currentLoopData = $recentPromotions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="promo-item">
                                    <div class="promo-image-small">
                                        <?php if(isset($promo->image) && $promo->image): ?>
                                            <img src="<?php echo e(asset('storage/' . $promo->image)); ?>" alt="<?php echo e($promo->title ?? 'Promoción'); ?>">
                                        <?php else: ?>
                                            <div style="width: 80px; height: 80px; background: linear-gradient(135deg, #C97D60 0%, #4A90E2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 0.7rem; text-align: center; border-radius: 4px;">
                                                Sin imagen
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="promo-details">
                                        <h4><?php echo e($promo->title ?? 'Sin título'); ?></h4>
                                        <p>Activa hasta: <?php echo e(isset($promo->end_date) && $promo->end_date ? $promo->end_date->format('d/m/Y') : 'N/A'); ?></p>
                                    </div>
                                    <div class="promo-status <?php echo e((isset($promo) && method_exists($promo, 'isActive') && $promo->isActive()) ? 'active' : ''); ?>">
                                        <?php echo e((isset($promo) && method_exists($promo, 'isActive') && $promo->isActive()) ? 'Activa' : 'Inactiva'); ?>

                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php else: ?>
                        <p style="text-align: center; color: #666; padding: 2rem;">No tienes promociones aún. <a href="#page-new-promotion" onclick="navigateTo('new-promotion')">Crea tu primera promoción</a></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Profile Page -->
            <div id="page-profile" class="page-content">
                <div class="page-header">
                    <h2>Mi Perfil</h2>
                    <p>Gestiona la información de tu comercio</p>
                </div>
                <div class="profile-form-container">
                    <form class="profile-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="profile-name">Nombre del Comercio</label>
                                <input type="text" id="profile-name" value="Restaurante El Petrolero">
                            </div>
                            <div class="form-group">
                                <label for="profile-email">Correo Electrónico</label>
                                <input type="email" id="profile-email" value="contacto@elpetrolero.com">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="profile-phone">Teléfono</label>
                                <input type="tel" id="profile-phone" value="+57 300 123 4567">
                            </div>
                            <div class="form-group">
                                <label for="profile-address">Dirección</label>
                                <input type="text" id="profile-address" value="Calle 50 # 20-30, Barrancabermeja">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="profile-description">Descripción</label>
                            <textarea id="profile-description" rows="4">Restaurante especializado en comida típica de la región, con más de 10 años de experiencia.</textarea>
                        </div>
                        <div class="form-group">
                            <label for="profile-logo">Logo del Comercio</label>
                            <input type="file" id="profile-logo" accept="image/*">
                        </div>
                        <button type="submit" class="btn-primary">Guardar Cambios</button>
                    </form>
                </div>
            </div>

            <!-- New Promotion Page -->
            <div id="page-new-promotion" class="page-content">
                <div class="page-header">
                    <h2>Publicar Nueva Oferta</h2>
                    <p>Completa el formulario para crear una nueva promoción</p>
                </div>
                <div class="promotion-form-container">
                    <form id="newPromotionForm" class="promotion-form" action="<?php echo e(route('promotions.store')); ?>" method="POST" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
                        <div class="form-group">
                            <label for="promo-title">Título de la Promoción *</label>
                            <input type="text" id="promo-title" name="title" value="<?php echo e(old('title')); ?>" placeholder="Ej: 2x1 en Hamburguesas" required>
                            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="error-message"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="form-group">
                            <label for="promo-description">Descripción Detallada *</label>
                            <textarea id="promo-description" name="description" rows="5" placeholder="Describe tu promoción de manera atractiva..." required><?php echo e(old('description')); ?></textarea>
                            <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="error-message"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="promo-price-regular">Precio Regular *</label>
                                <input type="number" id="promo-price-regular" name="price_regular" value="<?php echo e(old('price_regular')); ?>" placeholder="25000" step="0.01" min="0" required>
                                <?php $__errorArgs = ['price_regular'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="error-message"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="form-group">
                                <label for="promo-price-discount">Precio con Descuento *</label>
                                <input type="number" id="promo-price-discount" name="price_discount" value="<?php echo e(old('price_discount')); ?>" placeholder="17500" step="0.01" min="0" required>
                                <?php $__errorArgs = ['price_discount'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="error-message"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group">
                                <label for="promo-start-date">Fecha de Inicio *</label>
                                <input type="date" id="promo-start-date" name="start_date" value="<?php echo e(old('start_date')); ?>" required>
                                <?php $__errorArgs = ['start_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="error-message"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="form-group">
                                <label for="promo-end-date">Fecha de Fin *</label>
                                <input type="date" id="promo-end-date" name="end_date" value="<?php echo e(old('end_date')); ?>" required>
                                <?php $__errorArgs = ['end_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="error-message"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="promo-category">Categoría de la Oferta *</label>
                            <select id="promo-category" name="category_id" required>
                                <option value="">Selecciona una categoría</option>
                                <?php if(isset($categories) && $categories->count() > 0): ?>
                                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>"><?php echo e($category->name); ?></option>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <option value="1">Comida</option>
                                    <option value="2">Hoteles</option>
                                    <option value="3">Turismo</option>
                                    <option value="4">Ropa</option>
                                    <option value="5">Servicios</option>
                                <?php endif; ?>
                            </select>
                            <?php $__errorArgs = ['category_id'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <span class="error-message"><?php echo e($message); ?></span>
                            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                        </div>
                        <div class="form-group">
                            <label for="promo-image">Imagen Promocional *</label>
                            <div class="image-upload-area">
                                <input type="file" id="promo-image" name="image" accept="image/*" required>
                                <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <span class="error-message"><?php echo e($message); ?></span>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                                <div class="image-preview" id="imagePreview">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p>Haz clic para subir una imagen de alta calidad</p>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="button" class="btn-secondary" onclick="resetForm()">Limpiar</button>
                            <button type="submit" class="btn-primary">Publicar Oferta</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Promotions List Page -->
            <div id="page-promotions" class="page-content">
                <div class="page-header">
                    <h2>Mis Promociones</h2>
                    <button class="btn-primary" onclick="navigateTo('new-promotion')">
                        <i class="fas fa-plus"></i> Nueva Promoción
                    </button>
                </div>
                <div class="promotions-list">
                    <?php if(isset($recentPromotions) && $recentPromotions->count() > 0): ?>
                        <?php $__currentLoopData = $recentPromotions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $promo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="promotion-list-item">
                                <div class="promo-list-image">
                                    <?php if($promo->image): ?>
                                        <img src="<?php echo e(asset('storage/' . $promo->image)); ?>" alt="<?php echo e($promo->title); ?>">
                                    <?php else: ?>
                                        <div style="width: 120px; height: 120px; background: linear-gradient(135deg, #C97D60 0%, #4A90E2 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 0.8rem; text-align: center; border-radius: 4px;">
                                            Sin imagen
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="promo-list-content">
                                    <h3><?php echo e($promo->title ?? 'Sin título'); ?></h3>
                                    <p class="promo-list-desc"><?php echo e(\Illuminate\Support\Str::limit($promo->description ?? 'Sin descripción', 100)); ?></p>
                                    <div class="promo-list-meta">
                                        <span><i class="fas fa-calendar"></i> <?php echo e($promo->start_date ? $promo->start_date->format('d/m/Y') : 'N/A'); ?> - <?php echo e($promo->end_date ? $promo->end_date->format('d/m/Y') : 'N/A'); ?></span>
                                        <span><i class="fas fa-tag"></i> <?php echo e($promo->category->name ?? 'Sin categoría'); ?></span>
                                        <span><i class="fas fa-eye"></i> <?php echo e(number_format($promo->views_count ?? 0, 0, ',', '.')); ?> visualizaciones</span>
                                    </div>
                                    <div class="promo-list-price" style="margin-top: 0.5rem;">
                                        <span class="price-old" style="text-decoration: line-through; color: #999; margin-right: 0.5rem;">$<?php echo e(number_format($promo->price_regular ?? 0, 0, ',', '.')); ?></span>
                                        <span class="price-new" style="color: #E63946; font-weight: 700; font-size: 1.1rem;">$<?php echo e(number_format($promo->price_discount ?? 0, 0, ',', '.')); ?></span>
                                        <span class="discount-badge" style="background: #28a745; color: white; padding: 0.2rem 0.5rem; border-radius: 4px; font-size: 0.8rem; margin-left: 0.5rem;">-<?php echo e($promo->discount_percentage ?? 0); ?>%</span>
                                    </div>
                                </div>
                                <div class="promo-list-actions">
                                    <span class="status-badge <?php echo e(($promo->is_active ?? false) ? 'active' : 'inactive'); ?>" style="padding: 0.4rem 0.8rem; border-radius: 4px; font-size: 0.85rem; font-weight: 600; <?php echo e(($promo->is_active ?? false) ? 'background: #d4edda; color: #155724;' : 'background: #f8d7da; color: #721c24;'); ?>">
                                        <?php echo e(($promo->is_active ?? false) ? 'Activa' : 'Inactiva'); ?>

                                    </span>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <p style="text-align: center; color: #666; padding: 2rem;">
                            No tienes promociones aún. 
                            <a href="#page-new-promotion" onclick="navigateTo('new-promotion')" style="color: #4A90E2; text-decoration: underline; font-weight: 600;">
                                Crea tu primera promoción
                            </a>
                        </p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Statistics Page -->
            <div id="page-statistics" class="page-content">
                <div class="page-header">
                    <h2>Estadísticas</h2>
                    <p>Analiza el rendimiento de tus promociones</p>
                </div>
                <div class="stats-charts">
                    <div class="chart-card">
                        <h3>Visualizaciones por Mes</h3>
                        <div class="chart-placeholder">
                            <p>Gráfico de visualizaciones</p>
                            <div class="mock-chart">
                                <div class="chart-bar" style="height: 60%"></div>
                                <div class="chart-bar" style="height: 80%"></div>
                                <div class="chart-bar" style="height: 45%"></div>
                                <div class="chart-bar" style="height: 90%"></div>
                                <div class="chart-bar" style="height: 70%"></div>
                                <div class="chart-bar" style="height: 85%"></div>
                            </div>
                        </div>
                    </div>
                    <div class="chart-card">
                        <h3>Promociones por Categoría</h3>
                        <div class="chart-placeholder">
                            <p>Gráfico de categorías</p>
                            <div class="category-stats">
                                <div class="category-item">
                                    <span>Comida</span>
                                    <div class="progress-bar">
                                        <div class="progress" style="width: 45%"></div>
                                    </div>
                                    <span>45%</span>
                                </div>
                                <div class="category-item">
                                    <span>Ropa</span>
                                    <div class="progress-bar">
                                        <div class="progress" style="width: 25%"></div>
                                    </div>
                                    <span>25%</span>
                                </div>
                                <div class="category-item">
                                    <span>Servicios</span>
                                    <div class="progress-bar">
                                        <div class="progress" style="width: 20%"></div>
                                    </div>
                                    <span>20%</span>
                                </div>
                                <div class="category-item">
                                    <span>Turismo</span>
                                    <div class="progress-bar">
                                        <div class="progress" style="width: 10%"></div>
                                    </div>
                                    <span>10%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payments Page -->
            <div id="page-payments" class="page-content">
                <div class="page-header">
                    <h2>Historial de Pagos</h2>
                    <p>Consulta tus transacciones y facturas</p>
                </div>
                <div class="payments-table-container">
                    <table class="payments-table">
                        <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Concepto</th>
                                <th>Monto</th>
                                <th>Estado</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>15/12/2024</td>
                                <td>Publicación Promoción - 2x1 Hamburguesas</td>
                                <td>$50.000</td>
                                <td><span class="status-paid">Pagado</span></td>
                                <td><a href="#" class="btn-link">Ver Factura</a></td>
                            </tr>
                            <tr>
                                <td>10/12/2024</td>
                                <td>Publicación Promoción - Descuento Ropa</td>
                                <td>$50.000</td>
                                <td><span class="status-paid">Pagado</span></td>
                                <td><a href="#" class="btn-link">Ver Factura</a></td>
                            </tr>
                            <tr>
                                <td>05/12/2024</td>
                                <td>Plan Premium Mensual</td>
                                <td>$150.000</td>
                                <td><span class="status-paid">Pagado</span></td>
                                <td><a href="#" class="btn-link">Ver Factura</a></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

    <script src="<?php echo e(asset('js/dashboard.js')); ?>"></script>
    <script>
        // Remover funciones de autenticación JavaScript obsoletas
        // La autenticación ahora se maneja en el servidor
        document.addEventListener('DOMContentLoaded', function() {
            // Solo mantener la navegación entre páginas del dashboard
            initNavigation();
            initPromotionForm();
            initImageUpload();
            setMinDate();
        });
    </script>
</body>
</html>
    <?php else: ?>
    <script>
        window.location.href = "<?php echo e(route('login')); ?>";
    </script>
    <?php endif; ?>

<?php /**PATH C:\laragon\www\BermejaClick\resources\views/dashboard.blade.php ENDPATH**/ ?>