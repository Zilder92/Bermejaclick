<?php
/**
 * Script para agregar APP_KEY al archivo .env
 * Ejecutar: php fix_env_key.php
 */

$envFile = __DIR__ . '/.env';

// Verificar si existe .env
if (!file_exists($envFile)) {
    echo "ERROR: El archivo .env no existe.\n";
    echo "Por favor, crea el archivo .env copiando desde .env.example\n";
    exit(1);
}

// Leer el contenido
$content = file_get_contents($envFile);

// Verificar si ya tiene APP_KEY con valor
if (preg_match('/^APP_KEY=base64:.+$/m', $content)) {
    echo "APP_KEY ya está configurada en el archivo .env\n";
    exit(0);
}

// Generar nueva clave
$key = 'base64:' . base64_encode(random_bytes(32));

// Reemplazar o agregar APP_KEY
if (preg_match('/^APP_KEY=.*$/m', $content)) {
    // Reemplazar línea existente
    $content = preg_replace('/^APP_KEY=.*$/m', 'APP_KEY=' . $key, $content);
    echo "APP_KEY actualizada en el archivo .env\n";
} else {
    // Agregar después de APP_NAME
    if (preg_match('/^APP_NAME=.*$/m', $content)) {
        $content = preg_replace('/^(APP_NAME=.*)$/m', '$1' . "\nAPP_KEY=" . $key, $content);
        echo "APP_KEY agregada al archivo .env\n";
    } else {
        // Agregar al inicio
        $content = "APP_KEY=" . $key . "\n" . $content;
        echo "APP_KEY agregada al inicio del archivo .env\n";
    }
}

// Guardar
file_put_contents($envFile, $content);

echo "Clave generada: " . $key . "\n";
echo "¡Configuración completada!\n";
echo "Ahora ejecuta: php artisan config:clear\n";

