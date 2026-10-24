# Build frontend assets
FROM node:20-alpine AS frontend

WORKDIR /app

COPY package*.json ./
RUN npm ci

COPY resources ./resources
COPY public ./public
COPY vite.config.js tailwind.config.js postcss.config.js ./

RUN npm run build


# Laravel application
FROM richarvey/nginx-php-fpm:3.1.6

WORKDIR /var/www/html

# Debug Nginx configuration during build
RUN nginx -T 2>&1 | grep -E 'listen |server_name|root ' || true

COPY . .
COPY --from=frontend /app/public/build ./public/build

# Ensure the Aiven MySQL SSL CA certificate exists
RUN test -f /var/www/html/storage/certs/ca.pem || (echo "ERROR: MySQL SSL CA certificate not found at storage/certs/ca.pem" && exit 1)

# Install production PHP dependencies
RUN composer install \
    --no-dev \
    --no-interaction \
    --prefer-dist \
    --optimize-autoloader

RUN chmod -R 775 /var/www/html/storage /var/www/html/bootstrap/cache

ENV SKIP_COMPOSER=1
ENV WEBROOT=/var/www/html/public
ENV PHP_ERRORS_STDERR=1
ENV REAL_IP_HEADER=1
ENV APP_ENV=production
ENV APP_DEBUG=false
ENV LOG_CHANNEL=stderr
ENV COMPOSER_ALLOW_SUPERUSER=1
ENV MYSQL_ATTR_SSL_CA=/var/www/html/storage/certs/ca.pem

# Declare the expected HTTP port
EXPOSE 80

CMD ["sh", "-c", "php artisan migrate --force && exec /start.sh"]
