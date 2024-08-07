#!/usr/bin/env bash
# backup db from remote server -- wp @Asher
#

cd "$(dirname "$0")"

# source common variables
source ./variables.sh
#
cd ..
sh ./scripts/db_backup_local.sh
ssh ${STAGE_SERVER} "docker exec ${STAGE_DOCKER_NAMESPACE}-db-1 sh -c 'exec mariadb-dump wordpress -uwordpress -p'${DB_PASSWORD}|gzip -9 > /home/${STAGE_USER}/${STAGE_DIRECTORY}/backup/wp-${STAGE_DB_EXPORT_NAME}-`date +%F-%T`.sql.gz"
FILE=`ssh ${STAGE_SERVER} "ls -ht  ~/${STAGE_DIRECTORY}/backup/*.sql.gz | head -n 1"`
echo "New sql dump is: ${FILE}"
rsync -avz ${STAGE_SERVER}:${FILE} ./backup/
LOCAL_FILE=`ls -ht ./backup/*.sql.gz  | head -n 1`
echo "The new dump copied to: $LOCAL_FILE"
sleep 1
cp ${LOCAL_FILE}  ./backup/wp-${STAGE_DB_EXPORT_NAME}.sql.gz
zcat ${LOCAL_FILE} | docker exec -i ${LOCAL_DOCKER_NAMESPACE}-db-1 mariadb -u wordpress --password=${DB_PASSWORD} wordpress
echo "Local DB for ${STAGE_DOCKER_NAMESPACE} updated successfully ."
