# Memulai dari image PHP 8.2 dengan FPM (FastCGI Process Manager)
FROM php:8.2-fpm

# Mengatur direktori kerja di dalam container
WORKDIR /var/www/html

# Menginstal dependensi sistem yang dibutuhkan oleh Laravel & Vite
RUN apt-get update && apt-get install -y \
    build-essential \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    locales \
    zip \
    jpegoptim optipng pngquant gifsicle \
    vim \
    unzip \
    git \
    curl \
    libonig-dev \
    libzip-dev

# Menginstal ekstensi PHP yang umum digunakan Laravel
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Menginstal Composer (dependency manager untuk PHP)
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Menyalin semua file proyek Anda ke dalam container
COPY . .

# Menginstal dependensi composer (tanpa paket development)
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Menjalankan build untuk Vite
RUN npm install && npm run build

# Mengatur izin folder agar Laravel bisa menulis file cache dan storage
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

# Memberitahu Docker bahwa container akan berjalan di port 8000
EXPOSE 8000

# Perintah untuk menjalankan server saat container dimulai
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
