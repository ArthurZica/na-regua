#!/bin/bash
set -e

# Só rodar se tivermos a senha do root — segurança básica
if [ -z "$MYSQL_ROOT_PASSWORD" ]; then
  echo "MYSQL_ROOT_PASSWORD não definido — pulando inicialização custom."
  exit 0
fi

echo "Criando banco 'evolution' e garantindo permissões para ${MYSQL_USER}..."

mysql -u root -p"$MYSQL_ROOT_PASSWORD" <<-EOSQL
CREATE DATABASE IF NOT EXISTS evolution;
CREATE USER IF NOT EXISTS '${MYSQL_USER}'@'%' IDENTIFIED BY '${MYSQL_PASSWORD}';
GRANT ALL PRIVILEGES ON evolution.* TO '${MYSQL_USER}'@'%';
FLUSH PRIVILEGES;
EOSQL

echo "Inicialização custom concluída."
