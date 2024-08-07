#!/usr/bin/env bash
# Restart com server -- wp @Asher
#

cd "$(dirname "$0")"

# source common variables
source ./variables.sh
#

ssh ${DEST_SERVER} "cd ${DEST_DIRECTORY}/ && git pull && docker-compose -f docker-compose.prod.yml pull wordpress && docker-compose stop wordpress && docker-compose rm wordpress && docker-compose -f docker-compose.prod.yml up -d && sleep 1 && sudo chown ${DEST_USER}:${DEST_DOCKER_USER} app/ -R && sudo chmod 775 app/ -R && sleep 1 && sudo rm -rf app/wp-content/plugins/akismet/ app/wp-content/plugins/hello.php app/wp-content/themes/twenty* app/wp-content/uploads/cache/*"




