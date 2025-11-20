FROM php:8.2-cli

# esto lo necesito para poner la foto cuadrada
RUN apt-get update && apt-get install -y \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libwebp-dev \
        libxpm-dev \
        unzip \
        git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd exif pdo pdo_mysql mysqli \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

WORKDIR /var/www/html