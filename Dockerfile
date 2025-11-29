# Use official PHP 8.2 with Apache
FROM php:8.2-apache

# Set working directory
WORKDIR /var/www/html

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install required packages
RUN apt-get update && \
    apt-get install -y libpq-dev ca-certificates && \
    docker-php-ext-install pgsql pdo_pgsql mysqli && \
    update-ca-certificates && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Fix Apache ServerName warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copy project files
COPY . .

# Start Apache server
CMD ["apache2-foreground"]
