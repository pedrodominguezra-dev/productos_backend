FROM php:8.3-fpm

# Instalar extensiones
RUN apt-get update && apt-get install -y \
    git unzip libzip-dev libonig-dev libpng-dev libjpeg-dev libxml2-dev \
    curl zip sudo procps \
  && docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip \
  && pecl install xdebug-3.2.2 || true \
  && docker-php-ext-enable xdebug

# Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# Copiar composer.json y lock
COPY composer.json composer.lock ./
RUN composer install --no-interaction --no-plugins --no-scripts --prefer-dist

# Copiar el resto del código
COPY . .

# Ejecutar composer
RUN composer dump-autoload -o

# Ajusta los permisos
RUN chown -R www-data:www-data /var/www/html \
  && chmod -R 755 /var/www/html/storage /var/www/html/bootstrap/cache

EXPOSE 9000
CMD ["php-fpm"]
