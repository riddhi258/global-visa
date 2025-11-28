# Use official PHP image with Apache
FROM php:8.2-apache

# Enable Apache mod_rewrite (important for routing)
RUN a2enmod rewrite

# Install required PHP extensions (add more if needed)
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Copy project files to Apache server directory
COPY . /var/www/html/

# Set proper permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

# Expose Apache port
EXPOSE 80

# Start Apache when the container runs
CMD ["apache2-foreground"]

# Use official PHP image with Apache
FROM php:8.2-apache

# Install mysqli + pdo_mysql
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Enable Apache rewrite module (your original line)
RUN a2enmod rewrite
