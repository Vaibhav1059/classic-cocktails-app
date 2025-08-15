# Use an official PHP-FPM image
FROM php:8.3-fpm-alpine

# Set the working directory inside the container
WORKDIR /var/www/html

# Install the mysqli extension which is required by your config.php
RUN docker-php-ext-install mysqli

# Copy all your application files (from the current directory) into the container
COPY . .

# Set the correct permissions for the web server
RUN chown -R www-data:www-data /var/www/html