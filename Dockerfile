FROM php:8.2-apache as production

ENV APP_ENV=production
ENV APP_DEBUG=false

RUN docker-php-ext-configure opcache --enable-opcache && \
    docker-php-ext-install pdo pdo_mysql
COPY opcache.conf /usr/local/etc/php/conf.d/opcache.ini
COPY apache.conf /etc/apache2/sites-available/000-default.conf

COPY . /var/www/html
# COPY .env.prod /var/www/html/.env # from github workflow

RUN php artisan config:cache && \
    php artisan route:cache && \
    php artisan view:cache && \
    chmod 664 -R /var/www/html/storage/ && \
    chown -R www-data:www-data /var/www/ && \
    a2enmod rewrite