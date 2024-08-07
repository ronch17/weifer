#!/usr/bin/env bash
# backup db from remote server -- wp @Asher
#

cd "$(dirname "$0")"

# source common variables
source ./variables.sh
#

ssh ${STAGE_SERVER} "sudo chown ${STAGE_USER}:${STAGE_DOCKER_USER} ${STAGE_DIRECTORY}/app/wp-content/uploads/ -R"

cd ..
sudo chown ${LOCAL_USER}:${LOCAL_DOCKER_USER} app/wp-content/uploads/ -R
rsync -avz ${STAGE_SERVER}:/home/${STAGE_USER}/${STAGE_DIRECTORY}/app/wp-content/uploads/2022 ./app/wp-content/uploads
echo "Local uploads folder for ${LOCAL_DIRECTORY} updated successfully ."
