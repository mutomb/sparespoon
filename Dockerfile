FROM serversideup/php:8.3-fpm-nginx

# Switch to root temporarily to configure files and permissions
USER root

# Set the working directory
WORKDIR /var/www/html

# Copy all application files
COPY --chown=www-data:www-data . /var/www/html

# Run composer installation natively during the build stage
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Switch back to the non-root secure user for runtime execution
USER www-data