# Usamos la imagen base oficial de PHP 8.1
FROM php:8.1-fpm


# Instalamos las dependencias de Composer
RUN curl -sS https://getcomposer.org/installer​ | php -- \
     --install-dir=/usr/local/bin --filename=composer

# Instalamos las dependencias necesarias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    supervisor \
    nginx
    
# Copiamos los archivos de la aplicación Laravel
COPY . /var/www/html
# Instalamos las extensiones de PHP necesarias
RUN rm -rf /vendor
RUN rm -rf /composer.lock

RUN composer install
RUN docker-php-ext-install pdo pdo_pgsql
COPY .env.example .env

RUN php artisan cache:clear
RUN php artisan view:clear
RUN php artisan config:clear


# Copiamos la configuración de Nginx
COPY nginx/default.conf /etc/nginx/conf.d/default.conf

# Copiamos la configuración de Supervisor
COPY supervisor/* /etc/supervisor/conf.d/






# Asignamos los permisos adecuados
RUN chown -R www-data:www-data /var/www/html/storage

# Puerto expuesto por Nginx
EXPOSE 80

# Iniciamos los servicios de Nginx y Supervisor
CMD service supervisor start && nginx -g 'daemon off;'
