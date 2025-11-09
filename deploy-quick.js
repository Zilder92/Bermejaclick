#!/usr/bin/env node

/**
 * Despliegue rápido - Solo archivos modificados
 * Uso: node deploy-quick.js
 */

const { execSync } = require('child_process');
const fs = require('fs');
const path = require('path');

const colors = {
    reset: '\x1b[0m',
    green: '\x1b[32m',
    yellow: '\x1b[33m',
    red: '\x1b[31m',
    cyan: '\x1b[36m'
};

function log(message, color = 'reset') {
    console.log(`${colors[color]}${message}${colors.reset}`);
}

// Verificar si hay cambios en Git
function getChangedFiles() {
    try {
        const output = execSync('git diff --name-only HEAD', { encoding: 'utf8' });
        const staged = execSync('git diff --cached --name-only', { encoding: 'utf8' });
        const all = (output + staged).split('\n').filter(f => f.trim());
        return [...new Set(all)]; // Eliminar duplicados
    } catch (error) {
        log('⚠️  No se detectó Git o no hay cambios', 'yellow');
        return [];
    }
}

// Archivos importantes que siempre subir
const importantFiles = [
    'app/',
    'resources/',
    'routes/',
    'config/',
    'database/',
    'public/'
];

async function quickDeploy() {
    log('🚀 Despliegue rápido iniciado...', 'cyan');
    
    const changedFiles = getChangedFiles();
    
    if (changedFiles.length === 0) {
        log('ℹ️  No se detectaron cambios. Usa "npm run deploy" para subir todo.', 'yellow');
        return;
    }
    
    log(`📝 Archivos modificados: ${changedFiles.length}`, 'cyan');
    changedFiles.forEach(file => log(`   - ${file}`, 'yellow'));
    
    log('\n💡 Para subir estos cambios, ejecuta:', 'cyan');
    log('   npm run deploy', 'yellow');
    log('\n   O edita deploy-config.json y ejecuta:', 'cyan');
    log('   node deploy-to-hostinger.js', 'yellow');
}

quickDeploy();

