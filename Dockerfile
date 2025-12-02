FROM php:8.2-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install PostgreSQL extension and certificates
RUN apt-get update && apt-get install -y \
    libpq-dev \
    ca-certificates \
    wget \
    && docker-php-ext-install pgsql pdo_pgsql mysqli \
    && rm -rf /var/lib/apt/lists/*

# Download Render/PostgreSQL root certificate
RUN wget https://truststore.pki.rds.amazonaws.com/global/global-bundle.pem \
    -O /usr/local/share/ca-certificates/render-root.crt \
    && update-ca-certificates

# Set working directory
WORKDIR /var/www/html

# Copy source code
COPY . .

# Expose port 80 and start Apache
EXPOSE 80
CMD ["apache2-foreground"]
