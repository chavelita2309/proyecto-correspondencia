#!/bin/bash

# --- Configuración inicial del script ---
chmod +x ./entrypoint.sh # Asegura que el propio script sea ejecutable

# --- Preparación de directorios y permisos ---
mkdir -p storage/logs # Asegura que la carpeta de logs exista
mkdir -p bootstrap/cache # Asegura que la carpeta de caché exista
chmod -R 775 storage bootstrap/cache # Otorga permisos necesarios

# --- Gestión del archivo .env y APP_KEY ---
# Copia .env.example si .env no existe
if [ ! -f .env ]; then
  cp .env.example .env
fi

# Genera APP_KEY si falta o no está en formato base64
if grep -q "APP_KEY=" .env && ! grep -q "base64:" .env; then
  php artisan key:generate
fi

# --- Enlace de storage (ignora error si ya existe) ---
php artisan storage:link || true

# --- FASE CRUCIAL: Instalación y Compilación de Frontend (Node.js/Vite/Tailwind) ---
echo "Instalando dependencias de Node.js..."
npm install # Instala Vite y todas las dependencias de Node.js
echo "Dependencias de Node.js instaladas."

echo "Compilando assets de frontend con Vite..."
npm run build # Ejecuta el comando de compilación de Vite/Tailwind
echo "Assets de frontend compilados."
# --- FIN FASE FRONTEND ---

# --- Migraciones de base de datos ---
echo "Ejecutando migraciones de base de datos..."
php artisan migrate --force || true # Migraciones forzadas
echo "Migraciones completadas."

# --- Cache de configuración, rutas y vistas de Laravel ---
echo "Optimizando caché de Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
echo "Caché de Laravel optimizada."

# --- Inicio del servidor de Laravel ---
echo "Iniciando servidor de Laravel..."
php artisan serve --host=0.0.0.0 --port=${PORT} # Inicia el servidor de Laravel
