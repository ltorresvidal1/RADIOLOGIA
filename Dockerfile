FROM elrincondeisma/octane:latest

RUN curl -sS https://getcomposer.org/installer​ | php -- \
     --install-dir=/usr/local/bin --filename=composer

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY --from=spiralscout/roadrunner:2.4.2 /usr/bin/rr /usr/bin/rr

RUN apk update && apk add --no-cache --virtual .build-deps \
    autoconf \
    g++ \
    make \
    supervisor \
    postgresql-dev
        


WORKDIR /app
COPY . .
RUN rm -rf /app/vendor
RUN rm -rf /app/composer.lock

RUN composer install
RUN composer require laravel/octane spiral/roadrunner
RUN docker-php-ext-install pdo pdo_pgsql
COPY .env.example .env
RUN mkdir -p /app/storage/logs
RUN php artisan cache:clear
RUN php artisan view:clear
RUN php artisan config:clear
RUN php artisan octane:install --server="swoole"
CMD php artisan octane:start --server="swoole" --host="0.0.0.0"


# Instalar Supervisor
#RUN apk add --no-cache supervisor

# Copiar archivo de configuración de Supervisor
#COPY supervisor.conf /etc/supervisor.conf

COPY supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Agregar comandos para ejecutar Supervisor
CMD supervisord -n -c /etc/supervisor/supervisord.conf
#CMD ["supervisord", "-c", "/etc/supervisor.conf"]
EXPOSE 8000