FROM php:7.2-fpm

RUN apt-get update && apt-get install -y \
 gcc \
 # for gd
 libjpeg-dev libpng-dev \
 && rm -rf /var/lib/apt/lists/*

RUN curl -fsS -o /tmp/icu.tgz -L http://download.icu-project.org/files/icu4c/63.1/icu4c-63_1-src.tgz \
  && tar -zxf /tmp/icu.tgz -C /tmp \
  && cd /tmp/icu/source \
  && ./configure --prefix=/usr/local \
  && make \
  && make install \
# just to be certain things are cleaned up
  && rm -rf /tmp/icu*

# PHP_CPPFLAGS are used by the docker-php-ext-* scripts
ENV PHP_CPPFLAGS="$PHP_CPPFLAGS -std=c++11"

RUN docker-php-ext-configure intl --with-icu-dir=/usr/local && \
    docker-php-ext-install intl

RUN apt-get install -y \
    && docker-php-ext-install pdo pdo_mysql mysqli \
    && docker-php-ext-install opcache gd

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer \
    && composer --version

#COPY www.conf ${PHP_ROOT_DIR}/php-fpm.d/www.conf

RUN echo "root:root"|chpasswd
RUN useradd -ms /bin/bash dev
RUN usermod -u 1000 dev
USER dev

COPY php-overrides.ini $PHP_INI_DIR/conf.d
#COPY ../../wp/ /application
#COPY ../volume/wp-content /application/wp-content

WORKDIR  "/application"

ADD start.sh /start.sh
ENTRYPOINT ["/start.sh"]
