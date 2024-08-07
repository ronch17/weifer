#!/usr/bin/env bash
# backup db from remote server -- wp @Asher
#

cd "$(dirname "$0")"

# source common variables
source ./variables.sh

cd ..
docker exec ${LOCAL_DOCKER_NAMESPACE}-db-1 sh -c 'exec mariadb-dump wordpress -uwordpress -p'${DB_PASSWORD}|gzip -9 > ~/${LOCAL_WORDPRESS_DIRECTORY}/${LOCAL_DIRECTORY}/backup/wp-${LOCAL_DB_EXPORT_NAME}-`date +%F-%T`.sql.gz
git add -A
git stash
git fetch -u origin master:master
git fetch -u origin develop:develop
sleep 1
git stash pop
LOCAL_FILE=`ls -ht ./backup/*${LOCAL_DIRECTORY}-test.sql.gz  | head -n 1`
echo "The new dump copied to: $LOCAL_FILE"
zcat ${LOCAL_FILE} | docker exec -i ${LOCAL_DOCKER_NAMESPACE}-db-1 mariadb -u wordpress --password=${DB_PASSWORD} wordpress
echo "Local DB for ${LOCAL_DOCKER_NAMESPACE} updated successfully ."
