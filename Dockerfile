FROM richarvey/nginx-php-fpm:php8.3-latest

# Set working directory
WORKDIR /var/www/html

# Copy all application files
COPY . /var/www/html

# Install composer dependencies securely
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Configure application runtime variables
ENV WEBROOT /var/www/html/public
ENV APP_ENV production

# Fix permissions for the storage engines
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache