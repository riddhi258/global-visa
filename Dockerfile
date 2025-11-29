FROM php:8.2-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install PostgreSQL extension for PHP
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pgsql pdo_pgsql

# Install mysqli (optional if you still want MySQL locally)
RUN docker-php-ext-install mysqli

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . .

# Fix Apache ServerName warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

CMD ["apache2-foreground"]
