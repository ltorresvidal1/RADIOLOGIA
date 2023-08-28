# Usamos la imagen base oficial de PHP 8.1
FROM php:8.1-fpm

# Instalamos las dependencias necesarias
RUN apt-get update && apt-get install -y \
    libpq-dev \
    supervisor \
    nginx

# Instalamos las extensiones de PHP necesarias
RUN docker-php-ext-install pdo pdo_pgsql
COPY .env.example .env

# Copiamos la configuración de Nginx
COPY nginx/default.conf /etc/nginx/conf.d/default.conf

# Copiamos la configuración de Supervisor
COPY supervisor/* /etc/supervisor/conf.d/

# Copiamos los archivos de la aplicación Laravel
COPY . /var/www/html

# Instalamos las dependencias de Composer
RUN curl -sS https://getcomposer.org/installer​ | php -- \
     --install-dir=/usr/local/bin --filename=composer

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY --from=spiralscout/roadrunner:2.4.2 /usr/bin/rr /usr/bin/rr
RUN composer install
#RUN cd /var/www/html && composer install


# Asignamos los permisos adecuados
RUN chown -R www-data:www-data /var/www/html/storage

RUN php artisan cache:clear
RUN php artisan view:clear
RUN php artisan config:clear
# Puerto expuesto por Nginx
EXPOSE 80

# Iniciamos los servicios de Nginx y Supervisor
CMD service supervisor start && nginx -g 'daemon off;'
