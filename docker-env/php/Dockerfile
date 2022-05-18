ARG PHP_VERSION
ARG PHP_OS_VERSION
FROM php:${PHP_VERSION}-fpm-${PHP_OS_VERSION}

COPY php.ini /usr/local/etc/php/php.ini

RUN apk update \
    && apk add --no-cache icu-dev libcurl libpq-dev \
    && docker-php-ext-install intl pdo_pgsql pgsql

RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install xdebug-3.1.4 \
    && apk del $PHPIZE_DEPS \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host = host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

COPY --from=composer /usr/bin/composer /usr/bin/composer

RUN adduser --disabled-password --no-create-home www-user

ENV PATH=$PATH:/usr/local/apache2/codeigniter/vendor/bin

WORKDIR /usr/local/apache2/codeigniter
