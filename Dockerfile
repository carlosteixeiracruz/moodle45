# Base PHP com Apache
FROM php:8.1-apache

# Atualizar e instalar dependências
RUN apt-get update && apt-get install -y --no-install-recommends \
    git \
    libzip-dev \
    libpng-dev \
    libjpeg62-turbo-dev \
    libfreetype6-dev \
    libicu-dev \
    libxml2-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install pdo pdo_mysql mysqli zip gd intl soap exif \
    && apt-get clean \
    && rm -rf /var/lib/apt/lists/*

# Habilitar OPcache
RUN docker-php-ext-enable opcache
RUN echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/40-opcache.ini

# Configuração customizada
RUN echo "max_input_vars = 5000" >> /usr/local/etc/php/conf.d/99-custom.ini

# Copiar arquivos do Moodle
COPY ./moodle /var/www/html

# Expor a porta 80
EXPOSE 80

# Rodar o Apache
CMD ["apache2-foreground"]
