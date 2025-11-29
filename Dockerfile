FROM php:8.2-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install PostgreSQL + SSL support
RUN apt-get update && apt-get install -y libpq-dev && docker-php-ext-install pgsql

# Install mysqli (optional for local)
RUN docker-php-ext-install mysqli

# Set working directory
WORKDIR /var/www/html

# Copy files
COPY . .

CMD ["apache2-foreground"]
