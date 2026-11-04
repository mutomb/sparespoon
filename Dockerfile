FROM serversideup/php:8.3-fpm-nginx

# Switch to root temporarily to configure files and permissions
USER root

# Set the working directory
WORKDIR /var/www/html

# Copy all application files
COPY --chown=www-data:www-data . /var/www/html

# 1. Install dependencies without running artisan scripts (avoids crashing if env/DB isn't live yet)
RUN composer install --no-dev --no-interaction --prefer-dist --no-scripts

# 2. Safely generate the optimized autoloader mapping afterwards
RUN composer dump-autoload --no-dev --optimize

# Switch back to the non-root secure user for runtime execution
USER www-data
