FROM php:8.2-bookworm

# Update
RUN apt update
RUN apt upgrade -y
RUN apt install -y zip
RUN apt install -y apt-utils
RUN docker-php-ext-configure pdo_mysql && docker-php-ext-install pdo_mysql

# Install symfony binary
RUN curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.deb.sh' | bash
RUN apt install -y symfony-cli
RUN symfony server:ca:install

# Install composer
RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === 'e21205b207c3ff031906575712edab6f13eb0b361f2085f1f1237b7126d785e826a450292b6cfd1d64d92e6563bbde02') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"
RUN mv composer.phar /usr/local/bin/composer

WORKDIR /root/server

# ENTRYPOINT sleep infinity
ENTRYPOINT symfony server:start
