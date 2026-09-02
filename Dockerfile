FROM php:8.2-apache

RUN apt-get update && apt-get install -y \
    libpq-dev \
    && rm -rf /var/lib/apt/lists/* \
    && docker-php-ext-install pdo pdo_pgsql

RUN a2enmod rewrite

RUN chmod 777 -R -c /var/www

# --- AGREGA ESTAS DOS LÍNEAS AQUÍ ABAJO ---
RUN sed -i 's|/var/www/html|/var/www/html/public|g' /etc/apache2/sites-available/000-default.conf
WORKDIR /var/www/html
