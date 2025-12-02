FROM php:8.2-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install dependencies including certificates
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libssl-dev \
    wget \
    ca-certificates \
    && docker-php-ext-install pgsql pdo_pgsql mysqli

# Download and install Render/PostgreSQL root certificate
RUN wget https://truststore.pki.rds.amazonaws.com/global/global-bundle.pem -O /usr/local/share/ca-certificates/render-root.crt \
    && update-ca-certificates

# Set working directory
WORKDIR /var/www/html

# Copy source code
COPY . .

# Expose port 80 and start Apache
CMD ["apache2-foreground"]
