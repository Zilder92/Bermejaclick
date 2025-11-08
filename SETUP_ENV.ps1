# Script para configurar el archivo .env
# Ejecutar: .\SETUP_ENV.ps1

$envFile = ".env"

# Verificar si existe .env
if (-not (Test-Path $envFile)) {
    Write-Host "Creando archivo .env desde .env.example..." -ForegroundColor Yellow
    if (Test-Path ".env.example") {
        Copy-Item ".env.example" $envFile
    } else {
        Write-Host "ERROR: No se encuentra .env.example" -ForegroundColor Red
        exit 1
    }
}

# Generar APP_KEY
Write-Host "Generando APP_KEY..." -ForegroundColor Yellow
$key = php artisan key:generate --show 2>&1 | Select-Object -Last 1

if ($key -match "base64:") {
    Write-Host "APP_KEY generada: $key" -ForegroundColor Green
    
    # Leer el contenido actual
    $content = Get-Content $envFile -Raw
    
    # Reemplazar o agregar APP_KEY
    if ($content -match "APP_KEY=") {
        $content = $content -replace "APP_KEY=.*", "APP_KEY=$key"
    } else {
        # Agregar después de APP_NAME
        $content = $content -replace "(APP_NAME=.*)", "`$1`nAPP_KEY=$key"
    }
    
    # Guardar
    Set-Content -Path $envFile -Value $content -NoNewline
    Write-Host "APP_KEY agregada al archivo .env" -ForegroundColor Green
} else {
    Write-Host "ERROR: No se pudo generar la clave" -ForegroundColor Red
    Write-Host "Por favor, ejecuta manualmente: php artisan key:generate" -ForegroundColor Yellow
}

Write-Host "`nConfiguración completada!" -ForegroundColor Green
Write-Host "Verifica que el archivo .env tenga la configuración correcta de base de datos." -ForegroundColor Yellow

