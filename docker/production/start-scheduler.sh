#!/usr/bin/env bash

# Força primeira execução imediata
cd /var/www/html
php artisan schedule:run

# Inicializa cron para rodar a cada minuto
echo "* * * * * cd /var/www/html && php artisan schedule:run >> /dev/null 2>&1" > /etc/crontabs/root

# Mantém container rodando
crond -f -l 2
