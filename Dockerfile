FROM richarvey/nginx-php-fpm:3.1.6

COPY . /var/www/html

ENV WEBROOT /var/www/html/public
ENV APP_ENV production
ENV RUN_SCRIPTS 1

# Correct folder permissions for production
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache