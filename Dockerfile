FROM php:8.2-fpm

# 1. Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# 2. Instalar Composer globalmente
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# 3. Directorio de trabajo
WORKDIR /var/www/html

# 4. Copiar archivos del proyecto (excepto vendor/)
COPY . .

# 5. Instalar dependencias de Laravel (Paso 1 que pediste)
RUN composer install --optimize-autoloader --no-interaction --no-progress

# 6. Generar APP_KEY si no existe (Paso 2 que pediste)
RUN if [ -f .env ]; then \
      php artisan config:clear; \
    else \
      cp .env.example .env && \
      php artisan key:generate --force; \
    fi

# 7. Ajustar permisos
RUN chown -R www-data:www-data /var/www/html/storage \
    && chmod -R 775 storage bootstrap/cache