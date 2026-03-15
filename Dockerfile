FROM php:8.2-apache

# Install aplikasi sistem yang dibutuhkan Laravel & DomPDF
RUN apt-get update && apt-get install -y \
    libzip-dev \
    libpng-dev \
    zip \
    unzip \
    git \
    nodejs \
    npm

# Install ekstensi PHP
RUN docker-php-ext-install pdo_mysql zip gd

# Aktifkan mod_rewrite Apache agar routing Laravel berjalan
RUN a2enmod rewrite

# Ubah root document Apache agar langsung menembak ke folder /public Laravel
ENV APACHE_DOCUMENT_ROOT /var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Atur folder kerja
WORKDIR /var/www/html

# Copy semua file kodingan Anda ke dalam Kapsul
COPY . .

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
RUN composer install --no-dev --optimize-autoloader

# Build aset tampilan (Tailwind css dll)
RUN npm install && npm run build

# Berikan izin akses folder
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Beritahu Render bahwa kapsul ini menggunakan port 80
EXPOSE 80
