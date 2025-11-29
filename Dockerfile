# PHP 8.2 with Apache
FROM php:8.2-apache

# Working directory
WORKDIR /var/www/html

# Enable Apache rewrite
RUN a2enmod rewrite

# Install dependencies
RUN apt-get update && \
    apt-get install -y libpq-dev ca-certificates && \
    docker-php-ext-install pgsql pdo_pgsql mysqli && \
    update-ca-certificates && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Prevent Apache warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Copy project files
COPY . .

# Start Apache
CMD ["apache2-foreground"]
