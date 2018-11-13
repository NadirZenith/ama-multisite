#!/usr/bin/env bash

set -e

if ! [[ -d ./volume/db ]]; then
    mkdir -p ./volume/db
fi

if ! [[ -d ./volume/webserver ]]; then
    mkdir -p ./volume/webserver
fi

if ! [[ -d ./volume//wp-content ]]; then
    mkdir -p ./volume/wp-content
fi

chmod 777 ./volume/webserver/

docker-compose up -d --build

#docker exec helloworld_apache_con chown -R root:www-data /usr/local/apache2/logs
#docker exec helloworld_php_con chown -R root:www-data /usr/local/etc/logs
