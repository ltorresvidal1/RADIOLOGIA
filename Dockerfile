FROM elrincondeisma/octane:latest

RUN curl -sS https://getcomposer.org/installer​ | php -- \
     --install-dir=/usr/local/bin --filename=composer

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
COPY --from=spiralscout/roadrunner:2.4.2 /usr/bin/rr /usr/bin/rr

RUN apk update && apk add --no-cache --virtual .build-deps \
    autoconf \
    g++ \
    make \
    supervisor\
    postgresql-dev
        


WORKDIR /app
COPY . .
RUN rm -rf /app/vendor
RUN rm -rf /app/composer.lock

RUN composer install
RUN composer require laravel/octane spiral/roadrunner
RUN docker-php-ext-install pdo pdo_pgsql
COPY .env.example .env
COPY supervisord.conf /etc/supervisord.conf
RUN mkdir -p /app/storage/logs
RUN php artisan cache:clear
RUN php artisan view:clear
RUN php artisan config:clear
RUN php artisan octane:install --server="swoole"
CMD php artisan octane:start --server="swoole" --host="0.0.0.0"
ENTRYPOINT ["/usr/bin/supervisord", "-n", "-c",  "/etc/supervisord.conf"]
EXPOSE 8000