FROM php:8.3-fpm

# Dependencies
RUN apt-get -y update && \
    apt-get -y install \
    sudo \
    git \
    git-core \
    zip \
    wget \
    unzip \
    vim \
    apt-utils \
    jq

# PHP extensions
# Install tool (https://github.com/mlocati/docker-php-extension-installer) to help with instalation of PHP extensions
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/
RUN chmod +x /usr/local/bin/install-php-extensions

RUN install-php-extensions gd oauth amqp zip bcmath sockets xdebug intl pdo_mysql

# Composer
RUN install-php-extensions @composer

# Entrypoint
COPY entrypoint.sh /usr/local/bin/entrypoint.sh
ENTRYPOINT ["entrypoint.sh"]
CMD ["php-fpm"]

# Setup user docker
RUN useradd -ms /bin/bash docker && adduser docker sudo
RUN echo '%sudo ALL=(ALL) NOPASSWD:ALL' >> /etc/sudoers

# Cleanup
RUN apt-get -y autoremove && rm -rf /var/lib/apt/lists/*

USER docker
