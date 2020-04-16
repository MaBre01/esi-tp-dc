FROM php:7.4-fpm-alpine3.11

RUN apk add --no-cache \
    git \
    shadow \
    su-exec

RUN apk add --no-cache \
    icu-dev

RUN docker-php-ext-configure intl && \
    docker-php-ext-install \
    intl \
    pdo \
    pdo_mysql

ENV UID 1000
ENV GID 1000

RUN usermod -u ${UID} www-data && \
    groupmod -g ${GID} www-data && \
    chown -R www-data:www-data /var/www/html /home/www-data && \
    usermod -a -G tty www-data && \
    usermod -a -G tty nobody

RUN curl -sSk https://getcomposer.org/installer | php -- --disable-tls && \
   mv composer.phar /usr/local/bin/composer

VOLUME [ "/home/www-data/.composer/cache" ]

COPY ./.docker/php/php.ini /usr/local/etc/php/php.ini
COPY ./.docker/php/php-fpm-pool.conf /usr/local/etc/php-fpm.d/www.conf

WORKDIR /var/www/html

COPY --chown=www-data:www-data app .

USER www-data
RUN composer install
USER root

EXPOSE 9000

COPY ./.docker/php/docker-entrypoint.sh /

ENTRYPOINT [ "/docker-entrypoint.sh" ]

CMD [ "php-fpm" ]
