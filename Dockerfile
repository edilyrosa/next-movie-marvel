FROM php:8.2-apache

# Copiar código al contenedor
COPY . /var/www/html/

# Exponer puerto 80
EXPOSE 80

# Comando por defecto (Apache ya corre)
CMD ["apache2-foreground"]
