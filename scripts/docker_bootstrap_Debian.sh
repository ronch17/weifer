#!/usr/bin/env bash
# Initial deployment to new not configured destination server
cd "$(dirname "$0")"

# source common variables
source ./variables.sh
#
scp -r /home/${LOCAL_USER}/weifer/ssl-for-origin root@${DEST_SERVER_IP}:/home/proftit/ && sleep 5 &&
sshpass -p ${DEST_PASSWORD} ssh root@${DEST_SERVER_IP} "apt-get install -y rsync && sleep 5 &&
useradd -m -s /bin/bash proftit && sleep 5 &&
(echo ${PROFTIT_PASSWORD}; echo ${PROFTIT_PASSWORD}) | passwd proftit && sleep 5 &&
echo 'proftit ALL=(ALL) NOPASSWD:ALL' | sudo tee -a /etc/sudoers && sleep 5 && exit" && sleep 5 &&
ssh proftit@${DEST_SERVER} "sudo apt update -y && sudo apt upgrade -y && sleep 5 &&
sudo apt install -y aptitude && sudo aptitude update && sudo aptitude -y upgrade && sleep 5 &&
sudo aptitude install -y apt-transport-https ca-certificates curl gnupg2 software-properties-common htop screen iftop iotop vim bash-completion net-tools telnet dnsutils git dirmngr && sleep 5 &&
curl -fsSL https://download.docker.com/linux/$(. /etc/os-release; echo "$ID")/gpg | sudo apt-key add - && sleep 5 &&
sudo add-apt-repository 'deb [arch=amd64] https://download.docker.com/linux/$(. /etc/os-release; echo '$ID') $(lsb_release -cs) stable' && sleep 5 &&
sudo aptitude update && sleep 5 &&
sudo aptitude install -y docker-ce && sleep 5 &&
sudo usermod -G docker,adm,dip,video,plugdev ${USER} && sleep 5 &&
sudo curl -L 'https://github.com/docker/compose/releases/download/1.29.2/docker-compose-$(uname -s)-$(uname -m)' -o /usr/local/bin/docker-compose && sleep 5 &&
sudo chmod +x /usr/local/bin/docker-compose && sleep 5 &&
sudo ln -s /usr/local/bin/docker-compose /usr/bin/docker-compose && sleep 5 &&
sudo chmod 666 /var/run/docker.sock && sleep 5 &&
echo -e '\n\n\n' | ssh-keygen -t rsa && sleep 5 &&
echo ${LOCAL_SSH_KEY} | sudo tee -a ~/.ssh/authorized_keys && sleep 5 &&
echo 'PasswordAuthentication no' | sudo tee -a ~/.ssh/config && sleep 5 &&
git config --global user.email 'dest@${DEST_DOMAIN}' && git config --global user.name 'Dest Server' && sleep 5 &&
cat ~/.ssh/id_rsa.pub"
# git clone git@bitbucket.org:binaricore/weifer.git && cd weifer/ && git config core.fileMode false
