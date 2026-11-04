# --- Stage 1: Compile Frontend Assets ---
FROM node:20-alpine AS frontend-builder
WORKDIR /app
COPY package*.json ./
RUN npm ci
COPY . .
RUN npm run build

# --- Stage 2: Production PHP Web Server ---
FROM serversideup/php:8.4-fpm-nginx

# Switch to root temporarily to configure files
USER root
WORKDIR /var/www/html

# Copy application files
COPY --chown=www-data:www-data . /var/www/html

# Copy the compiled Vite assets from Stage 1
COPY --from=frontend-builder --chown=www-data:www-data /app/public/build /var/www/html/public/build

# Install backend dependencies without running artisan scripts
# RUN composer install --no-dev --no-interaction --prefer-dist --no-scripts
# RUN composer dump-autoload --no-dev --optimize

# Switch back to secure user
USER www-data

# AUTOMATIC SEEDING ON BOOTUP
CMD ["sh", "-c", "php artisan migrate --force && php artisan db:seed --force && exec /usr/local/bin/docker-php-entrypoint"]