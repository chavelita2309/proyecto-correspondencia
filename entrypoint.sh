#!/bin/bash
chmod +x ./entrypoint.sh

# Asegúrate de que las carpetas existen
mkdir -p storage/logs
mkdir -p bootstrap/cache

# Otorga permisos necesarios
chmod -R 775 storage bootstrap/cache

# Genera APP_KEY si falta
if [ ! -f .env ]; then
  cp .env.example .env
fi

if grep -q "APP_KEY=" .env && ! grep -q "base64:" .env; then
  php artisan key:generate
fi

# Enlace de storage (ignora error si ya existe)
php artisan storage:link || true

# Migraciones forzadas
php artisan migrate --force || true

# Cache de configuración, rutas y vistas
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Inicia el servidor de Laravel
php artisan serve --host=0.0.0.0 --port=${PORT}

