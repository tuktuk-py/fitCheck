FROM php:8.2-apache

# Copy the contents of the project directory into the container's /var/www/html directory
COPY . /var/www/html

# Expose port 80
EXPOSE 80
