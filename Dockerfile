# Usa la imagen oficial de PHP con Apache y extensiones necesarias
FROM php:8.2-apache

# Instala dependencias y extensiones necesarias para Laravel
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    unzip \
    zip \
    git \
    && docker-php-ext-install pdo_mysql mbstring zip

# Habilita el módulo de reescritura de Apache
RUN a2enmod rewrite

# Copia el código al contenedor
COPY . /var/www/html

# Establece permisos correctos para Laravel (puede necesitar ajustes)
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expone el puerto 80
EXPOSE 80

# Comando por defecto para arrancar Apache
CMD ["apache2-foreground"]
