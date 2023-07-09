FROM elrincondeisma/octane:latest

RUN curl -sS https://getcomposer.org/installer​ | php -- \
     --install-dir=/usr/local/bin --filename=composer

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY --from=spiralscout/roadrunner:2.4.2 /usr/bin/rr /usr/bin/rr

RUN apk update && apk add --no-cache --virtual .build-deps \
    autoconf \
    g++ \
    make \
    postgresql-dev

RUN apt-get update \
    && apt-get install -y \
        supervisor
        


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

EXPOSE 8000