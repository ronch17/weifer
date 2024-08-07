#!/usr/bin/env bash
# Restart com server -- wp @Asher
#

cd "$(dirname "$0")"

# source common variables
source ./variables.sh
#

ssh ${DEST_SERVER} "cd ${DEST_DIRECTORY}/ && sleep 1 && sudo chown ${DEST_USER}:${DEST_DOCKER_USER} app/ -R && sudo chmod 775 app/ -R && sleep 1 && sudo rm -rf app/wp-content/uploads/cache/*"
#ssh ${DEST_SERVER} "cd ${DEST_DIRECTORY}/ && git reset --hard origin/${DEST_BRANCH}"
