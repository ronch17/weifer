#!/usr/bin/env bash
# Deploy code changes to com server -- wp @Asher
#

cd "$(dirname "$0")"

# source common variables
source ./variables.sh
#

git fetch origin ${DEST_BRANCH}:${DEST_BRANCH}
git fetch . develop:${DEST_BRANCH}
if [ $? != 0 ];then
    echo "error in merge"
else
    git push origin develop ${DEST_BRANCH}
    ssh ${DEST_SERVER} "cd ${DEST_DIRECTORY} && git add -A && git stash && sleep 5 && git pull && sleep 5 && git stash pop && git show"

fi
