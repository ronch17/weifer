#!/usr/bin/env bash
# Restart com server -- wp @Asher
#

cd "$(dirname "$0")"

# source common variables
source ./variables.sh
#

ssh ${STAGE_SERVER} "cd ${STAGE_DIRECTORY}/ && git pull && docker-compose -f docker-compose.stage.yml pull wordpress && docker-compose stop wordpress && docker-compose rm wordpress -f && docker-compose -f docker-compose.stage.yml up -d && sleep 1 && sudo chown ${STAGE_USER}:${STAGE_DOCKER_USER} app/ -R && sudo chmod -R 775 app/ && sleep 1 && sudo rm -rf app/wp-content/plugins/akismet/ app/wp-content/plugins/hello.php app/wp-content/themes/twenty* app/wp-content/uploads/cache/*"
