#!/usr/bin/env bash

DB_PASSWORD="q+NF6_6rXTxM@?UJ"

DEST_USER="proftit"
DEST_SERVER="${DEST_USER}@82.112.240.64"
DEST_SERVER_IP="82.112.240.64"
DEST_DOCKER_USER="www-data"
DEST_DOMAIN="weifer.co"
DEST_DIRECTORY="weifer"
DEST_BRANCH="master"
DEST_DOCKER_NAMESPACE="weifer"
DEST_DB_EXPORT_NAME="weifer-com"

#STAGE_USER="integration"
#STAGE_SERVER="${STAGE_USER}@35.241.169.22"
#STAGE_DOCKER_USER="www-data"
#STAGE_DOCKER_NAMESPACE="weifer"
#STAGE_DIRECTORY="weifer"
#STAGE_BRANCH="master"
#STAGE_DB_EXPORT_NAME="weifer-stage"


source ./variables_local.sh
