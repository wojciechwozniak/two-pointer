# Użyj obrazu bazowego Bitnami Laravel
FROM bitnami/laravel:latest
 
# Ustal katalog docelowy w kontenerze
WORKDIR /app

# Skopiuj lokalne pliki aplikacji do katalogu /app w kontenerze
COPY . /app

# Skopiuj pliki konfiguracyjne aplikacji do katalogu /app w kontenerze
COPY routes/ /app/routes/

EXPOSE 8000

# Instalacja Composer
RUN install_packages curl unzip && \
    curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Uruchomienie Composer podczas konfiguracji
RUN composer install --ignore-platform-reqs --no-ansi --no-interaction --no-progress --no-scripts

CMD ["php", "artisan", "key:generate"]
CMD ["php", "artisan", "migrate"]


# Uruchomienie serwera Laravel
CMD ["php", "artisan", "serve", "--host=0.0.0.0","--port=8000"]