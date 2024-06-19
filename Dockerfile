# Użyj obrazu bazowego PHP 8.3
FROM php:8.0-fpm
# Instalacja Composer
RUN install_packages curl unzip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Uruchomienie Composer podczas konfiguracji
RUN composer install --ignore-platform-reqs --no-ansi --no-interaction --no-progress --no-scripts

WORKDIR /var/www

# Skopiuj lokalne pliki aplikacji do katalogu /app w kontenerze
COPY . /var/www

ADD start.sh /
RUN chmod +x /start.sh

CMD ["./start.sh"]
