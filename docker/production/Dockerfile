FROM webdevops/php-nginx:8.4-alpine

ENV APPLICATION_USER=application
ENV APPLICATION_GROUP=application
ENV WEB_DOCUMENT_ROOT=/var/www/html/public

WORKDIR /var/www/html

# Copia projeto
COPY . .

# Composer primeiro
USER root
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader


# Agora sim: Node/Vite (já com vendor existindo)
RUN apk add --no-cache nodejs npm
RUN npm install
RUN npm run build


# Permissões
RUN chown -R application:application /var/www/html \
    && chmod -R 775 storage \
    && chmod -R 775 bootstrap/cache

COPY docker/production/start-container /usr/local/bin
RUN chmod +x /usr/local/bin/start-container

USER application
ENTRYPOINT ["start-container"]
