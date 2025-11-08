// ============================================
// DASHBOARD - JavaScript
// Panel de Autogestión para Comercios
// ============================================

// Estado de la aplicación
let isLoggedIn = false;

// ============================================
// INICIALIZACIÓN
// ============================================

document.addEventListener('DOMContentLoaded', function() {
    // La autenticación se maneja en el servidor, no es necesario verificar sesión del cliente
    // checkSession(); // Comentado - ya no necesario
    
    // Inicializar formularios (solo si existen)
    // initLoginForm(); // Comentado - login se maneja en el servidor
    // initRegisterForm(); // Comentado - registro se maneja en el servidor
    initPromotionForm();
    initImageUpload();
    
    // Inicializar navegación
    initNavigation();
    
    // Configurar fecha mínima para fechas de promoción
    setMinDate();
});

// ============================================
// GESTIÓN DE SESIÓN
// ============================================
// NOTA: La autenticación ahora se maneja en el servidor con Laravel
// Estas funciones se mantienen solo para compatibilidad si existen los elementos

function checkSession() {
    // Ya no es necesario verificar sesión del lado del cliente
    // La sesión se maneja en el servidor
    // Esta función se mantiene para evitar errores pero no hace nada
}

function showLogin() {
    // Función obsoleta - la autenticación se maneja en el servidor
    // Solo ejecutar si el elemento existe
    const loginModal = document.getElementById('loginModal');
    if (loginModal) {
        loginModal.style.display = 'flex';
    }
    const registerModal = document.getElementById('registerModal');
    if (registerModal) {
        registerModal.style.display = 'none';
    }
    const dashboardContainer = document.getElementById('dashboardContainer');
    if (dashboardContainer) {
        dashboardContainer.style.display = 'none';
    }
}

function showRegister() {
    // Función obsoleta - la autenticación se maneja en el servidor
    const loginModal = document.getElementById('loginModal');
    if (loginModal) {
        loginModal.style.display = 'none';
    }
    const registerModal = document.getElementById('registerModal');
    if (registerModal) {
        registerModal.style.display = 'flex';
    }
}

function showDashboard() {
    // Función obsoleta - la autenticación se maneja en el servidor
    const loginModal = document.getElementById('loginModal');
    if (loginModal) {
        loginModal.style.display = 'none';
    }
    const registerModal = document.getElementById('registerModal');
    if (registerModal) {
        registerModal.style.display = 'none';
    }
    const dashboardContainer = document.getElementById('dashboardContainer');
    if (dashboardContainer) {
        dashboardContainer.style.display = 'flex';
        // Mostrar página de dashboard por defecto
        navigateTo('dashboard');
    }
}

function logout() {
    // El logout ahora se maneja en el servidor
    // Redirigir al endpoint de logout de Laravel
    if (confirm('¿Estás seguro de que deseas cerrar sesión?')) {
        window.location.href = '/logout';
    }
}

// ============================================
// FORMULARIOS DE AUTENTICACIÓN
// ============================================

function initLoginForm() {
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            
            // Simulación de login (en producción esto sería una llamada al servidor)
            if (email && password) {
                // Guardar sesión
                localStorage.setItem('bermejaclick_session', JSON.stringify({
                    email: email,
                    name: 'Comercio Ejemplo',
                    loginTime: new Date().toISOString()
                }));
                
                isLoggedIn = true;
                showDashboard();
                
                // Actualizar nombre de usuario
                const userName = document.getElementById('userName');
                if (userName) {
                    userName.textContent = 'Comercio Ejemplo';
                }
            } else {
                alert('Por favor, completa todos los campos');
            }
        });
    }
}

function initRegisterForm() {
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const name = document.getElementById('reg-name').value;
            const email = document.getElementById('reg-email').value;
            const phone = document.getElementById('reg-phone').value;
            const password = document.getElementById('reg-password').value;
            const confirm = document.getElementById('reg-confirm').value;
            
            // Validaciones
            if (!name || !email || !phone || !password || !confirm) {
                alert('Por favor, completa todos los campos');
                return;
            }
            
            if (password !== confirm) {
                alert('Las contraseñas no coinciden');
                return;
            }
            
            if (password.length < 6) {
                alert('La contraseña debe tener al menos 6 caracteres');
                return;
            }
            
            // Simulación de registro (en producción esto sería una llamada al servidor)
            alert('¡Registro exitoso! Ahora puedes iniciar sesión.');
            showLogin();
            
            // Limpiar formulario
            registerForm.reset();
        });
    }
}

// ============================================
// NAVEGACIÓN DEL DASHBOARD
// ============================================

function initNavigation() {
    const navItems = document.querySelectorAll('.nav-item');
    
    navItems.forEach(item => {
        item.addEventListener('click', function() {
            const page = this.getAttribute('data-page');
            navigateTo(page);
        });
    });
}

function navigateTo(page) {
    // Ocultar todas las páginas
    const pages = document.querySelectorAll('.page-content');
    pages.forEach(p => p.classList.remove('active'));
    
    // Mostrar la página seleccionada
    const targetPage = document.getElementById(`page-${page}`);
    if (targetPage) {
        targetPage.classList.add('active');
    }
    
    // Actualizar navegación activa
    const navItems = document.querySelectorAll('.nav-item');
    navItems.forEach(item => {
        item.classList.remove('active');
        if (item.getAttribute('data-page') === page) {
            item.classList.add('active');
        }
    });
    
    // Actualizar título de la página
    const pageTitle = document.getElementById('pageTitle');
    if (pageTitle) {
        const titles = {
            'dashboard': 'Dashboard',
            'profile': 'Mi Perfil',
            'new-promotion': 'Publicar Oferta',
            'promotions': 'Mis Promociones',
            'statistics': 'Estadísticas',
            'payments': 'Historial de Pagos'
        };
        pageTitle.textContent = titles[page] || 'Dashboard';
    }
}

// ============================================
// FORMULARIO DE PROMOCIÓN
// ============================================

function initPromotionForm() {
    const promotionForm = document.getElementById('newPromotionForm');
    if (promotionForm) {
        promotionForm.addEventListener('submit', function(e) {
            // No prevenir el submit por defecto - dejar que Laravel maneje el formulario
            // Solo validaciones básicas del lado del cliente
            
            const title = document.getElementById('promo-title').value;
            const description = document.getElementById('promo-description').value;
            const priceRegular = document.getElementById('promo-price-regular').value;
            const priceDiscount = document.getElementById('promo-price-discount').value;
            const startDate = document.getElementById('promo-start-date').value;
            const endDate = document.getElementById('promo-end-date').value;
            const category = document.getElementById('promo-category').value;
            const image = document.getElementById('promo-image').files[0];
            
            // Validaciones básicas del lado del cliente
            if (!title || !description || !priceRegular || 
                !priceDiscount || !startDate || !endDate || 
                !category || !image) {
                e.preventDefault();
                alert('Por favor, completa todos los campos');
                return false;
            }
            
            // Validar fechas
            const start = new Date(startDate + 'T00:00:00');
            const end = new Date(endDate + 'T00:00:00');
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            
            // Comparar solo las fechas (sin horas)
            const startDateOnly = new Date(start.getFullYear(), start.getMonth(), start.getDate());
            const todayOnly = new Date(today.getFullYear(), today.getMonth(), today.getDate());
            
            if (startDateOnly < todayOnly) {
                e.preventDefault();
                const todayFormatted = today.toLocaleDateString('es-ES', { day: '2-digit', month: '2-digit', year: 'numeric' });
                alert('La fecha de inicio no puede ser anterior a hoy (' + todayFormatted + ')');
                return false;
            }
            
            if (end <= start) {
                e.preventDefault();
                alert('La fecha de fin debe ser posterior a la fecha de inicio');
                return false;
            }
            
            // Validar precios
            if (parseFloat(priceDiscount) >= parseFloat(priceRegular)) {
                e.preventDefault();
                alert('El precio con descuento debe ser menor al precio regular');
                return false;
            }
            
            // Validar imagen
            if (image) {
                const maxSize = 5 * 1024 * 1024; // 5MB
                if (image.size > maxSize) {
                    e.preventDefault();
                    alert('La imagen no debe superar los 5MB');
                    return false;
                }
                
                const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/gif'];
                if (!validTypes.includes(image.type)) {
                    e.preventDefault();
                    alert('Por favor, selecciona una imagen válida (JPG, PNG o GIF)');
                    return false;
                }
            }
            
            // Si pasa todas las validaciones, el formulario se enviará normalmente
            // Mostrar mensaje de carga
            const submitButton = promotionForm.querySelector('button[type="submit"]');
            if (submitButton) {
                submitButton.disabled = true;
                submitButton.textContent = 'Publicando...';
            }
        });
    }
}

function resetForm() {
    const form = document.getElementById('newPromotionForm');
    if (form) {
        form.reset();
        resetImagePreview();
    }
}

// ============================================
// SUBIDA DE IMÁGENES
// ============================================

function initImageUpload() {
    const imageInput = document.getElementById('promo-image');
    const imagePreview = document.getElementById('imagePreview');
    
    if (imageInput && imagePreview) {
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                // Validar tipo de archivo
                if (!file.type.startsWith('image/')) {
                    alert('Por favor, selecciona un archivo de imagen');
                    return;
                }
                
                // Validar tamaño (máximo 5MB)
                if (file.size > 5 * 1024 * 1024) {
                    alert('La imagen no debe superar los 5MB');
                    return;
                }
                
                // Mostrar preview
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.innerHTML = `<img src="${e.target.result}" alt="Preview">`;
                };
                reader.readAsDataURL(file);
            }
        });
        
        // Permitir hacer clic en el área de preview para seleccionar archivo
        imagePreview.addEventListener('click', function() {
            imageInput.click();
        });
    }
}

function resetImagePreview() {
    const imagePreview = document.getElementById('imagePreview');
    if (imagePreview) {
        imagePreview.innerHTML = `
            <i class="fas fa-cloud-upload-alt"></i>
            <p>Haz clic para subir una imagen de alta calidad</p>
        `;
    }
}

// ============================================
// CONFIGURACIÓN DE FECHAS
// ============================================

function setMinDate() {
    const today = new Date().toISOString().split('T')[0];
    const startDateInput = document.getElementById('promo-start-date');
    const endDateInput = document.getElementById('promo-end-date');
    
    if (startDateInput) {
        startDateInput.setAttribute('min', today);
        startDateInput.addEventListener('change', function() {
            if (endDateInput) {
                endDateInput.setAttribute('min', this.value);
            }
        });
    }
}

// ============================================
// MODALES
// ============================================

function closeModal(modalId) {
    document.getElementById(modalId).style.display = 'none';
}

// Cerrar modal al hacer clic fuera (solo si los modales existen)
window.addEventListener('click', function(e) {
    const loginModal = document.getElementById('loginModal');
    const registerModal = document.getElementById('registerModal');
    
    if (loginModal && e.target === loginModal) {
        loginModal.style.display = 'none';
    }
    if (registerModal && e.target === registerModal) {
        registerModal.style.display = 'none';
    }
});

// ============================================
// FUNCIONES AUXILIARES
// ============================================

// Formatear números como moneda
function formatCurrency(amount) {
    return new Intl.NumberFormat('es-CO', {
        style: 'currency',
        currency: 'COP',
        minimumFractionDigits: 0
    }).format(amount);
}

// Formatear fechas
function formatDate(dateString) {
    const date = new Date(dateString);
    return date.toLocaleDateString('es-CO', {
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    });
}

