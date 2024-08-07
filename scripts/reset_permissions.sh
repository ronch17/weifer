#!/usr/bin/env bash
# Reset permissions -- wp @Asher
#

cd "$(dirname "$0")"
source ./variables.sh
cd ..
echo Local User Name is: ${LOCAL_USER}
sudo chown ${LOCAL_USER}:${LOCAL_DOCKER_USER} app/ -R
sudo chmod 775 app/ -R
