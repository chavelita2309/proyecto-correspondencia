#!/bin/bash

# --- Configuración inicial del script ---
# ... (Tu código existente)

# --- Preparación de directorios y permisos ---
mkdir -p storage/logs
mkdir -p bootstrap/cache
chmod -R 775 storage bootstrap/cache
chmod -R 755 public/build # Aseguramos permisos para assets

# --- Gestión del archivo .env y APP_KEY ---
# ... (Tu código existente)

# --- Enlace de storage (ignora error si ya existe) ---
php artisan storage:link || true

# --- Migraciones de base de datos ---
php artisan migrate --force || true

# --- FASE CRUCIAL: Limpieza y Cache de configuración, rutas y vistas ---
# Limpiar caché existente antes de recachear
echo "Limpiando caché de Laravel..."
php artisan config:clear
php artisan route:clear
php artisan view:clear
echo "Caché de Laravel limpia."

# Cache de configuración, rutas y vistas
echo "Optimizando caché de Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
echo "Caché de Laravel optimizada."

# --- Inicio del servidor de Laravel ---
echo "Iniciando servidor de Laravel..."
php artisan serve --host=0.0.0.0 --port=${PORT}