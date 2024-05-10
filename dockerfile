# Use the official PHP Apache image
FROM php:8.2-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Copy your PHP application files into the container's /var/www/html directory
COPY . /var/www/html

# Change ownership of the /var/www/html directory
RUN chown -R www-data:www-data /var/www/html

# Expose port 80
EXPOSE 80

# Start Apache when the container starts
CMD ["apache2-foreground"]
