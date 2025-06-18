#!/bin/bash

# --- Configuración inicial del script ---
# Ya no es necesario chmod +x entrypoint.sh aquí si Railway ya lo hace al ejecutarlo.

# --- Preparación de directorios y permisos ---
mkdir -p storage/logs
mkdir -p bootstrap/cache
chmod -R 775 storage bootstrap/cache

# *** NUEVA LÍNEA AÑADIDA AQUÍ ***
# Otorga permisos de lectura y ejecución a la carpeta de assets compilados
# Esto es CRUCIAL para que el servidor web de Railway pueda servir los archivos CSS/JS
chmod -R 755 public/build

# --- Gestión del archivo .env y APP_KEY ---
if [ ! -f .env ]; then
  cp .env.example .env
fi

if grep -q "APP_KEY=" .env && ! grep -q "base64:" .env; then
  php artisan key:generate
fi

# --- Enlace de storage (ignora error si ya existe) ---
php artisan storage:link || true

# --- Migraciones de base de datos ---
php artisan migrate --force || true

# --- Cache de configuración, rutas y vistas de Laravel ---
php artisan config:cache
php artisan route:cache
php artisan view:cache

# --- Inicio del servidor de Laravel ---
php artisan serve --host=0.0.0.0 --port=${PORT}
