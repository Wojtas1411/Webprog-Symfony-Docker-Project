FROM php:7.2-fpm

RUN apt-get update && apt-get install -y libpng-dev libgd3 libgd-tools  libxml2 libxml2-dev \
curl \
wget \
git \
zip \
&& docker-php-ext-install pdo_mysql  mysqli gd 


RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer
RUN chmod +x /usr/local/bin/composer

COPY ./php-hr-system/ /var/www/html/hr-system

# EXPOSE 8000

# RUN php var/www/html/bin/console server:run
# CMD ["php","var/www/html/bin/console","server:run"]
