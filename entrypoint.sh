#!/bin/bash

# Crea carpetas necesarias
mkdir -p storage/logs
mkdir -p bootstrap/cache

# Permisos adecuados
chmod -R 775 storage bootstrap/cache

# Optimiza Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan storage:link || true

# Inicia Laravel escuchando en Railway
php artisan serve --host=0.0.0.0 --port=${PORT}
