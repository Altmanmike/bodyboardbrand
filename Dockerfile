FROM php:8.2-cli

# Installer les extensions PHP nécessaires
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libpq-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    && docker-php-ext-install pdo pdo_mysql

# Installer Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

# Installer Symfony CLI
RUN curl -sS https://get.symfony.com/cli/installer | bash && mv /root/.symfony5/bin/symfony /usr/local/bin/symfony

EXPOSE 8000

CMD ["symfony", "server:start", "--no-tls", "--allow-http", "-d"]
