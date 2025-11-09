<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comercios - BermejaClick.co</title>
    <link rel="stylesheet" href="<?php echo e(asset('css/styles.css')); ?>">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .businesses-page {
            min-height: 100vh;
            padding-top: 0;
            position: relative;
        }

        /* Header con Carrusel de Imágenes */
        .businesses-hero {
            position: relative;
            overflow: hidden;
            margin-bottom: var(--spacing-lg);
            height: 700px;
        }

        @media (max-width: 768px) {
            .businesses-hero {
                height: 500px;
            }
        }

        @media (max-width: 480px) {
            .businesses-hero {
                height: 450px;
            }
        }

        .header-image-carousel {
            position: relative;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .carousel-container {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .carousel-slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1s ease-in-out;
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
        }

        .carousel-slide.active {
            opacity: 1;
            z-index: 1;
        }

        .carousel-slide::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.3) 0%, rgba(0, 0, 0, 0.2) 100%);
            z-index: 1;
        }

        .carousel-indicators {
            position: absolute;
            bottom: 30px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 12px;
            z-index: 10;
        }

        .carousel-indicator {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            transition: all 0.3s ease;
            border: 2px solid rgba(255, 255, 255, 0.8);
        }

        .carousel-indicator.active {
            background: var(--color-white);
            width: 32px;
            border-radius: 6px;
            border-color: var(--color-white);
        }

        .carousel-indicator:hover {
            background: rgba(255, 255, 255, 0.8);
        }

        .businesses-hero-content {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10;
            text-align: center;
            color: white;
            width: 100%;
            max-width: 1200px;
            padding: 0 var(--spacing-md);
        }

        .businesses-hero h1 {
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 800;
            margin-bottom: 1rem;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            animation: fadeInDown 0.8s ease;
        }

        .businesses-hero p {
            font-size: clamp(1rem, 2vw, 1.3rem);
            opacity: 0.95;
            max-width: 600px;
            margin: 0 auto;
            animation: fadeInUp 0.8s ease 0.2s both;
        }

        .businesses-hero-stats {
            display: flex;
            justify-content: center;
            gap: var(--spacing-lg);
            margin-top: var(--spacing-lg);
            flex-wrap: wrap;
            animation: fadeInUp 0.8s ease 0.4s both;
        }

        .hero-stat {
            text-align: center;
            padding: 1rem 1.5rem;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: var(--transition);
        }

        .hero-stat:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: translateY(-5px);
        }

        .hero-stat:nth-child(1) {
            background: linear-gradient(135deg, rgba(201, 125, 96, 0.3) 0%, rgba(230, 57, 70, 0.2) 100%);
        }

        .hero-stat:nth-child(2) {
            background: linear-gradient(135deg, rgba(74, 144, 226, 0.3) 0%, rgba(42, 157, 143, 0.2) 100%);
        }

        .hero-stat:nth-child(3) {
            background: linear-gradient(135deg, rgba(247, 127, 0, 0.3) 0%, rgba(230, 57, 70, 0.2) 100%);
        }

        .hero-stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            display: block;
            line-height: 1;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }

        .hero-stat-label {
            font-size: 0.9rem;
            opacity: 0.95;
            margin-top: 0.5rem;
            font-weight: 600;
        }

        /* Filtros Modernos */
        .businesses-filters-wrapper {
            position: relative;
            margin-top: -60px;
            z-index: 10;
        }

        .businesses-filters {
            background: linear-gradient(135deg, 
                rgba(255, 255, 255, 0.98) 0%, 
                rgba(245, 241, 235, 0.95) 100%
            );
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: var(--spacing-md);
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(201, 125, 96, 0.15), 
                        0 0 0 1px rgba(201, 125, 96, 0.1);
            border: 2px solid rgba(201, 125, 96, 0.2);
            position: relative;
            overflow: hidden;
        }

        .businesses-filters::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, 
                transparent 0%, 
                rgba(201, 125, 96, 0.1) 50%, 
                transparent 100%
            );
            animation: shimmer 3s infinite;
        }

        @keyframes shimmer {
            0% { left: -100%; }
            100% { left: 100%; }
        }

        .filter-form {
            display: grid;
            grid-template-columns: 2fr 1fr auto auto;
            gap: var(--spacing-sm);
            align-items: end;
        }

        .filter-group {
            display: flex;
            flex-direction: column;
        }

        .filter-group label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--color-primary) 0%, var(--color-secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-size: 0.95rem;
        }

        .filter-group input,
        .filter-group select {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid var(--color-gray-light);
            border-radius: 12px;
            font-size: 1rem;
            transition: var(--transition);
            background: white;
            font-family: var(--font-primary);
        }

        .filter-group input:focus,
        .filter-group select:focus {
            outline: none;
            border-color: var(--color-primary);
            box-shadow: 0 0 0 3px rgba(201, 125, 96, 0.15),
                        0 4px 12px rgba(201, 125, 96, 0.2);
            background: linear-gradient(to bottom, #fff 0%, #faf9f7 100%);
        }

        .btn-filter {
            padding: 0.875rem 2rem;
            background: linear-gradient(135deg, 
                #C97D60 0%, 
                #E63946 50%, 
                #4A90E2 100%
            );
            background-size: 200% 200%;
            animation: gradientShift 3s ease infinite;
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 700;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 0.5rem;
            white-space: nowrap;
            box-shadow: 0 4px 15px rgba(201, 125, 96, 0.4),
                        0 0 20px rgba(230, 57, 70, 0.2);
            position: relative;
            overflow: hidden;
        }

        .btn-filter::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, 
                transparent 0%, 
                rgba(255, 255, 255, 0.3) 50%, 
                transparent 100%
            );
            transition: left 0.5s;
        }

        .btn-filter:hover::before {
            left: 100%;
        }

        .btn-filter:hover {
            transform: translateY(-2px) scale(1.05);
            box-shadow: 0 8px 25px rgba(201, 125, 96, 0.5),
                        0 0 30px rgba(230, 57, 70, 0.3);
        }

        @keyframes gradientShift {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .btn-filter-clear {
            padding: 0.875rem 1.5rem;
            background: linear-gradient(135deg, #6c757d 0%, #495057 100%);
            color: white;
            border: none;
            border-radius: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            white-space: nowrap;
            box-shadow: 0 4px 12px rgba(108, 117, 125, 0.3);
        }

        .btn-filter-clear:hover {
            background: linear-gradient(135deg, #5a6268 0%, #343a40 100%);
            transform: translateY(-2px);
            text-decoration: none;
            color: white;
            box-shadow: 0 6px 18px rgba(108, 117, 125, 0.4);
        }

        /* Grid de Comercios Mejorado */
        .businesses-content {
            padding: var(--spacing-lg) 0;
            position: relative;
        }

        .business-profiles-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: var(--spacing-md);
            margin-top: var(--spacing-md);
        }

        .business-profile-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08),
                        0 0 0 1px rgba(201, 125, 96, 0.1);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            display: flex;
            flex-direction: column;
            height: 100%;
            border: 2px solid transparent;
            position: relative;
        }

        .business-profile-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, 
                #C97D60 0%, 
                #E63946 25%, 
                #4A90E2 50%, 
                #2A9D8F 75%, 
                #F77F00 100%
            );
            background-size: 200% 100%;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
            animation: gradientMove 3s ease infinite;
        }

        @keyframes gradientMove {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .business-profile-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 50px rgba(201, 125, 96, 0.25),
                        0 0 30px rgba(74, 144, 226, 0.15),
                        0 0 0 2px rgba(201, 125, 96, 0.3);
            border-color: rgba(201, 125, 96, 0.3);
        }

        .business-profile-card:hover::before {
            transform: scaleX(1);
        }

        .business-card-link {
            text-decoration: none;
            color: inherit;
            display: block;
            height: 100%;
        }

        .business-card-link:hover {
            text-decoration: none;
        }

        .business-profile-image {
            width: 100%;
            height: 240px;
            overflow: hidden;
            position: relative;
            background: linear-gradient(135deg, 
                #C97D60 0%, 
                #E63946 25%, 
                #4A90E2 50%, 
                #2A9D8F 75%, 
                #F77F00 100%
            );
            background-size: 300% 300%;
            animation: gradientFlow 8s ease infinite;
        }

        .business-profile-image::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.1) 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
        }

        .business-profile-card:hover .business-profile-image::after {
            opacity: 1;
        }

        .business-profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .business-profile-card:hover .business-profile-image img {
            transform: scale(1.15);
        }

        .business-profile-placeholder {
            width: 100%;
            height: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.1rem;
            font-weight: 600;
            text-align: center;
            padding: var(--spacing-sm);
            background: linear-gradient(135deg, 
                #C97D60 0%, 
                #E63946 25%, 
                #4A90E2 50%, 
                #2A9D8F 75%, 
                #F77F00 100%
            );
            background-size: 300% 300%;
            animation: gradientFlow 8s ease infinite;
            position: relative;
        }

        .business-profile-placeholder::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at center, rgba(255, 255, 255, 0.1) 0%, transparent 70%);
        }

        .business-profile-placeholder i {
            font-size: 3.5rem;
            margin-bottom: var(--spacing-xs);
            opacity: 0.9;
        }

        .business-profile-content {
            padding: var(--spacing-md);
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .business-profile-category {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, 
                rgba(201, 125, 96, 0.15) 0%, 
                rgba(230, 57, 70, 0.12) 25%,
                rgba(74, 144, 226, 0.15) 50%,
                rgba(42, 157, 143, 0.12) 75%,
                rgba(247, 127, 0, 0.15) 100%
            );
            background-size: 200% 200%;
            animation: gradientShift 4s ease infinite;
            color: var(--color-primary);
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-size: 0.85rem;
            font-weight: 700;
            margin-bottom: var(--spacing-sm);
            width: fit-content;
            border: 2px solid rgba(201, 125, 96, 0.3);
            box-shadow: 0 2px 8px rgba(201, 125, 96, 0.15);
        }

        .business-profile-name {
            font-size: 1.5rem;
            background: linear-gradient(135deg, #C97D60 0%, #E63946 50%, #4A90E2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: var(--spacing-sm);
            font-weight: 800;
            line-height: 1.3;
        }

        .business-profile-description {
            color: var(--color-gray);
            font-size: 0.95rem;
            line-height: 1.7;
            flex-grow: 1;
            margin: 0;
            margin-bottom: var(--spacing-sm);
        }

        .business-promotions-badge {
            margin-top: auto;
            padding-top: var(--spacing-sm);
            border-top: 2px solid;
            border-image: linear-gradient(90deg, 
                rgba(201, 125, 96, 0.3) 0%, 
                rgba(230, 57, 70, 0.3) 25%,
                rgba(74, 144, 226, 0.3) 50%,
                rgba(42, 157, 143, 0.3) 75%,
                rgba(247, 127, 0, 0.3) 100%
            ) 1;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            background: linear-gradient(135deg, 
                rgba(42, 157, 143, 0.08) 0%, 
                rgba(74, 144, 226, 0.08) 100%
            );
            padding: 0.75rem;
            border-radius: 10px;
            margin-top: 0.5rem;
        }

        .business-promotions-badge i {
            color: #2A9D8F;
            font-size: 1.2rem;
            filter: drop-shadow(0 2px 4px rgba(42, 157, 143, 0.3));
        }

        .business-promotions-badge span {
            background: linear-gradient(135deg, #2A9D8F 0%, #4A90E2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            font-weight: 700;
            font-size: 0.95rem;
        }

        /* Estado vacío mejorado */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: var(--spacing-xxl);
            background: linear-gradient(135deg, 
                rgba(255, 255, 255, 0.95) 0%, 
                rgba(245, 241, 235, 0.9) 100%
            );
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(201, 125, 96, 0.15);
            border: 2px solid;
            border-image: linear-gradient(135deg, 
                rgba(201, 125, 96, 0.3) 0%, 
                rgba(74, 144, 226, 0.3) 100%
            ) 1;
        }

        .empty-state i {
            font-size: 5rem;
            background: linear-gradient(135deg, #C97D60 0%, #4A90E2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: var(--spacing-md);
            filter: drop-shadow(0 4px 8px rgba(201, 125, 96, 0.2));
        }

        .empty-state h3 {
            background: linear-gradient(135deg, #C97D60 0%, #E63946 50%, #4A90E2 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 0.5rem;
            font-size: 1.5rem;
            font-weight: 800;
        }

        .empty-state p {
            color: var(--color-gray);
            font-size: 1.1rem;
        }

        /* Paginación mejorada */
        .pagination-wrapper {
            margin-top: var(--spacing-xl);
            display: flex;
            justify-content: center;
            padding: var(--spacing-md);
        }

        /* Animaciones */
        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive */
        @media (max-width: 968px) {
            .filter-form {
                grid-template-columns: 1fr;
            }

            .businesses-hero-stats {
                gap: var(--spacing-md);
            }

            .hero-stat-number {
                font-size: 2rem;
            }
        }

        @media (max-width: 768px) {
            .business-profiles-grid {
                grid-template-columns: 1fr;
                gap: var(--spacing-sm);
            }

            .business-profile-image {
                height: 200px;
            }

            .businesses-filters-wrapper {
                margin-top: -40px;
            }

            .businesses-hero {
                padding: var(--spacing-lg) 0 var(--spacing-md);
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

    <!-- Página de Comercios -->
    <div class="businesses-page">
        <!-- Hero Section -->
        <div class="businesses-hero">
            <div class="header-image-carousel">
                <div class="carousel-container">
                    <div class="carousel-slide active" style="background-image: url('<?php echo e(asset('images/barrancabermeja/Barrancabermeja_1.jpg')); ?>');"></div>
                    <div class="carousel-slide" style="background-image: url('<?php echo e(asset('images/barrancabermeja/Barrancabermeja_2.jpg')); ?>');"></div>
                    <div class="carousel-slide" style="background-image: url('<?php echo e(asset('images/barrancabermeja/Barrancabermeja_3.jpg')); ?>');"></div>
                    <div class="carousel-slide" style="background-image: url('<?php echo e(asset('images/barrancabermeja/Barrancabermeja_4.jpg')); ?>');"></div>
                    <div class="carousel-slide" style="background-image: url('<?php echo e(asset('images/barrancabermeja/Barrancabermeja_5.jpg')); ?>');"></div>
                </div>
                
                <div class="carousel-indicators">
                    <div class="carousel-indicator active" data-slide="0"></div>
                    <div class="carousel-indicator" data-slide="1"></div>
                    <div class="carousel-indicator" data-slide="2"></div>
                    <div class="carousel-indicator" data-slide="3"></div>
                    <div class="carousel-indicator" data-slide="4"></div>
                </div>

                <div class="businesses-hero-content">
                    <h1>Nuestros Comercios</h1>
                    <p>Descubre los mejores establecimientos de Barrancabermeja y sus increíbles promociones</p>
                    <div class="businesses-hero-stats">
                        <div class="hero-stat">
                            <span class="hero-stat-number"><?php echo e($totalBusinesses ?? 0); ?></span>
                            <span class="hero-stat-label">Comercios</span>
                        </div>
                        <div class="hero-stat">
                            <span class="hero-stat-number"><?php echo e($totalCategories ?? 0); ?></span>
                            <span class="hero-stat-label">Categorías</span>
                        </div>
                        <div class="hero-stat">
                            <span class="hero-stat-number"><?php echo e($totalPromotions ?? 0); ?></span>
                            <span class="hero-stat-label">Promociones Activas</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <!-- Filtros Modernos -->
            <div class="businesses-filters-wrapper">
                <div class="businesses-filters">
                    <form method="GET" action="<?php echo e(route('businesses.index')); ?>" class="filter-form">
                        <div class="filter-group">
                            <label for="buscar">
                                <i class="fas fa-search"></i> Buscar Comercio
                            </label>
                            <input 
                                type="text" 
                                id="buscar" 
                                name="buscar" 
                                value="<?php echo e(request('buscar')); ?>" 
                                placeholder="Escribe el nombre del comercio..."
                            >
                        </div>
                        <div class="filter-group">
                            <label for="categoria">
                                <i class="fas fa-tag"></i> Categoría
                            </label>
                            <select id="categoria" name="categoria">
                                <option value="">Todas las categorías</option>
                                <?php $__currentLoopData = $categories ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($category->slug); ?>" <?php echo e(request('categoria') == $category->slug ? 'selected' : ''); ?>>
                                        <?php echo e($category->name); ?>

                                    </option>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </select>
                        </div>
                        <div class="filter-group" style="flex: 0 0 auto;">
                            <button type="submit" class="btn-filter">
                                <i class="fas fa-filter"></i> Filtrar
                            </button>
                        </div>
                        <?php if(request('buscar') || request('categoria')): ?>
                            <div class="filter-group" style="flex: 0 0 auto;">
                                <a href="<?php echo e(route('businesses.index')); ?>" class="btn-filter-clear">
                                    <i class="fas fa-times"></i> Limpiar
                                </a>
                            </div>
                        <?php endif; ?>
                    </form>
                </div>
            </div>

            <!-- Grid de Comercios -->
            <div class="businesses-content">
                <div class="business-profiles-grid">
                    <?php $__empty_1 = true; $__currentLoopData = $businesses ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $business): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <a href="<?php echo e(route('businesses.show', $business->slug)); ?>" class="business-card-link">
                            <div class="business-profile-card">
                                <div class="business-profile-image">
                                    <?php if(isset($business->logo) && $business->logo): ?>
                                        <img src="<?php echo e(asset('storage/' . $business->logo)); ?>" alt="<?php echo e($business->name ?? 'Comercio'); ?>">
                                    <?php elseif(isset($business->cover_image) && $business->cover_image): ?>
                                        <img src="<?php echo e(asset('storage/' . $business->cover_image)); ?>" alt="<?php echo e($business->name ?? 'Comercio'); ?>">
                                    <?php else: ?>
                                        <div class="business-profile-placeholder">
                                            <i class="fas fa-store"></i>
                                            <span><?php echo e($business->name ?? 'Comercio'); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="business-profile-content">
                                    <div class="business-profile-category">
                                        <i class="fas fa-tag"></i>
                                        <span><?php echo e($business->category->name ?? 'General'); ?></span>
                                    </div>
                                    <h3 class="business-profile-name"><?php echo e($business->name ?? 'Sin nombre'); ?></h3>
                                    <p class="business-profile-description">
                                        <?php echo e(\Illuminate\Support\Str::limit($business->description ?? 'Descubre este increíble comercio en Barrancabermeja.', 120)); ?>

                                    </p>
                                    <?php if($business->promotions && $business->promotions->count() > 0): ?>
                                        <div class="business-promotions-badge">
                                            <i class="fas fa-tags"></i>
                                            <span><?php echo e($business->promotions->count()); ?> <?php echo e($business->promotions->count() == 1 ? 'promoción activa' : 'promociones activas'); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <div class="empty-state">
                            <i class="fas fa-store"></i>
                            <h3>No se encontraron comercios</h3>
                            <p>Intenta ajustar los filtros de búsqueda para encontrar lo que buscas</p>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Paginación -->
                <?php if(isset($businesses) && $businesses->hasPages()): ?>
                    <div class="pagination-wrapper">
                        <?php echo e($businesses->links()); ?>

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

    <script>
        // Carrusel de Imágenes del Header
        document.addEventListener('DOMContentLoaded', function() {
            const slides = document.querySelectorAll('.carousel-slide');
            const indicators = document.querySelectorAll('.carousel-indicator');
            let currentSlide = 0;
            const totalSlides = slides.length;

            if (slides.length === 0) return;

            function showSlide(index) {
                // Remover clase active de todos los slides e indicadores
                slides.forEach(slide => slide.classList.remove('active'));
                indicators.forEach(indicator => indicator.classList.remove('active'));

                // Agregar clase active al slide e indicador actual
                if (slides[index]) {
                    slides[index].classList.add('active');
                }
                if (indicators[index]) {
                    indicators[index].classList.add('active');
                }
            }

            function nextSlide() {
                currentSlide = (currentSlide + 1) % totalSlides;
                showSlide(currentSlide);
            }

            // Event listeners para indicadores
            indicators.forEach((indicator, index) => {
                indicator.addEventListener('click', () => {
                    currentSlide = index;
                    showSlide(currentSlide);
                });
            });

            // Auto-play del carrusel (cambia cada 5 segundos)
            setInterval(nextSlide, 5000);

            // Inicializar primer slide
            showSlide(0);
        });
    </script>
</body>
</html>
<?php /**PATH C:\laragon\www\BermejaClick\resources\views/businesses.blade.php ENDPATH**/ ?>