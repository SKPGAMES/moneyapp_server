# Use official PHP Apache image
FROM php:8.2-apache

# Copy project files to Apache public folder
COPY . /var/www/html/

# Expose port 10000 (default HTTP)
EXPOSE 10000
