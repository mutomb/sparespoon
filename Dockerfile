FROM richarvey/nginx-php-fpm:3.1.6

# Set working directory
WORKDIR /var/www/html

# Copy all application files
COPY . /var/www/html

# Added flag to bypass local PHP mismatch constraints
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader --ignore-platform-reqs

# Configure application runtime variables
ENV WEBROOT /var/www/html/public
ENV APP_ENV production

# Fix permissions for the storage engines
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache