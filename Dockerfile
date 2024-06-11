# Dockerfile
FROM php:8.2-apache

# Install dependencies
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    default-mysql-client \
    unzip \
    curl \
    gnupg \
    && docker-php-ext-install gd mysqli pdo pdo_mysql

# Configure GD library
RUN docker-php-ext-configure gd --with-freetype --with-jpeg && docker-php-ext-install gd

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Install Node.js and npm
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash - \
    && apt-get install -y nodejs \
    && apt-get install -y npm

# Copy Apache config
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Copy application files
COPY . /var/www/html/

# Set permissions
RUN chown -R www-data:www-data /var/www/html && chmod -R 755 /var/www/html
