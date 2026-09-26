# Use PHP 8.2 CLI as the base image
FROM php:8.2-cli

# Set the working directory inside the container
WORKDIR /var/www/html

# Install Linux packages and the PHP MySQL extension
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-install pdo_mysql

# Copy Composer from the official Composer image
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Copy the Laravel project files into the container
COPY . .

# Install Laravel PHP dependencies
RUN composer install --no-scripts

# Document that Laravel uses port 8000
EXPOSE 8000

# Start the Laravel development server when the container starts
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]


# FROM      → base image
# WORKDIR   → working directory
# RUN       → execute command while building the image
# COPY      → copy files into the image
# EXPOSE    → document the application's port
# CMD       → command executed when the container starts
