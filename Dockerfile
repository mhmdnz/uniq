# Use the official PHP image with PHP 8.3 FPM
FROM php:8.3-fpm

# Install system dependencies & PHP extensions required for Laravel
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip

RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Prevent Composer from running as root/super user
RUN composer global require laravel/installer

# Copy existing application directory contents to the working directory
COPY . /var/www

# Install PHP dependencies
RUN composer install

# Change ownership of our applications
RUN chown -R www-data:www-data /var/www

COPY entrypoint.sh /usr/local/bin/docker-php-entrypoint
RUN chmod +x /usr/local/bin/docker-php-entrypoint

ENTRYPOINT ["docker-php-entrypoint"]

# Expose port 9000 and start php-fpm server
EXPOSE 9000
CMD ["php-fpm"]
