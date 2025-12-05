FROM php:8.2-apache-bullseye

# Enable Apache rewrite
RUN a2enmod rewrite

# Install required packages, CA certificates, and PostgreSQL client
RUN apt-get update && apt-get install -y \
    libpq-dev \
    postgresql-client \
    ca-certificates \
    openssl \
    iputils-ping \
    netcat-openbsd \
    && docker-php-ext-install pgsql pdo_pgsql \
    && update-ca-certificates \
    && rm -rf /var/lib/apt/lists/*

# Suppress Apache "ServerName" notice
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Set working directory
WORKDIR /var/www/html

# Copy project files
COPY . /var/www/html/

# Fix permissions
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 755 /var/www/html

EXPOSE 80
CMD ["apache2-foreground"]
