#!/usr/bin/env bash
# Restart local test server -- wp @Asher
#

cd "$(dirname "$0")"
source ./variables.sh

docker-compose stop wordpress
docker-compose rm wordpress -f
docker-compose up -d

cd ..
sleep 1
echo Local User Name is: ${LOCAL_USER}
sudo chown -R ${LOCAL_USER}:${LOCAL_DOCKER_USER} app/ && sudo chmod -R 775 app/
sudo rm -rf app/wp-content/plugins/akismet/ app/wp-content/plugins/hello.php app/wp-content/themes/twenty* app/wp-content/uploads/cache/*
