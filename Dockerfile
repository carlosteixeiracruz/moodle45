FROM php:8.2-apache

# Instalar dependências do sistema e extensões do PHP
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libxml2-dev \
    libicu-dev \
    zlib1g-dev \
    libzip-dev \
    zip \
    unzip \
    curl \
    pkg-config \
    certbot \
    python3-certbot-apache \
    && rm -rf /var/lib/apt/lists/*

# Instalar e configurar a extensão GD
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

# Instalar outras extensões necessárias
RUN docker-php-ext-install mysqli opcache intl xml

# Habilitar mod_rewrite e mod_ssl no Apache
RUN a2enmod rewrite ssl

# Configurar o max_input_vars no PHP
RUN echo "max_input_vars = 5000" >> /usr/local/etc/php/conf.d/99-custom.ini

# Copiar o arquivo de configuração do Apache para o contêiner
COPY ./000-default.conf /etc/apache2/sites-available/000-default.conf

# Configurar o VirtualHost para SSL (caso tenha um certificado SSL)
COPY ./default-ssl.conf /etc/apache2/sites-available/default-ssl.conf

# Habilitar o site SSL no Apache
RUN a2ensite default-ssl

# Expor as portas 80 e 443 para HTTP e HTTPS
EXPOSE 80 443

# Definir o diretório de trabalho
WORKDIR /var/www/html

# Iniciar o Apache
CMD ["apache2ctl", "-D", "FOREGROUND"]
