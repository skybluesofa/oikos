FROM php:7.2-fpm

RUN DEBIAN_FRONTEND=noninteractive \
      apt-get update \
      && apt-get install --yes \
        git \
        curl \
        jq \
        default-mysql-client \
        nginx \
        python \
        python-dev \
        python-pip \
        supervisor \
        libmagickwand-dev \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng++-dev \
        zlib1g-dev \
      && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
      && docker-php-ext-install -j$(nproc) gd \
      && pecl install imagick \
      && docker-php-ext-enable imagick \
      && docker-php-ext-install intl \
      && docker-php-ext-install pdo_mysql \
      && pecl install -o -f redis \
      && docker-php-ext-enable redis \
      && docker-php-ext-install xml \
      && docker-php-ext-install zip \
      && pip install awscli \
      && apt-get remove -y python-pip \
      && curl -O 'https://getcomposer.org/installer' \
      && php installer \  
      && mv composer.phar /usr/local/bin/composer \
      && rm installer \
      && rm -r /var/lib/apt/lists/* \
      && rm -rf /tmp/pear
