FROM php:8.2-apache

# Install mysqli extension
RUN docker-php-ext-install mysqli

# Copy your XAMPP project directory into the container's /var/www/html directory
COPY . /var/www/html

# Copy the SQL dump file into the container
COPY outfitt.sql /outfitt.sql

# Install MySQL client
RUN apt-get update && apt-get install -y default-mysql-client

# Connect to MySQL server and import the SQL dump file
RUN mysql -h mysql-container -u root -poutfitadmin123 < /outfitt.sql

# Expose port 80
EXPOSE 80

# Start Apache when the container starts
CMD ["apache2-foreground"]
