# Usa la imagen oficial de PHP con Apache
FROM php:8.2-apache

# Instala dependencias necesarias
RUN apt-get update && apt-get install -y \
    libonig-dev \
    libzip-dev \
    unzip \
    zip \
    git \
    && docker-php-ext-install pdo_mysql mbstring zip

# Habilita el módulo de reescritura de Apache
RUN a2enmod rewrite

# Copia el código fuente
COPY . /var/www/html

# Establece la carpeta de trabajo
WORKDIR /var/www/html

# Apunta Apache al directorio public de Laravel
RUN sed -i 's|DocumentRoot /var/www/html|DocumentRoot /var/www/html/public|g' /etc/apache2/sites-available/000-default.conf

# Otorga permisos necesarios
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Expone el puerto 80
EXPOSE 80

# Arranca Apache
CMD ["apache2-foreground"]
