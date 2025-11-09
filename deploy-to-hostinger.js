#!/usr/bin/env node

/**
 * Script de despliegue automático a Hostinger
 * Uso: node deploy-to-hostinger.js
 * 
 * Requiere: npm install -g ftp-sync
 * O usar: npm install ftp
 */

const ftp = require('basic-ftp');
const fs = require('fs');
const path = require('path');
const { execSync } = require('child_process');

// Colores para consola
const colors = {
    reset: '\x1b[0m',
    green: '\x1b[32m',
    yellow: '\x1b[33m',
    red: '\x1b[31m',
    blue: '\x1b[34m',
    cyan: '\x1b[36m'
};

function log(message, color = 'reset') {
    console.log(`${colors[color]}${message}${colors.reset}`);
}

// Cargar configuración
let config;
try {
    config = JSON.parse(fs.readFileSync('deploy-config.json', 'utf8'));
} catch (error) {
    log('❌ Error: No se encontró deploy-config.json', 'red');
    log('📝 Crea el archivo deploy-config.json con tu configuración de Hostinger', 'yellow');
    process.exit(1);
}

// Archivos y carpetas a excluir
const excludePatterns = [
    '.git',
    '.gitignore',
    'node_modules',
    'vendor',
    '.env',
    '.env.backup',
    '.env.production',
    'storage/logs/*.log',
    'storage/framework/cache/*',
    'storage/framework/sessions/*',
    'storage/framework/views/*',
    '.phpunit.result.cache',
    'deploy-config.json',
    'deploy-to-hostinger.js',
    'package.json',
    'package-lock.json',
    'composer.json',
    'composer.lock',
    '.idea',
    '.vscode',
    '.fleet',
    'README.md',
    'DEPLOY_HOSTINGER.md',
    'CONFIGURAR_MCP.md'
];

function shouldExclude(filePath) {
    return excludePatterns.some(pattern => {
        if (pattern.includes('*')) {
            const regex = new RegExp(pattern.replace(/\*/g, '.*'));
            return regex.test(filePath);
        }
        return filePath.includes(pattern);
    });
}

async function deploy() {
    const client = new ftp.Client();
    client.ftp.verbose = config.verbose || false;

    try {
        log('🚀 Iniciando despliegue a Hostinger...', 'cyan');
        log(`📡 Conectando a ${config.host}...`, 'yellow');

        // Conectar
        await client.access({
            host: config.host,
            user: config.user,
            password: config.password,
            secure: config.secure || false,
            port: config.port || 21
        });

        log('✅ Conectado exitosamente!', 'green');

        // Cambiar al directorio remoto
        if (config.remotePath) {
            await client.cd(config.remotePath);
            log(`📁 Directorio remoto: ${config.remotePath}`, 'blue');
        }

        // Optimizar Laravel antes de subir
        log('⚙️  Optimizando Laravel...', 'yellow');
        try {
            execSync('php artisan config:cache', { stdio: 'ignore' });
            execSync('php artisan route:cache', { stdio: 'ignore' });
            execSync('php artisan view:cache', { stdio: 'ignore' });
            log('✅ Laravel optimizado', 'green');
        } catch (error) {
            log('⚠️  No se pudo optimizar (puede ser normal en desarrollo)', 'yellow');
        }

        // Función recursiva para subir archivos
        async function uploadDirectory(localDir, remoteDir = '') {
            const files = fs.readdirSync(localDir);

            for (const file of files) {
                const localPath = path.join(localDir, file);
                const remotePath = remoteDir ? `${remoteDir}/${file}` : file;
                const relativePath = path.relative(process.cwd(), localPath).replace(/\\/g, '/');

                if (shouldExclude(relativePath)) {
                    log(`⏭️  Omitiendo: ${relativePath}`, 'yellow');
                    continue;
                }

                const stat = fs.statSync(localPath);

                if (stat.isDirectory()) {
                    log(`📁 Creando directorio: ${remotePath}`, 'blue');
                    try {
                        await client.ensureDir(remotePath);
                    } catch (error) {
                        // El directorio puede ya existir
                    }
                    await uploadDirectory(localPath, remotePath);
                } else {
                    log(`📤 Subiendo: ${relativePath}`, 'cyan');
                    await client.uploadFrom(localPath, remotePath);
                }
            }
        }

        // Subir archivos
        log('📤 Subiendo archivos...', 'yellow');
        await uploadDirectory('.');

        // Subir contenido de public/ a public_html/
        if (fs.existsSync('public')) {
            log('📤 Subiendo archivos públicos...', 'yellow');
            await client.ensureDir('public_html');
            const publicFiles = fs.readdirSync('public');
            
            for (const file of publicFiles) {
                const localPath = path.join('public', file);
                const remotePath = `public_html/${file}`;
                
                if (shouldExclude(`public/${file}`)) continue;
                
                const stat = fs.statSync(localPath);
                if (stat.isDirectory()) {
                    await client.ensureDir(remotePath);
                    // Subir contenido del directorio
                    const subFiles = fs.readdirSync(localPath);
                    for (const subFile of subFiles) {
                        const subLocalPath = path.join(localPath, subFile);
                        const subRemotePath = `${remotePath}/${subFile}`;
                        if (fs.statSync(subLocalPath).isFile()) {
                            await client.uploadFrom(subLocalPath, subRemotePath);
                        }
                    }
                } else {
                    await client.uploadFrom(localPath, remotePath);
                }
            }
        }

        log('✅ Despliegue completado exitosamente!', 'green');
        log(`🌐 Visita: ${config.url || 'tu-dominio.com'}`, 'cyan');

    } catch (error) {
        log(`❌ Error durante el despliegue: ${error.message}`, 'red');
        console.error(error);
        process.exit(1);
    } finally {
        client.close();
    }
}

// Ejecutar
deploy();

