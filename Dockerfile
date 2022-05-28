FROM php:8.1-fpm-alpine

WORKDIR /var/www/html/wibusaka

# Install required PHP extension for Laravel
RUN docker-php-ext-install -j$(nproc) bcmath mysqli pdo_mysql

# Install GD and ZIP PHP extension
RUN apk update && apk add \
		freetype-dev \
		libjpeg-turbo-dev \
		libpng-dev \
		libzip-dev \
        zip \
	&& docker-php-ext-configure gd --with-freetype --with-jpeg \
	&& docker-php-ext-install -j$(nproc) gd zip

# Install Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Expose PHP Port
EXPOSE 9000

CMD [ "php-fpm" ]