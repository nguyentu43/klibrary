
FROM jeanblanchard/alpine-glibc

RUN apk update && \
    apk add --no-cache --upgrade \
    bash \
    ca-certificates \
    gcc \
    mesa-gl \
    python3 \
    qt5-qtbase-x11 \
    wget \
    xdg-utils \
    xz
RUN wget -nv -O- https://download.calibre-ebook.com/linux-installer.sh | sh /dev/stdin

COPY . /app

WORKDIR /app

RUN chmod -R 777 .

RUN apk update && apk add php php-pdo_pgsql php-session php-pdo php-fileinfo php-xmlwriter php-xml php-tokenizer php-dom php-zip php-json php-phar php-openssl php-mbstring git

RUN wget https://getcomposer.org/download/2.3.3/composer.phar

RUN php composer.phar install

RUN php artisan storage:link

WORKDIR /app/public

CMD php -S 0.0.0.0:$PORT -c user.ini
