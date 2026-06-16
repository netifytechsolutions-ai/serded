FROM php:8.1-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Copy project files
COPY . /var/www/html/

WORKDIR /var/www/html

EXPOSE 10000

CMD ["apache2-foreground"]