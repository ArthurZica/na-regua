FROM webdevops/php-nginx:8.4-alpine
ENV APPLICATION_USER=application
ENV APPLICATION_GROUP=application
# Define onde ficam os arquivos do Laravel
ENV WEB_DOCUMENT_ROOT=/var/www/html/public

# Define o diretório de trabalho
WORKDIR /var/www/html

# Copia arquivos da aplicação
COPY . /var/www/html

# Instala dependências do PHP (produção)
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

COPY docker/production/start-container /usr/local/bin

RUN chmod +x /usr/local/bin/start-container

RUN chown -R application:application /var/www/html

USER application
ENTRYPOINT ["start-container"]
