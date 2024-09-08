FROM php:8.1-fpm


# Instalar dependências e extensões necessárias
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-configure gd \
    --with-freetype \
    --with-jpeg \
    && docker-php-ext-install gd \
    && docker-php-ext-install zip

RUN docker-php-ext-install pdo_mysql

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Definir o diretório de trabalho
WORKDIR /var/www/html

# Copiar o código-fonte da aplicação para o container
COPY . .

RUN chown -R root:www-data /var/www/html/storage /var/www/html/bootstrap/cache
RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

#chown -R root:www-data storage 
#chmod -R 777 storage

# Instalar dependências do Composer
RUN composer install --no-dev --optimize-autoloader

# Expor a porta 9000
EXPOSE 9000

CMD ["php-fpm"]



# Use uma imagem oficial do PHP com FPM e Composer
#FROM php:8.1-fpm as php

#RUN usermod -u 1000 www-data

# Instale extensões do PHP necessárias
#RUN apt-get update && apt-get install -y \
#    libpng-dev \
#    libjpeg-dev \
#    libfreetype6-dev \
#    zip \
#    unzip \
#    git \
#    && docker-php-ext-configure gd --with-freetype --with-jpeg \
#    && docker-php-ext-install gd pdo pdo_mysql

# Defina o diretório de trabalho
#WORKDIR /var/www/

# Setup PHP-FPM.
#COPY docker/php/php.ini $PHP_INI_DIR/
#COPY docker/php/php-fpm.conf /usr/local/etc/php-fpm.d/www.conf
#COPY docker/php/conf.d/opcache.ini $PHP_INI_DIR/conf.d/opcache.ini

#RUN addgroup --system --gid 1000 customgroup
#RUN adduser --system --ingroup customgroup --uid 1000 customuser

# Instale o Composer
#COPY --from=composer:2.3.5 /usr/bin/composer /usr/bin/composer

#RUN php artisan cache:clear
#RUN php artisan config:clear

#RUN chmod -R 755 /var/www/storage
#RUN chmod -R 755 /var/www/bootstrap

#ENTRYPOINT [ "docker/entrypoint.sh" ]