FROM php:8.3-fpm

# Arguments defined in docker-compose.yml
ARG user
ARG uid

# Устанавливаем необходимые системные зависимости
RUN apt-get update && apt-get install -y \
    libcurl4-openssl-dev \
    pkg-config \
    libssl-dev \
    libicu-dev \
    zlib1g-dev \
    libpq-dev \
    libxml2-dev \
    git \
    unzip \
    libpng-dev \
    libfreetype6-dev \
    libjpeg62-turbo-dev \
    libonig-dev \
    libzip-dev \
    libreadline-dev \
    libffi-dev \
    # Устанавливаем зависимости для raphf и propro
    libtool \
    autoconf \
    automake \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j$(nproc) gd pdo pdo_mysql zip intl bcmath soap

RUN pecl install raphf \
    && docker-php-ext-enable raphf


RUN pecl install pecl_http \
    && docker-php-ext-enable http

RUN docker-php-ext-install soap

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*


# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

RUN docker-php-ext-install -j$(nproc) gd

RUN docker-php-ext-configure zip
RUN docker-php-ext-install zip

RUN docker-php-ext-configure intl
RUN docker-php-ext-install intl

# Get latest Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Create system user to run Composer and Artisan Commands
RUN useradd -G www-data,root -u $uid -d /home/$user $user
RUN mkdir -p /home/$user/.composer && \
    chown -R $user:$user /home/$user

# Set working directory
WORKDIR /var/www

USER $user
