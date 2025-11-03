FROM php:8.4-fpm

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y \
		libfreetype-dev \
		libjpeg62-turbo-dev \
		libpng-dev \
		libzip-dev \
		libpq-dev \
		zip \
		unzip \
        nodejs \
        npm \
        libxml2-dev \
        libxrender1 \
        libxext6 \
        libfontconfig1 \
        xfonts-base \
        xfonts-75dpi \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd pdo pdo_pgsql \
   	&& apt-get clean

RUN apt-get install -y libicu-dev \
  && docker-php-ext-configure intl \
  && docker-php-ext-install intl zip

#RUN pecl install xdebug
#RUN docker-php-ext-enable xdebug

# Configure php-fpm
RUN mkdir /run/php
RUN usermod -u 1000 www-data

#COPY ./pool.conf /usr/local/etc/php/fpm/pool.d/zzz.conf
#COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

COPY ./php.ini /usr/local/etc/php/conf.d/30-user.ini
#COPY ./php-cli.ini /usr/local/etc/php/conf.d/30-user.ini

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Cronjob setup
#COPY ./cron /etc/cron.d/cron
#RUN chmod 0644 /etc/cron.d/cron

# Start script
#COPY ./start.sh /usr/local/bin/start
#RUN chmod +x /usr/local/bin/start

WORKDIR /var/www/html

#CMD ["/usr/local/bin/start"]
