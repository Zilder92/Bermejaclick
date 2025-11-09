#!/bin/bash

# Script de despliegue para Hostinger
# Ejecutar: bash deploy-hostinger.sh

echo "🚀 Iniciando despliegue para Hostinger..."

# Colores para output
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
RED='\033[0;31m'
NC='\033[0m' # No Color

# 1. Limpiar cachés
echo -e "${YELLOW}Limpiando cachés...${NC}"
php artisan config:clear
php artisan cache:clear
php artisan route:clear
php artisan view:clear

# 2. Optimizar para producción
echo -e "${YELLOW}Optimizando para producción...${NC}"
php artisan config:cache
php artisan route:cache
php artisan view:cache

# 3. Verificar que APP_KEY existe
if ! grep -q "APP_KEY=base64:" .env 2>/dev/null; then
    echo -e "${YELLOW}Generando APP_KEY...${NC}"
    php artisan key:generate
fi

# 4. Instalar dependencias de producción
echo -e "${YELLOW}Instalando dependencias de producción...${NC}"
composer install --no-dev --optimize-autoloader

# 5. Verificar permisos
echo -e "${YELLOW}Verificando permisos...${NC}"
chmod -R 775 storage bootstrap/cache

# 6. Crear enlace simbólico de storage
echo -e "${YELLOW}Creando enlace simbólico de storage...${NC}"
php artisan storage:link

# 7. Optimizar autoloader
echo -e "${YELLOW}Optimizando autoloader...${NC}"
composer dump-autoload --optimize

echo -e "${GREEN}✅ Despliegue completado!${NC}"
echo -e "${YELLOW}Recuerda:${NC}"
echo "1. Subir archivos al servidor"
echo "2. Configurar .env en el servidor"
echo "3. Ejecutar migraciones: php artisan migrate --force"
echo "4. Verificar permisos de storage y bootstrap/cache"

