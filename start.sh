#!/bin/bash
#CMD ["php", "artisan", "cache:clear"]
 #CMD ["php", "artisan", "key:generate"]
 #CMD ["php", "artisan", "optimize"]
 #CMD ["php", "artisan", "migrate"]
 #
 #
 ## Uruchomienie serwera Laravel
 #CMD ["php", "artisan", "serve", "--host=0.0.0.0","--port=8000"]



php artisan key:generate
php artisan serve --host=0.0.0.0 --port=8000 && php artisan config:clear

