FROM webdevops/php-nginx:8.4-alpine

# Document root do Laravel
ENV WEB_DOCUMENT_ROOT=/var/www/html/public

# Directório de trabalho
WORKDIR /var/www/html

# Copia apenas os arquivos necessários para instalar dependências
COPY composer.json composer.lock ./

# Instala dependências do PHP (produção)
RUN composer install --no-dev --no-interaction --prefer-dist --optimize-autoloader

# Copia todo restante do projeto
COPY . .

# Ajusta permissões corretas (PHP-FPM roda como application)
RUN chown -R application:application /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Copia o script de entrada
COPY docker/production/start-container /usr/local/bin
RUN chmod +x /usr/local/bin/start-container

ENTRYPOINT ["start-container"]
