#!/usr/bin/env bash

cd "$(dirname "$0")"

# source common variables
source ./variables.sh
#

cd ..

# Export Local DB
echo "**** starting to backup Local Server DB ..."
LAST_COMMIT=`git log -1 --pretty=%B`
#  y/ /-/          ; # Change space to -
#  s/\n/-/         ; # Replace the embedded newline with -
#  s,//            ; # trim commas
#  g               ; # global flag
TRIM_LAST_COMMIT="$(echo -e $(echo ${LAST_COMMIT} | tr -d '\r') | sed -e 'y/ /~/;s/-/~/g;s/,//g')"

docker exec weifer-db-1 sh -c 'exec mariadb-dump wordpress -uwordpress -p'${DB_PASSWORD}|gzip -9 > ~/${LOCAL_WORDPRESS_DIRECTORY}/${LOCAL_DIRECTORY}/backup/__after-commit__~${TRIM_LAST_COMMIT}~__wp-${LOCAL_DB_EXPORT_NAME}-`date +%F-%T`.sql.gz
if [ $? != 0 ];then
  echo error in local: newtemplate2
else
    LOCAL_FILE=`ls -ht  ./backup/*.sql.gz | head -n 1`
    LOCAL_FILE_SIZE=`du -k "${LOCAL_FILE}" | cut -f1`
    echo "5. New sql local dump is: ${LOCAL_FILE} - ${LOCAL_FILE_SIZE}kb"
    sleep 1
    cp "${LOCAL_FILE}"  ~/${LOCAL_WORDPRESS_DIRECTORY}/${LOCAL_DIRECTORY}/backup/wp-${LOCAL_DB_EXPORT_NAME}.sql.gz
fi
