# Use official PHP image with Apache
FROM php:8.2-apache

# Enable Apache mod_rewrite (for pretty URLs)
RUN a2enmod rewrite

# Copy all project files to Apache document root
COPY . /var/www/html/

# Set working directory
WORKDIR /var/www/html

# Install required PHP extensions (optional – you can remove if not needed)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Set permissions for storage directories (optional)
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80

# Start Apache server
CMD ["apache2-foreground"]
