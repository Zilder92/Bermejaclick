<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BermejaClick.co - Tu Comercio Local en Barrancabermeja</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <nav class="navbar">
            <div class="container">
                <div class="nav-brand">
                    <h1 class="logo">Bermeja<span class="logo-accent">Click</span>.co</h1>
                </div>
                <ul class="nav-menu">
                    <li><a href="#promociones">Promociones</a></li>
                    <li><a href="#turismo">Turismo</a></li>
                    <li><a href="#hoteles">Hoteles</a></li>
                    <li><a href="#comidas">Comidas</a></li>
                    <li><a href="{{ route('businesses.index') }}">Comercios</a></li>
                    <li><a href="{{ route('login') }}" class="btn-login">Acceso Comercios</a></li>
                </ul>
                <div class="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </nav>
    </header>

    <!-- Hero Section / Banner Principal -->
    <section class="hero" style="background-image: url('{{ asset('images/fondo-portada.jpg') }}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="hero-overlay" style="background: linear-gradient(135deg, rgba(26, 26, 46, 0.85) 0%, rgba(30, 144, 255, 0.75) 100%);"></div>
        <div class="hero-content-wrapper">
            <!-- Badge de Experiencia -->
            <div class="hero-badge">
                <span>Tu Comercio Local en Barrancabermeja</span>
            </div>
            
            <!-- Título Principal -->
            <h1 class="hero-main-title">
                <span class="title-part-1">Tu Comercio en las</span>
                <span class="title-part-2">Mejores Manos</span>
            </h1>
            
            <!-- Descripción -->
            <p class="hero-description">
                Plataforma de comercio local con las mejores ofertas y promociones. 
                Descubre restaurantes, hoteles, turismo y servicios en Barrancabermeja.
            </p>
            
            <!-- Botones CTA -->
            <div class="hero-cta-buttons">
                <a href="#promociones" class="btn-hero btn-hero-primary-accent">
                    <i class="fas fa-tags"></i>
                    Ver Promociones
                </a>
                <a href="{{ route('businesses.index') }}" class="btn-hero btn-hero-secondary">
                    <i class="fas fa-store"></i>
                    Ver Comercios
                </a>
                <a href="{{ route('login') }}" class="btn-hero btn-hero-secondary">
                    <i class="fas fa-sign-in-alt"></i>
                    Acceso Comercios
                </a>
            </div>
            
            <!-- Cards de Características -->
            <div class="hero-features">
                <div class="feature-card">
                    <div class="feature-icon" style="background: linear-gradient(135deg, #4A90E2, #1E90FF);">
                        <i class="fas fa-certificate"></i>
                    </div>
                    <h3>Comercios Verificados</h3>
                </div>
                <div class="feature-card">
                    <div class="feature-icon" style="background: linear-gradient(135deg, #2A9D8F, #228B22);">
                        <i class="fas fa-clock"></i>
                    </div>
                    <h3>Ofertas Actualizadas</h3>
                </div>
                <div class="feature-card">
                    <div class="feature-icon" style="background: linear-gradient(135deg, #C97D60, #8B4513);">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3>Confianza Total</h3>
                </div>
            </div>
            
            <!-- Indicador de Scroll -->
            <div class="scroll-indicator">
                <i class="fas fa-chevron-down"></i>
            </div>
        </div>
    </section>

    <!-- Filtros Rápidos -->
    <section class="quick-filters">
        <div class="container">
            <h2 class="section-title">Explora por Categoría</h2>
            <div class="filters-grid">
                <div class="filter-card" data-category="comida">
                    <div class="filter-icon">
                        <i class="fas fa-utensils"></i>
                    </div>
                    <h3>Comida</h3>
                </div>
                <div class="filter-card" data-category="turismo">
                    <div class="filter-icon">
                        <i class="fas fa-map-marked-alt"></i>
                    </div>
                    <h3>Turismo</h3>
                </div>
                <div class="filter-card" data-category="hoteles">
                    <div class="filter-icon">
                        <i class="fas fa-hotel"></i>
                    </div>
                    <h3>Hoteles</h3>
                </div>
                <div class="filter-card" data-category="ropa">
                    <div class="filter-icon">
                        <i class="fas fa-tshirt"></i>
                    </div>
                    <h3>Ropa</h3>
                </div>
                <div class="filter-card" data-category="servicios">
                    <div class="filter-icon">
                        <i class="fas fa-tools"></i>
                    </div>
                    <h3>Servicios</h3>
                </div>
                <div class="filter-card" data-category="entretenimiento">
                    <div class="filter-icon">
                        <i class="fas fa-theater-masks"></i>
                    </div>
                    <h3>Entretenimiento</h3>
                </div>
            </div>
        </div>
    </section>

    <!-- Promociones Destacadas -->
    <section id="promociones" class="featured-promotions">
        <div class="container">
            <h2 class="section-title">Promociones Destacadas</h2>
            <div class="promotions-grid">
                @forelse($featuredPromotions ?? [] as $promo)
                    <div class="promotion-card">
                        <div class="promotion-badge">-{{ isset($promo->discount_percentage) ? $promo->discount_percentage : 0 }}%</div>
                        <div class="promotion-image">
                            @if(isset($promo->image) && $promo->image)
                                <img src="{{ asset('storage/' . $promo->image) }}" alt="{{ $promo->title ?? 'Promoción' }}">
                            @else
                                <div style="width: 100%; height: 200px; background: linear-gradient(135deg, #8B4513 0%, #1E90FF 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem; font-weight: 600;">
                                    {{ isset($promo->category) && $promo->category ? ($promo->category->name ?? 'Promoción') : 'Promoción' }}
                                </div>
                            @endif
                        </div>
                        <div class="promotion-content">
                            <h3>{{ $promo->title ?? 'Sin título' }}</h3>
                            @if(isset($promo->business) && $promo->business)
                                <p class="promotion-business" style="color: #8B4513; font-weight: 600; margin-bottom: 0.5rem; font-size: 0.95rem;">
                                    <i class="fas fa-store"></i> {{ $promo->business->name ?? 'Comercio' }}
                                </p>
                            @endif
                            <p class="promotion-description">{{ $promo->description ?? 'Sin descripción' }}</p>
                            <div class="promotion-prices">
                                <span class="price-old">${{ number_format($promo->price_regular ?? 0, 0, ',', '.') }}</span>
                                <span class="price-new">${{ number_format($promo->price_discount ?? 0, 0, ',', '.') }}</span>
                            </div>
                            <div class="promotion-meta">
                                <span class="promotion-category"><i class="fas fa-tag"></i> {{ isset($promo->category) && $promo->category ? ($promo->category->name ?? 'General') : 'General' }}</span>
                                <span class="promotion-date">Válido hasta: {{ isset($promo->end_date) && $promo->end_date ? $promo->end_date->format('d/m/Y') : 'N/A' }}</span>
                            </div>
                        </div>
                    </div>
                @empty
                    <!-- Promociones de ejemplo cuando no hay datos en BD -->
                    @php
                        $examplePromotions = [
                            ['title' => '2x1 en Hamburguesas Premium', 'desc' => 'Disfruta de nuestras hamburguesas artesanales con el mejor descuento', 'old' => 25000, 'new' => 17500, 'badge' => '-30%', 'cat' => 'Comida', 'date' => '30/12/2024', 'color' => '#8B4513'],
                            ['title' => 'Tour por el Río Magdalena', 'desc' => 'Recorrido completo por los puntos más emblemáticos de la ciudad', 'old' => 50000, 'new' => 30000, 'badge' => '-40%', 'cat' => 'Turismo', 'date' => '15/01/2025', 'color' => '#1E90FF'],
                            ['title' => 'Noche de Hotel con Desayuno', 'desc' => 'Hospedaje cómodo en el corazón de Barrancabermeja', 'old' => 120000, 'new' => 90000, 'badge' => '-25%', 'cat' => 'Hoteles', 'date' => '20/01/2025', 'color' => '#228B22'],
                            ['title' => 'Combo Familiar de Comida Rápida', 'desc' => 'Perfecto para compartir en familia con el mejor precio', 'old' => 45000, 'new' => 29250, 'badge' => '-35%', 'cat' => 'Comida', 'date' => '25/12/2024', 'color' => '#DC143C'],
                            ['title' => 'Ropa de Verano - Liquidación', 'desc' => 'Las mejores prendas para el clima de Barrancabermeja', 'old' => 80000, 'new' => 64000, 'badge' => '-20%', 'cat' => 'Ropa', 'date' => '10/01/2025', 'color' => '#FF8C00'],
                            ['title' => 'Servicio de Spa y Relajación', 'desc' => 'Momentos de bienestar y descanso con descuento especial', 'old' => 100000, 'new' => 50000, 'badge' => '-50%', 'cat' => 'Servicios', 'date' => '05/01/2025', 'color' => '#4B0082'],
                        ];
                    @endphp
                    @foreach($examplePromotions as $example)
                        <div class="promotion-card">
                            <div class="promotion-badge">{{ $example['badge'] }}</div>
                            <div class="promotion-image">
                                <div style="width: 100%; height: 200px; background: linear-gradient(135deg, {{ $example['color'] }} 0%, {{ $example['color'] }}dd 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.1rem; font-weight: 600; text-align: center; padding: 1rem;">
                                    {{ $example['title'] }}
                                </div>
                            </div>
                            <div class="promotion-content">
                                <h3>{{ $example['title'] }}</h3>
                                @php
                                    $businessNames = [
                                        '2x1 en Hamburguesas Premium' => 'Restaurante El Petrolero',
                                        'Tour por el Río Magdalena' => 'Tours del Río Magdalena',
                                        'Noche de Hotel con Desayuno' => 'Hotel Centro Barrancabermeja',
                                        'Combo Familiar de Comida Rápida' => 'Comida Rápida Express',
                                        'Ropa de Verano - Liquidación' => 'Moda Barranca',
                                        'Servicio de Spa y Relajación' => 'Spa y Relajación Barranca',
                                    ];
                                @endphp
                                <p class="promotion-business" style="color: #8B4513; font-weight: 600; margin-bottom: 0.5rem; font-size: 0.95rem;">
                                    <i class="fas fa-store"></i> {{ $businessNames[$example['title']] ?? 'Comercio Local' }}
                                </p>
                                <p class="promotion-description">{{ $example['desc'] }}</p>
                                <div class="promotion-prices">
                                    <span class="price-old">${{ number_format($example['old'], 0, ',', '.') }}</span>
                                    <span class="price-new">${{ number_format($example['new'], 0, ',', '.') }}</span>
                                </div>
                                <div class="promotion-meta">
                                    <span class="promotion-category"><i class="fas fa-tag"></i> {{ $example['cat'] }}</span>
                                    <span class="promotion-date">Válido hasta: {{ $example['date'] }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    <!-- Sección Turismo -->
    <section id="turismo" class="tourism-section">
        <div class="container">
            <h2 class="section-title">Turismo y Planes en Barrancabermeja</h2>
            <p class="section-subtitle">Descubre los lugares más emblemáticos de la ciudad del Oro Negro</p>
            <div class="tourism-grid">
                @forelse($tourismPlaces ?? [] as $place)
                    <div class="tourism-card">
                        <div class="tourism-image">
                            @if(isset($place->cover_image) && $place->cover_image)
                                <img src="{{ asset('storage/' . $place->cover_image) }}" alt="{{ $place->name ?? 'Lugar' }}">
                            @else
                                <div style="width: 100%; height: 250px; background: linear-gradient(135deg, #1E90FF 0%, #228B22 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.3rem; font-weight: 600; text-align: center; padding: 1rem;">
                                    {{ $place->name ?? 'Lugar Turístico' }}
                                </div>
                            @endif
                        </div>
                        <div class="tourism-content">
                            <h3>{{ $place->name ?? 'Sin nombre' }}</h3>
                            <p style="color: #8B4513; font-weight: 600; margin-bottom: 0.5rem; font-size: 0.95rem;">
                                <i class="fas fa-store"></i> {{ $place->name ?? 'Lugar' }}
                            </p>
                            <p>{{ $place->description ?? 'Descubre este increíble lugar en Barrancabermeja.' }}</p>
                            <a href="#" class="btn-secondary">Ver Detalles</a>
                        </div>
                    </div>
                @empty
                    @php
                        $tourismPlaces = [
                            ['name' => 'Refinería de Barrancabermeja', 'desc' => 'Conoce el corazón industrial de la ciudad y su importancia en la industria petrolera colombiana.', 'color' => '#8B4513'],
                            ['name' => 'Cristo Petrolero', 'desc' => 'Monumento icónico que representa la identidad petrolera de Barrancabermeja.', 'color' => '#1E90FF'],
                            ['name' => 'Ciénagas y Humedales', 'desc' => 'Explora la biodiversidad única de los ecosistemas acuáticos de la región.', 'color' => '#228B22'],
                            ['name' => 'Río Magdalena', 'desc' => 'Navega por el río más importante de Colombia y disfruta de paisajes únicos.', 'color' => '#FF8C00'],
                        ];
                    @endphp
                    @foreach($tourismPlaces as $place)
                        <div class="tourism-card">
                            <div class="tourism-image">
                                <div style="width: 100%; height: 250px; background: linear-gradient(135deg, {{ $place['color'] }} 0%, {{ $place['color'] }}dd 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem; font-weight: 600; text-align: center; padding: 1rem;">
                                    {{ $place['name'] }}
                                </div>
                            </div>
                            <div class="tourism-content">
                                <h3>{{ $place['name'] }}</h3>
                                <p>{{ $place['desc'] }}</p>
                                <a href="#" class="btn-secondary">Ver Detalles</a>
                            </div>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    <!-- Sección Hoteles -->
    <section id="hoteles" class="hotels-section">
        <div class="container">
            <h2 class="section-title">Hoteles y Alojamiento</h2>
            <div class="hotels-grid">
                @forelse($hotelPromotions ?? [] as $hotel)
                    <div class="hotel-card">
                        <div class="hotel-image">
                            @if($hotel->cover_image)
                                <img src="{{ asset('storage/' . $hotel->cover_image) }}" alt="{{ $hotel->name }}">
                            @else
                                <div style="width: 100%; height: 200px; background: linear-gradient(135deg, #1E90FF 0%, #228B22 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem; font-weight: 600;">
                                    {{ $hotel->name }}
                                </div>
                            @endif
                        </div>
                        <div class="hotel-content">
                            <h3>{{ $hotel->name }}</h3>
                            <p style="color: #8B4513; font-weight: 600; margin-bottom: 0.3rem; font-size: 0.95rem;">
                                <i class="fas fa-store"></i> {{ $hotel->name }}
                            </p>
                            <p class="hotel-location"><i class="fas fa-map-marker-alt"></i> {{ $hotel->address ?? 'Barrancabermeja' }}</p>
                            <div class="hotel-rating">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="{{ $i <= round($hotel->rating ?? 4) ? 'fas' : 'far' }} fa-star"></i>
                                @endfor
                            </div>
                            <div class="hotel-price">Desde ${{ number_format($hotel->rating * 20000 ?? 80000, 0, ',', '.') }}/noche</div>
                            <a href="#" class="btn-secondary">Ver Ofertas</a>
                        </div>
                    </div>
                @empty
                    @php
                        $hotels = [
                            ['name' => 'Hotel Centro', 'location' => 'Centro de Barrancabermeja', 'rating' => 4, 'price' => 80000, 'color' => '#1E90FF'],
                            ['name' => 'Hotel Río Magdalena', 'location' => 'Zona Norte', 'rating' => 5, 'price' => 120000, 'color' => '#228B22'],
                            ['name' => 'Hostal Barranca', 'location' => 'Zona Sur', 'rating' => 3, 'price' => 50000, 'color' => '#DC143C'],
                        ];
                    @endphp
                    @foreach($hotels as $hotel)
                        <div class="hotel-card">
                            <div class="hotel-image">
                                <div style="width: 100%; height: 200px; background: linear-gradient(135deg, {{ $hotel['color'] }} 0%, {{ $hotel['color'] }}dd 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.2rem; font-weight: 600;">
                                    {{ $hotel['name'] }}
                                </div>
                            </div>
                            <div class="hotel-content">
                                <h3>{{ $hotel['name'] }}</h3>
                                <p class="hotel-location"><i class="fas fa-map-marker-alt"></i> {{ $hotel['location'] }}</p>
                                <div class="hotel-rating">
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="{{ $i <= $hotel['rating'] ? 'fas' : 'far' }} fa-star"></i>
                                    @endfor
                                </div>
                                <div class="hotel-price">Desde ${{ number_format($hotel['price'], 0, ',', '.') }}/noche</div>
                                <a href="#" class="btn-secondary">Ver Ofertas</a>
                            </div>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    <!-- Sección Comidas -->
    <section id="comidas" class="food-section">
        <div class="container">
            <h2 class="section-title">Comidas en Promoción</h2>
            <div class="food-grid">
                @forelse($foodPromotions ?? [] as $food)
                    <div class="food-card">
                        @php
                            $foodDiscount = isset($food->discount_percentage) ? min($food->discount_percentage, 99) : 0;
                        @endphp
                        <div class="food-badge">-{{ $foodDiscount }}%</div>
                        <div class="food-image">
                            @if($food->image)
                                <img src="{{ asset('storage/' . $food->image) }}" alt="{{ $food->title }}">
                            @else
                                <div style="width: 100%; height: 200px; background: linear-gradient(135deg, #8B4513 0%, #DC143C 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.1rem; font-weight: 600; text-align: center; padding: 1rem;">
                                    {{ $food->business->name ?? $food->title }}
                                </div>
                            @endif
                        </div>
                        <div class="food-content">
                            <h3 style="font-size: 1.4rem; font-weight: 700; color: #1A1A1A; margin-bottom: 0.5rem;">
                                {{ $food->business->name ?? 'Restaurante' }}
                            </h3>
                            <p style="color: #666; font-size: 0.95rem; margin-bottom: 0.5rem; font-weight: 500;">{{ $food->title }}</p>
                            <div class="food-price">${{ number_format($food->price_discount, 0, ',', '.') }}</div>
                        </div>
                    </div>
                @empty
                    @php
                        $foods = [
                            ['name' => 'Restaurante El Petrolero', 'desc' => '2x1 en platos principales todos los martes', 'price' => 25000, 'badge' => '2x1', 'color' => '#8B4513'],
                            ['name' => 'Comida Rápida Express', 'desc' => 'Descuento en combos familiares', 'price' => 35000, 'badge' => '-30%', 'color' => '#DC143C'],
                            ['name' => 'Pizzería La Barranca', 'desc' => 'Pizzas grandes con descuento especial', 'price' => 28000, 'badge' => '-25%', 'color' => '#FF8C00'],
                            ['name' => 'Asados del Río', 'desc' => 'Combo especial de fin de semana', 'price' => 45000, 'badge' => 'Combo', 'color' => '#228B22'],
                        ];
                    @endphp
                    @foreach($foods as $food)
                        <div class="food-card">
                            <div class="food-badge">{{ $food['badge'] }}</div>
                            <div class="food-image">
                                <div style="width: 100%; height: 200px; background: linear-gradient(135deg, {{ $food['color'] }} 0%, {{ $food['color'] }}dd 100%); display: flex; align-items: center; justify-content: center; color: white; font-size: 1.1rem; font-weight: 600; text-align: center; padding: 1rem;">
                                    {{ $food['name'] }}
                                </div>
                            </div>
                            <div class="food-content">
                                <h3 style="font-size: 1.4rem; font-weight: 700; color: #1A1A1A; margin-bottom: 0.5rem;">
                                    {{ $food['name'] }}
                                </h3>
                                <p style="color: #666; font-size: 0.95rem; margin-bottom: 0.5rem; font-weight: 500;">{{ $food['desc'] }}</p>
                                <div class="food-price">${{ number_format($food['price'], 0, ',', '.') }}</div>
                            </div>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    <!-- Sección Influencers Barranqueños -->
    <section id="influencers" class="influencers-section">
        <div class="container">
            <h2 class="section-title">Influencers Barranqueños</h2>
            <p class="section-subtitle">Conoce a los creadores de contenido que están dando a conocer lo mejor de Barrancabermeja</p>
            <div class="influencers-grid">
                @forelse($influencers ?? [] as $influencer)
                    <div class="influencer-card">
                        <div class="influencer-header">
                            <div class="influencer-avatar">
                                @if($influencer->profile_image)
                                    <img src="{{ asset('storage/' . $influencer->profile_image) }}" alt="{{ $influencer->name }}">
                                @else
                                    <div class="avatar-placeholder" style="background: linear-gradient(135deg, #8B4513 0%, #1E90FF 100%);">
                                        <i class="fas fa-user"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="influencer-badge">
                                <span>{{ $influencer->specialty ?? 'Influencer' }}</span>
                            </div>
                        </div>
                        <div class="influencer-content">
                            <h3>{{ $influencer->name }}</h3>
                            <p class="influencer-nickname">{{ $influencer->nickname ?? '' }}</p>
                            <p class="influencer-bio">{{ Str::limit($influencer->bio ?? 'Creador de contenido local', 80) }}</p>
                            <div class="influencer-stats">
                                @php
                                    $mainFollowers = max(
                                        $influencer->instagram_followers ?? 0,
                                        $influencer->tiktok_followers ?? 0,
                                        $influencer->youtube_subscribers ?? 0
                                    );
                                    $mainPlatform = 'instagram';
                                    if (($influencer->tiktok_followers ?? 0) === $mainFollowers) {
                                        $mainPlatform = 'tiktok';
                                    } elseif (($influencer->youtube_subscribers ?? 0) === $mainFollowers) {
                                        $mainPlatform = 'youtube';
                                    }
                                @endphp
                                <div class="stat-item stat-item-main">
                                    <i class="fab fa-{{ $mainPlatform === 'tiktok' ? 'tiktok' : ($mainPlatform === 'youtube' ? 'youtube' : 'instagram') }}"></i>
                                    <span class="stat-number">{{ number_format($mainFollowers, 0, ',', '.') }}</span>
                                    <span class="stat-label">seguidores</span>
                                </div>
                            </div>
                            <div class="influencer-social">
                                @if($influencer->social_media && isset($influencer->social_media[$mainPlatform]))
                                    <a href="{{ $influencer->social_media[$mainPlatform] }}" target="_blank" class="social-link {{ $mainPlatform }}" title="{{ ucfirst($mainPlatform) }}">
                                        <i class="fab fa-{{ $mainPlatform === 'tiktok' ? 'tiktok' : ($mainPlatform === 'youtube' ? 'youtube' : 'instagram') }}"></i>
                                        Ver perfil
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    @php
                        $exampleInfluencers = [
                            ['name' => 'María González', 'nickname' => '@mariabarranca', 'specialty' => 'Comida', 'bio' => 'Influencer de comida y gastronomía local', 'instagram' => 12500, 'tiktok' => 8500, 'youtube' => 3200, 'color' => '#8B4513'],
                            ['name' => 'Carlos Ramírez', 'nickname' => '@carlosbarranca_travel', 'specialty' => 'Turismo', 'bio' => 'Explorador de los rincones más hermosos', 'instagram' => 18900, 'tiktok' => 12000, 'youtube' => 5600, 'color' => '#1E90FF'],
                            ['name' => 'Ana Martínez', 'nickname' => '@anabarranca_style', 'specialty' => 'Moda', 'bio' => 'Fashionista local y tendencias', 'instagram' => 9800, 'tiktok' => 15200, 'youtube' => 2100, 'color' => '#DC143C'],
                        ];
                    @endphp
                    @foreach($exampleInfluencers as $inf)
                        <div class="influencer-card">
                            <div class="influencer-header">
                                <div class="influencer-avatar">
                                    <div class="avatar-placeholder" style="background: linear-gradient(135deg, {{ $inf['color'] }} 0%, {{ $inf['color'] }}dd 100%);">
                                        <i class="fas fa-user"></i>
                                    </div>
                                </div>
                                <div class="influencer-badge">
                                    <span>{{ $inf['specialty'] }}</span>
                                </div>
                            </div>
                            <div class="influencer-content">
                                <h3>{{ $inf['name'] }}</h3>
                                <p class="influencer-nickname">{{ $inf['nickname'] }}</p>
                                <p class="influencer-bio">{{ $inf['bio'] }}</p>
                                @php
                                    $mainFollowers = max($inf['instagram'], $inf['tiktok'], $inf['youtube']);
                                    $mainPlatform = 'instagram';
                                    if ($inf['tiktok'] === $mainFollowers) {
                                        $mainPlatform = 'tiktok';
                                    } elseif ($inf['youtube'] === $mainFollowers) {
                                        $mainPlatform = 'youtube';
                                    }
                                @endphp
                                <div class="influencer-stats">
                                    <div class="stat-item stat-item-main">
                                        <i class="fab fa-{{ $mainPlatform === 'tiktok' ? 'tiktok' : ($mainPlatform === 'youtube' ? 'youtube' : 'instagram') }}"></i>
                                        <span class="stat-number">{{ number_format($mainFollowers, 0, ',', '.') }}</span>
                                        <span class="stat-label">seguidores</span>
                                    </div>
                                </div>
                                <div class="influencer-social">
                                    <a href="#" class="social-link {{ $mainPlatform }}" title="{{ ucfirst($mainPlatform) }}">
                                        <i class="fab fa-{{ $mainPlatform === 'tiktok' ? 'tiktok' : ($mainPlatform === 'youtube' ? 'youtube' : 'instagram') }}"></i>
                                        Ver perfil
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @endforelse
            </div>
        </div>
    </section>

    <!-- CTA para Comercios -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2>Explora Nuestros Comercios</h2>
                <p>Descubre los mejores establecimientos de Barrancabermeja. Conoce sus perfiles, servicios y promociones activas.</p>
                <div style="display: flex; gap: 1rem; justify-content: center; flex-wrap: wrap; margin-top: 1.5rem;">
                    <a href="{{ route('businesses.index') }}" class="btn-cta" style="background: var(--color-secondary);">
                        <i class="fas fa-store"></i> Ver Todos los Comercios
                    </a>
                    <a href="{{ route('login') }}" class="btn-cta" style="background: transparent; border: 2px solid white;">
                        <i class="fas fa-sign-in-alt"></i> Acceso para Comercios
                    </a>
                </div>
            </div>
        </div>
    </section>

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
                        <li><a href="#promociones">Promociones</a></li>
                        <li><a href="#turismo">Turismo</a></li>
                        <li><a href="#hoteles">Hoteles</a></li>
                        <li><a href="#comidas">Comidas</a></li>
                        <li><a href="{{ route('businesses.index') }}">Comercios</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Para Comercios</h4>
                    <ul>
                        <li><a href="{{ route('login') }}">Acceso Dashboard</a></li>
                        <li><a href="{{ route('login') }}">Acceso Comercios</a></li>
                        <li><a href="#">Planes y Precios</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Contacto</h4>
                    <ul>
                        <li><i class="fas fa-envelope"></i> info@bermejaclick.co</li>
                        <li><i class="fas fa-phone"></i> +57 XXX XXX XXXX</li>
                        <li><i class="fas fa-map-marker-alt"></i> Barrancabermeja, Colombia</li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} BermejaClick.co - Todos los derechos reservados</p>
            </div>
        </div>
    </footer>

    <script src="{{ asset('js/main.js') }}"></script>
</body>
</html>

