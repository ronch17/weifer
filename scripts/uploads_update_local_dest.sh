#!/usr/bin/env bash
# backup db from remote server -- wp @Asher
#

cd "$(dirname "$0")"

# source common variables
source ./variables.sh
#

ssh ${DEST_SERVER} "sudo chown ${DEST_USER}:${DEST_DOCKER_USER} ${DEST_DIRECTORY}/app/wp-content/uploads/ -R"

cd ..
sudo chown ${LOCAL_USER}:${LOCAL_DOCKER_USER} app/wp-content/uploads/ -R
rsync -avz ${DEST_SERVER}:/home/${DEST_USER}/${DEST_DIRECTORY}/app/wp-content/uploads/2024 ./app/wp-content/uploads
echo "Local uploads folder for ${LOCAL_DIRECTORY} updated successfully ."
