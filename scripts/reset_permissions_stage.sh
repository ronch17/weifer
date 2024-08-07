#!/usr/bin/env bash
# Restart com server -- wp @Asher
#

cd "$(dirname "$0")"

# source common variables
source ./variables.sh
#

ssh ${STAGE_SERVER} "cd ${STAGE_DIRECTORY}/ && sleep 1 && sudo chown ${STAGE_USER}:${STAGE_DOCKER_USER} app/ -R && sudo chmod 775 app/ -R && sleep 1 && sudo rm -rf app/wp-content/uploads/cache/*"
