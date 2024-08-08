#!/usr/bin/env bash
# backup db from remote dest server -- wp @Asher
#

cd "$(dirname "$0")"

# source common variables
source ./variables.sh
#
cd ..
sh ./scripts/db_backup_local.sh
ssh ${DEST_SERVER} "docker exec ${DEST_DOCKER_NAMESPACE}-db-1 sh -c 'exec mariadb-dump wordpress -uwordpress -p'${DB_PASSWORD}|gzip -9 > /home/${DEST_USER}/${DEST_DIRECTORY}/backup/wp-${DEST_DB_EXPORT_NAME}-`date +%F-%T`.sql.gz"
FILE=`ssh ${DEST_SERVER} "ls -ht  ~/${DEST_DIRECTORY}/backup/*.sql.gz | head -n 1"`
echo "New sql dump is: ${FILE}"
rsync -avz ${DEST_SERVER}:${FILE} ./backup/
LOCAL_FILE=`ls -ht ./backup/*.sql.gz  | head -n 1`
echo "The new dump copied to: $LOCAL_FILE"
sleep 1
cp ${LOCAL_FILE}  ./backup/wp-${DEST_DB_EXPORT_NAME}.sql.gz
zcat ${LOCAL_FILE} | sed '1d' | docker exec -i ${LOCAL_DOCKER_NAMESPACE}-db-1 mariadb -u wordpress --password=${DB_PASSWORD} wordpress
echo "Local DB for ${DEST_DOCKER_NAMESPACE} updated successfully ."
