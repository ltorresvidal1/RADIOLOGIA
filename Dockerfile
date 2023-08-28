FROM richarvey/nginx-php-fpm
# Instala supervisor

# Instalamos las dependencias necesarias
RUN apt-get update && apt-get install -y \
   # libpq-dev \
    supervisor
    #libzip-dev \
    #libpng-dev
# Instala Composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php --install-dir=/usr/local/bin --filename=composer && \
    php -r "unlink('composer-setup.php');"

# Instala extensiones de PHP
RUN docker-php-ext-install pdo pdo_pgsql zip gd
# Copia tu código fuente al directorio de trabajo
COPY . /var/www/html

# Expone el puerto 80
EXPOSE 80

# Comando que se ejecuta al iniciar el contenedor (inicia el servicio de PHP-FPM)
CMD ["php-fpm"]