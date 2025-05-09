#!/bin/sh
until docker-compose exec mysql_db mysqladmin ping -h localhost -u myuser -pmypassword --silent; do
  echo "Esperando a que MySQL esté listo..."
  sleep 2
done
echo "¡MySQL está listo!"