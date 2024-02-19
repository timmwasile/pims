FROM php:8.1.4-fpm

# Install needed php extensions: ldap
RUN docker-php-ext-install pdo pdo_mysql

COPY . /var/www/html
COPY ./keys/ /var/www/html
#RUN rm /var/www/html/.env.test
#RUN mv /var/www/html/.env.prod /var/www/html/.env
#RUN mv /var/www/html/supervisor/laravel-worker.conf /etc/supervisor/laravel-worker.conf
#RUN rm /var/www/html/.env.prod
#RUN mv /var/www/html/.env.test /var/www/html/.env
RUN mv /var/www/html/.env.dev /var/www/html/.env

#RUN apt update
#RUN apt install vim -y

RUN chmod -R 775 storage bootstrap/cache
RUN chown -R $USER:www-data storage
RUN chown -R $USER:www-data bootstrap/cache

RUN php artisan key:generate

RUN php artisan config:clear

EXPOSE 9000
CMD ["php-fpm"]
