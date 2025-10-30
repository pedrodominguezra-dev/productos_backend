FROM php:8.2-fpm

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    libssl-dev

# Limpiar cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Instalar extensiones de PHP
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install pdo pdo_mysql mbstring exif pcntl bcmath gd zip

# Configurar PHP-FPM para escuchar en el puerto correcto
RUN echo "listen = 0.0.0.0:9000" >> /usr/local/etc/php-fpm.d/zz-docker.conf \
    && echo "listen.owner = www-data" >> /usr/local/etc/php-fpm.d/zz-docker.conf \
    && echo "listen.group = www-data" >> /usr/local/etc/php-fpm.d/zz-docker.conf \
    && echo "pm.max_children = 10" >> /usr/local/etc/php-fpm.d/zz-docker.conf \
    && echo "pm.start_servers = 2" >> /usr/local/etc/php-fpm.d/zz-docker.conf \
    && echo "pm.min_spare_servers = 1" >> /usr/local/etc/php-fpm.d/zz-docker.conf \
    && echo "pm.max_spare_servers = 3" >> /usr/local/etc/php-fpm.d/zz-docker.conf


# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Instalar Redis extension
RUN pecl install redis && docker-php-ext-enable redis

# Crear usuario para la aplicación
RUN groupadd -g 1000 www
RUN useradd -u 1000 -ms /bin/bash -g www www

# Copiar el contenido de la aplicación
COPY ./ /var/www/html

# Copiar el directorio de la aplicación y cambiar propietario
COPY --chown=www:www . /var/www/html

# Cambiar al usuario www
USER www

# Exponer el puerto 9000
EXPOSE 9000

CMD ["php-fpm"]