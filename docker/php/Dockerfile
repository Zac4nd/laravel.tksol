# Legacy runtime for Laravel 5.5. NOT SUPPORTED: isolate and upgrade.
FROM php:7.4-fpm
RUN sed -i "s@http://deb.debian.org/debian-security@http://archive.debian.org/debian-security@g; s@http://security.debian.org/debian-security@http://archive.debian.org/debian-security@g" /etc/apt/sources.list && rm -rf /var/lib/apt/lists/* && apt-get update && apt-get install -y --no-install-recommends \
  libfreetype6-dev libjpeg62-turbo-dev libpng-dev libzip-dev libonig-dev \
  libicu-dev libxml2-dev unzip \
  && docker-php-ext-configure gd --with-freetype --with-jpeg \
  && docker-php-ext-install -j2 pdo_mysql mysqli mbstring gd zip bcmath intl exif soap opcache \
  && rm -rf /var/lib/apt/lists/*
WORKDIR /var/www/html
COPY --from=composer:2.2 /usr/bin/composer /usr/local/bin/composer
COPY app/ /var/www/html/
RUN composer install --no-dev --prefer-dist --no-interaction --no-progress --no-scripts --optimize-autoloader \
  && mkdir -p /var/www/html/bootstrap/cache /var/www/html/storage/framework/{sessions,views,cache} \
  && chown -R 1000:1000 /var/www/html/bootstrap/cache /var/www/html/storage
COPY docker/php/legacy.ini /usr/local/etc/php/conf.d/zz-tksol.ini
CMD ["php-fpm"]
