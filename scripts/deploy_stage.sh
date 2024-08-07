#!/usr/bin/env bash
# Deploy code changes to com server -- wp @Asher
#

cd "$(dirname "$0")"

# source common variables
source ./variables.sh
#

git fetch origin master:master
git fetch . develop:master
if [ $? != 0 ];then
    echo "error in merge"
else
    git push origin develop ${STAGE_BRANCH}
    ssh ${STAGE_SERVER} "cd ${STAGE_DIRECTORY} && git add -A && git stash && sleep 5 && git pull && sleep 5 && git stash pop && git show"
fi
