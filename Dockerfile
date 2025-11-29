FROM php:8.2-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install PostgreSQL, PDO, SSL support, and dependencies
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libssl-dev \
    && docker-php-ext-install pgsql pdo_pgsql mysqli

# Set working directory
WORKDIR /var/www/html

# Copy source code
COPY . .

# Expose port 80 and start Apache
CMD ["apache2-foreground"]
