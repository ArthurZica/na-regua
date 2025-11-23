# ----- STAGE 1: Node build -----
FROM node:20-alpine AS build

WORKDIR /app

COPY package*.json ./
RUN npm install

COPY . .
RUN npm run build


# ----- STAGE 2: PHP + Nginx -----
FROM webdevops/php-nginx:8.4-alpine

ENV APPLICATION_USER=application
ENV APPLICATION_GROUP=application
ENV WEB_DOCUMENT_ROOT=/var/www/html/public

WORKDIR /var/www/html

# Copia a aplicação (exceto node_modules)
COPY . .

# Copia o build gerado no stage 1
COPY --from=build /app/public/build ./public/build

USER root
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

RUN chown -R application:application /var/www/html \
    && chmod -R 775 storage \
    && chmod -R 775 bootstrap/cache

COPY docker/production/start-container /usr/local/bin
RUN chmod +x /usr/local/bin/start-container

USER application
ENTRYPOINT ["start-container"]
