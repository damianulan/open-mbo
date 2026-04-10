ARG UBUNTU_VERSION=24.04
FROM ubuntu:${UBUNTU_VERSION}

ARG DEBIAN_FRONTEND=noninteractive
ARG PHP_VERSION=8.4

# Install PHP from Ondrej's PPA so the version can be selected via build args.
RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        ca-certificates \
        curl \
        git \
        gnupg \
        lsb-release \
        nano \
        software-properties-common \
        unzip \
        zip \
    && add-apt-repository -y ppa:ondrej/php \
    && apt-get update \
    && apt-get install -y --no-install-recommends \
        default-mysql-client \
        php${PHP_VERSION}-bcmath \
        php${PHP_VERSION}-cli \
        php${PHP_VERSION}-curl \
        php${PHP_VERSION}-fpm \
        php${PHP_VERSION}-gd \
        php${PHP_VERSION}-intl \
        php${PHP_VERSION}-mbstring \
        php${PHP_VERSION}-mysql \
        php${PHP_VERSION}-opcache \
        php${PHP_VERSION}-redis \
        php${PHP_VERSION}-xml \
        php${PHP_VERSION}-zip \
    && sed -ri 's!^listen = .*!listen = 9000!' /etc/php/${PHP_VERSION}/fpm/pool.d/www.conf \
    && ln -sf /usr/bin/php${PHP_VERSION} /usr/local/bin/php \
    && ln -sf /usr/sbin/php-fpm${PHP_VERSION} /usr/local/bin/php-fpm \
    && rm -rf /var/lib/apt/lists/*

# Install Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www

COPY .docker/php/php.ini /etc/php/${PHP_VERSION}/cli/conf.d/99-open-mbo.ini
COPY .docker/php/php.ini /etc/php/${PHP_VERSION}/fpm/conf.d/99-open-mbo.ini
COPY .docker/php/entrypoint.sh /usr/local/bin/entrypoint.sh

ENTRYPOINT ["entrypoint.sh"]

CMD ["php-fpm", "-F"]
