FROM php:7.4-fpm

RUN apt-get update && apt-get install -y
# You can check all possible installation here : https://gist.github.com/chronon/95911d21928cff786e306c23e7d1d3f3
RUN apt-get install -y --no-install-recommends apt-utils \
        apt-utils \
        git \
        zlib1g-dev \
        libxml2-dev \
        libzip-dev \
        libpq-dev \
        libssl-dev \
        libpng-dev \
        libjpeg-dev \
        libfreetype6-dev \
        libfontconfig \
        libgmp-dev \
        libpcre3-dev \
        libtool \
        vim \
        bzip2 \
        unzip \
        acl \
        automake \
        bzip2 \
        cmake \
        cron \
        g++ \
        gcc \
        build-essential \
        locales \
        make \
        nginx-extras \
        openssh-server \
    && docker-php-ext-install \
        zip \
        intl \
        pdo \
        mysqli \
        pdo_mysql \
        pdo_pgsql \
        opcache

RUN chown -R www-data:www-data /var/www

EXPOSE 80
WORKDIR /var/www/html

# Install Composer !
RUN curl -sS https://getcomposer.org/installer | php && mv composer.phar /usr/bin/composer
RUN chmod 755 /usr/bin/composer

RUN curl -sS https://get.symfony.com/cli/installer | bash
RUN mv /root/.symfony5/bin/symfony /usr/bin/symfony

USER www-data

RUN git config --global user.email "project@mail.com"
RUN git config --global user.name "project"

# USER root
# RUN usermod -u 1000 www-data
# Set the default directory inside the container

# COPY ./tools/docker/php/entrypoint.sh /
# RUN chmod +x /entrypoint.sh
# ENTRYPOINT ["/entrypoint.sh"]