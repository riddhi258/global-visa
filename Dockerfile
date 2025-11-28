FROM php:8.2-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Set working directory
WORKDIR /var/www/html

# Copy PHP files
COPY . .

# Install mysqli
RUN docker-php-ext-install mysqli

# Fix Apache ServerName warning
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Run Apache in foreground
CMD ["apache2-foreground"]
