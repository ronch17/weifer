#!/usr/bin/env bash
# -- wp @Asher
# 1. Backup all DB's - local and server
# 2. Export / dump local DB
# 3. Upload latest sqldump file to server
# 4. Update server DB from this file

cd "$(dirname "$0")"

# source common variables
source ./variables.sh

# 1. Backup all DB's - local and server
sh db_backup_all.sh
# 2. Export / dump local DB
docker exec ${LOCAL_DOCKER_NAMESPACE}-db-1 sh -c 'exec mariadb-dump wordpress -uwordpress -p'${DB_PASSWORD}|gzip -9 > ~/${LOCAL_WORDPRESS_DIRECTORY}/${LOCAL_DIRECTORY}/backup/wp-${LOCAL_DB_EXPORT_NAME}-`date +%F-%T`.sql.gz
cd ..

# 3. Upload latest sqldump file to server
LAST_FILE=`ls -ht  ./backup/*.sql.gz | head -n 1`
rsync -av ${LAST_FILE} ${DEST_SERVER}:/home/${DEST_USER}/${DEST_DIRECTORY}/backup/

# 4. Update server DB from this file
DEST_LAST_FILE=`ssh ${DEST_SERVER} "ls -ht  ~/${DEST_DIRECTORY}/backup/*.sql.gz | head -n 1"`
ssh ${DEST_SERVER} "zcat ${DEST_LAST_FILE} | docker exec -i ${DEST_DOCKER_NAMESPACE}-db-1 mariadb -u wordpress --password=${DB_PASSWORD} wordpress"

