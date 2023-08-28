# Utiliza una imagen base de PHP 8 con FPM
FROM php:8.1-fpm

# Instala las dependencias necesarias
RUN apt-get update && apt-get install -y \
    nginx \
    && rm -rf /var/lib/apt/lists/*

# Configura el directorio de trabajo
WORKDIR /var/www/html

# Copia los archivos de la aplicación
COPY app/ ./

# Expone el puerto 80 para NGINX
EXPOSE 80

# Copia la configuración de NGINX
#COPY nginx/default.conf /etc/nginx/conf.d/default.conf
COPY nginx/default /etc/nginx/sites-available/default

# Inicia los servicios de NGINX y PHP-FPM
CMD service nginx start && php-fpm
