FROM php:5.6-alpine

## UpdateとUpgrade
RUN apk update && apk upgrade \
## よく使うコマンドや
## Laravelインストールに必要な拡張ライブラリとComposerをインストール
    && apk add --no-cache \
            wget \
            vim \
            git \
            libmcrypt-dev \
            openssl \
            freetype-dev \
            libjpeg-turbo-dev \
            libpng-dev \
            libmcrypt-dev \
            openssl-dev \
            libxml2-dev \
    && docker-php-ext-install  \
            iconv \
            mcrypt \
            pdo_mysql \
            mbstring \
            xml \
            tokenizer \
            zip \
    && docker-php-ext-configure gd --with-freetype-dir=/usr/include/ --with-jpeg-dir=/usr/include/ \
    && docker-php-ext-install  gd

## php.iniのセットアップ（タイムゾーン）
ADD php.ini /usr/local/etc/php/
RUN chmod 644 /usr/local/etc/php/php.ini

## phpunitをインストール
RUN wget https://phar.phpunit.de/phpunit.phar
RUN chmod +x phpunit.phar
RUN mv phpunit.phar /usr/local/bin/phpunit

# フォルダ作成
RUN mkdir /var/www && mkdir /var/www/html