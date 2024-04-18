FROM php:8.2-apache
RUN apt-get update
RUN apt-get install nano -y
RUN a2enmod rewrite
RUN docker-php-ext-install mysqli pdo pdo_mysql
RUN apt-get install curl php-cli php-mbstring git unzip -y
RUN curl -sS https://getcomposer.org/installer -o composer-setup.php
RUN HASH=`curl -sS https://composer.github.io/installer.sig`
RUN php -r "if (hash_file('SHA384', 'composer-setup.php') === '$HASH') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php --install-dir=/usr/local/bin --filename=composer