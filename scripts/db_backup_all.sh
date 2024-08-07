#!/usr/bin/env bash

cd "$(dirname "$0")"

# source common variables
source ./variables.sh
#

cd ..
# Export Dest (Production) Server DB
echo "**** starting to backup Dest Server DB ..."
ssh ${DEST_SERVER} "docker exec ${DEST_DIRECTORY}-db-1 sh -c 'exec mariadb-dump wordpress -uwordpress -p'${DB_PASSWORD}|gzip -9 > /home/${DEST_USER}/${DEST_DIRECTORY}/backup/wp-${DEST_DB_EXPORT_NAME}-`date +%F-%T`.sql.gz"
if [ $? != 0 ];then
  echo error in dest server: ${DEST_SERVER}
else
    DEST_FILE=`ssh ${DEST_SERVER} "ls -ht  ~/${DEST_DIRECTORY}/backup/*.sql.gz | head -n 1"`
    echo "1. New sql dump in dest server is: ${DEST_FILE}"
    rsync -avz ${DEST_SERVER}:${DEST_FILE} ./backup/
    LOCAL_DEST_FILE=`ls -ht  ./backup/*.sql.gz | head -n 1`
    LOCAL_DEST_FILE_SIZE=`du -k ${LOCAL_DEST_FILE} | cut -f1`
    echo "2. New sql dest server dump in local is: ${LOCAL_DEST_FILE} - ${LOCAL_DEST_FILE_SIZE}kb"
    sleep 1
    cp ${LOCAL_DEST_FILE}  ./backup/wp-${DEST_DB_EXPORT_NAME}.sql.gz
fi

# Export Stage DB
echo "**** starting to backup Stage Server DB ..."
ssh ${STAGE_SERVER} "docker exec ${STAGE_DIRECTORY}-db-1 sh -c 'exec mariadb-dump wordpress -uwordpress -p'${DB_PASSWORD}|gzip -9 > /home/${STAGE_USER}/${STAGE_DIRECTORY}/backup/wp-${STAGE_DB_EXPORT_NAME}-`date +%F-%T`.sql.gz"
if [ $? != 0 ];then
  echo error in stage server: ${STAGE_SERVER}
else
    DEST_FILE=`ssh ${STAGE_SERVER} "ls -ht  ~/${STAGE_DIRECTORY}/backup/*.sql.gz | head -n 1"`
    echo "3. New sql dump in stage server is: ${DEST_FILE}"
    rsync -avz ${STAGE_SERVER}:${DEST_FILE} ./backup/
    LOCAL_STAGE_FILE=`ls -ht  ./backup/*.sql.gz | head -n 1`
    LOCAL_STAGE_FILE_SIZE=`du -k ${LOCAL_STAGE_FILE} | cut -f1`
    echo "4. New sql stage server dump in local is: ${LOCAL_STAGE_FILE} - ${LOCAL_STAGE_FILE_SIZE}kb"
    sleep 1
    cp ${LOCAL_STAGE_FILE}  ./backup/wp-${STAGE_DB_EXPORT_NAME}.sql.gz
fi

# Export Local DB
echo "**** starting to backup Local Server DB ..."
docker exec ${LOCAL_DOCKER_NAMESPACE}-db-1 sh -c 'exec mariadb-dump wordpress -uwordpress -p'${DB_PASSWORD}|gzip -9 > ~/${LOCAL_WORDPRESS_DIRECTORY}/${LOCAL_DIRECTORY}/backup/wp-${LOCAL_DB_EXPORT_NAME}-`date +%F-%T`.sql.gz
if [ $? != 0 ];then
  echo error in local: ${LOCAL_DOCKER_NAMESPACE}
else
    LOCAL_FILE=`ls -ht  ./backup/*.sql.gz | head -n 1`
    LOCAL_FILE_SIZE=`du -k ${LOCAL_FILE} | cut -f1`
    echo "5. New sql local dump is: ${LOCAL_FILE} - ${LOCAL_FILE_SIZE}kb"
    sleep 1
    cp ${LOCAL_FILE}  ./backup/wp-${LOCAL_DB_EXPORT_NAME}.sql.gz
fi
