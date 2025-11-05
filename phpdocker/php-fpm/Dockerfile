FROM phpdockerio/php:8.1-fpm
ARG DEBIAN_FRONTEND=noninteractive
WORKDIR "/application"
COPY . .

RUN apt-get update \
    && apt-get -y --no-install-recommends install \
    php8.1-bcmath \
    php8.1-dba \
    php8.1-enchant \
    php8.1-gd \
    php8.1-gearman \
    php8.1-gmp \
    php8.1-igbinary \
    php8.1-interbase \
    php8.1-intl \
    php8.1-mongodb \
    php8.1-mysql \
    php8.1-odbc \
    php8.1-phpdbg \
    php8.1-pspell \
    php8.1-raphf \
    php8.1-redis \
    php8.1-sqlite3 \
    php8.1-ssh2 \
    php8.1-xdebug \
    php8.1-xhprof \
    php8.1-xsl \
    php8.1-yaml \
    php8.1-zmq \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/* /tmp/* /var/tmp/* /usr/share/doc/*


RUN chmod -R 777 storage
RUN composer install
RUN php artisan key:generate
